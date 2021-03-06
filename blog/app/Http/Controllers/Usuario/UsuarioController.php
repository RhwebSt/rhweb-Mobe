<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use App\Notifications\notificacaoUsuarios;
use App\User;
use App\Pessoai;
use App\Empresa;
class UsuarioController extends Controller
{
    private $user;
    public function __construct()
    {
        $this->user = new User;
        $this->pessoais = new Pessoai;
        $this->empresa = new Empresa;
    }
    public function index()
    {
        $user = Auth::user();
        $empresa = $this->empresa->where('id',$user->empresa_id)->first();
        return view('usuarios.index',compact('user','empresa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $search = request('search');
        $codicao = request('codicao');
        $empresa = $this->empresa->where('id',$user->empresa_id)->first();
        $lista = $this->user->with(['empresa.user', 'permissions'])
            ->where(function ($query) use ($search) {
                $user = auth()->user();
                if ($search) {
                    $query->where([
                        ['name', 'like', '%' . $search . '%'],
                        ['empresa_id',$user->empresa_id]
                    ])
                    ->orWhere([
                        ['email', 'like', '%' . $search . '%'],
                        ['empresa_id',$user->empresa_id]
                    ]);
                } else {
                    $query->where([
                        ['id', '>', 0],
                        ['empresa_id',$user->empresa_id],
                        ['cargo','!=','admin']
                    ]);
                }
            })
        ->orderBy('name', 'asc')
        ->paginate(10);
        // dd($lista);
        $permissions = Permission::get(); 
        
        if ($codicao) {
            $editar = $this->user->where('id', $codicao)->with('empresa.user')->first();
            return view('usuarios.trabalhador.edit',compact('user','lista','editar','permissions'));
        }else{
            return view('usuarios.trabalhador.index',compact('user','lista','permissions','empresa'));
        }
    }

    public function ordem($ordem,$codicao = null)
    {
        $user = auth()->user();
        $lista = $this->user->with(['empresa.user', 'permissions'])
            ->where(function ($query){
                $user = auth()->user();
                $query->where([
                    ['id', '>', 0],
                    ['empresa_id',$user->empresa_id],
                    ['cargo','!=','admin']
                ]);
            })
        ->orderBy('name', $ordem)
        ->paginate(10);
        $permissions = Permission::get();
        
        if ($codicao) {
            $editar = $this->user->where('id', $codicao)->with('empresa.user')->first();
            return view('usuarios.trabalhador.edit',compact('user','lista','editar','permissions'));
        }else{
            return view('usuarios.trabalhador.index',compact('user','lista','permissions'));
        }
    }
    public function store(Request $request)
    {
        $dados = $request->all();
        $user = auth()->user();
        $verificar = $this->user->where([
            ['email', $dados['email']],
            ['empresa_id',$user->empresa_id]
        ])->with('user')->count();
        if ($verificar) {
            return redirect()->back()->withInput()->withErrors(['email'=>'Este email j?? est?? cadastrado!']);
        }
        $request->validate([
            'name' => 'required|max:20|unique:users|regex:/^[a-zA-Z0-9_\-]*$/',
            'senha'=>'max:20',
            'cargo'=>'max:100|regex:/^[a-zA-Z0-9_\-]*$/',
            'email'=>'required|email|unique:users',
           
        ],[
            'name.required'=>'O campo n??o pode estar vazio!',
            'name.unique'=>'Esse nome j?? esta sendo utilizado!',
            // 'name.regex'=>'O campo n??o pode ter caracteres especiais!',
            'name.max'=>'O campo n??o pode conter mas de 20 caracteres!',
            'senha.min'=>'A senha n??o pode conter menos de 6 caracteres!',
            'cargo.max'=>'O campo n??o pode conter mais de 100 caracteres!',
            'email.unique'=>'Esse email j?? esta sendo utilizado!',
            // 'cargo.regex'=>'O campo n??o pode ter caracteres especiais!',
        ]);

        
            $p = [];
            $permissions = Permission::get();
            foreach ($permissions as $key => $permissao) {
                if ($permissao->name === 'Super Admin' || $permissao->name === 'admin') {
                   
                }else{
                    array_push($p,$permissao->name);
                }
            }
        
            $users = $this->user->cadastro($dados,$p);
            $users->notify(new notificacaoUsuarios($users,$dados['senha']));
            return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
            try { 
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'N??o foi poss??vel cadastrar.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $users = $this->user->first($id);
        return response()->json($users);
    }
    public function pesquisa()
    { 
        $user = auth()->user();
        $users = $this->user->where('empresa_id',$user->empresa_id)->get();
        return response()->json($users);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $user = auth()->user();
        $search = request('search');
        $empresa = $this->empresa->where('id',$user->empresa_id)->first();
        $editar = $this->user->where('id', $id)->with('empresa.user')->first();
        $lista = $this->user->with(['empresa.user', 'permissions'])
            ->where(function ($query) use ($search) {
                $user = auth()->user();
                if ($search) {
                    $query->where([
                        ['name', 'like', '%' . $search . '%'],
                        ['empresa_id',$user->empresa_id]
                    ])
                    ->orWhere([
                        ['email', 'like', '%' . $search . '%'],
                        ['empresa_id',$user->empresa_id]
                    ]);
                } else {
                    $query->where([
                        ['id', '>', 0],
                        ['empresa_id',$user->empresa_id],
                        ['cargo','!=','admin']
                    ]);
                }
            })
        ->orderBy('name', 'asc')
        ->paginate(10);
        $permissions = Permission::get();
        return view('usuarios.trabalhador.edit',compact('user','empresa','lista','editar','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dados = $request->all();
        $request->validate([
            'name' => 'required|max:20|regex:/^[a-zA-Z0-9_\-]*$/',
            'senha'=>'max:20',
            'cargo'=>'max:100|regex:/^[a-zA-Z0-9_\-]*$/',
            'email'=>'required|email',
           
        ],[
            'name.required'=>'Este campo n??o pode estar vazio!',
            // 'name.regex'=>'Este campo n??o pode ter caracteres especiais!',
            'name.max'=>'Este campo n??o pode conter mas de 20 caracteres!',
            'senha.min'=>'A senha n??o pode conter menos de 6 caracteres!',
            'cargo.max'=>'Este campo n??o pode conter mais de 100 caracteres!',
            // 'cargo.regex'=>'Este campo n??o pode ter caracteres especiais!',
        ]);
        try {
            $users = $this->user->editar($dados,$id);
            return redirect()->back()->withSuccess('Atualizado com sucesso.'); 
            
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'N??o foi possiv??l atualizar.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $users = $this->user->deletar($id);
            return redirect()->back()->withSuccess('Deletado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'N??o foi poss??vel deletar o registro.']);
        }
    }
  
}
