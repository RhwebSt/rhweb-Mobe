<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
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
        return view('usuarios.index',compact('user'));
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
        if ($codicao) {
            $editar = $this->user->where('id', $codicao)->with('empresa.user')->first();
            return view('usuarios.trabalhador.edit',compact('user','lista','editar','permissions'));
        }else{
            return view('usuarios.trabalhador.index',compact('user','lista','permissions'));
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
            return redirect()->back()->withInput()->withErrors(['email'=>'Este email já esta cadastrado!']);
        }
        $request->validate([
            'name' => 'required|max:20|regex:/^[a-zA-Z0-9_\-]*$/',
            'senha'=>'max:20',
            'cargo'=>'max:100|regex:/^[a-zA-Z0-9_\-]*$/',
            'email'=>'required|email',
           
        ],[
            'name.required'=>'O campo não pode estar vazio!',
            // 'name.regex'=>'O campo não pode ter caracteres especiais!',
            'name.max'=>'O campo não pode conter mas de 20 caracteres!',
            'senha.min'=>'A senha não pode conter menos de 6 caracteres!',
            'cargo.max'=>'O campo não pode conter mais de 100 caracteres!',
            // 'cargo.regex'=>'O campo não pode ter caracteres especiais!',
        ]);

        try {
            $users = $this->user->cadastro($dados);
            return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
            
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi prossível cadastrar.']);
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
        return view('usuarios.trabalhador.edit',compact('user','lista','editar','permissions'));
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
            'name.required'=>'O campo não pode estar vazio!',
            // 'name.regex'=>'O campo não pode ter caracteres especiais!',
            'name.max'=>'O campo não pode conter mas de 20 caracteres!',
            'senha.min'=>'A senha não pode conter menos de 6 caracteres!',
            'cargo.max'=>'O campo não pode conter mais de 100 caracteres!',
            // 'cargo.regex'=>'O campo não pode ter caracteres especiais!',
        ]);
        try {
            $users = $this->user->editar($dados,$id);
            return redirect()->back()->withSuccess('Atualizador com sucesso.'); 
            
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possivél realizar a atualização.']);
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
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível deletar o registro.']);
        }
    }
  
}
