<?php

namespace App\Http\Controllers\Administrador\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Empresa;

class UsuarioController extends Controller
{
    private $user, $empresa;
    public function __construct()
    {
        $this->user = new User;
        $this->empresa = new Empresa;
    }
    public function index()
    {
        $search = request('search');
        $lista = $this->user->with(['empresa.user', 'permissions'])
            ->where(function ($query) use ($search) {
                $user = auth()->user();
                if ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                } else {
                    $query->where('id', '>', 0);
                }
            })
            ->orderBy('name', 'asc')
            ->paginate(10);
        $permissions = Permission::get();
        return view('administrador.usuarios.lista', compact('lista', 'permissions'));
    }

    public function ordem($ordem)
    {
        $search = request('search');
        $lista = $this->user->with(['empresa.user', 'permissions'])
            ->where(function ($query) use ($search) {
                $user = auth()->user();
                if ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                } else {
                    $query->where('id', '>', 0);
                }
            })
            ->orderBy('name', $ordem)
            ->paginate(10);
        $permissions = Permission::get();
        return view('administrador.usuarios.lista', compact('lista', 'permissions'));
    }
    public function create()
    {
        return view('administrador.usuarios.cadastrar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all();
        
        $request->validate([
            'name' => 'required|max:20|regex:/^[a-zA-Z0-9_\-]*$/',
            'senha' => 'max:20|required',
            'cargo' => 'max:100|regex:/^[a-zA-Z0-9_\-]*$/',
            'email' => 'required|email',
            'empresa' => 'required'

        ], [
            'name.required' => 'Este campo não pode estar vazio!',
            'name.regex' => 'Este campo não pode ter caracteres especiais!',
            'name.max' => 'Este campo não pode conter mas de 20 caracteres!',
            'senha.min' => 'A senha não pode conter menos de 6 caracteres!',
            'cargo.max' => 'Este campo não pode conter mais de 100 caracteres!',
            'cargo.regex' => 'Este campo não pode ter caracteres especiais!',
            'empresa.required' => 'Este campo não pode estar vazio!',
        ]);

        try {
            $this->user->create([
                'name' => $dados['name'],
                'email' => $dados['email'],
                'password' => Hash::make($dados['senha']),
                'cargo' => $dados['cargo'],
                'empresa_id' => $dados['empresa'],
            ]);
            //->givePermissionTo('user', 'cadastro', 'editar', 'deleta', 'rotinamensal', 'fatura', 'recibo', 'relatorio');
            return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false' => 'Não foi possível cadastrar.']);
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
        //
    }
    public function pesquisa()
    {
        $lista = $this->empresa->buscaEmpresaUsuario();
        return response()->json($lista);
    }
    public function edit($id)
    {
        $editar = $this->user->where('id', $id)->with('empresa.user')->first();
        return view('administrador.usuarios.editar', compact('editar'));
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
            'senha' => 'max:20',
            'cargo' => 'max:100|regex:/^[a-zA-Z0-9_\-]*$/',
            'email' => 'required|email',
            'empresa' => 'required'

        ], [
            'name.required' => 'Este campo não pode estar vazio!',
            // 'name.regex'=>'Este campo não pode ter caracteres especiais!',
            'name.max' => 'Este campo não pode conter mas de 20 caracteres!',
            'senha.min' => 'A senha não pode conter menos de 6 caracteres!',
            'cargo.max' => 'Este campo não pode conter mais de 100 caracteres!',
            'empresa.required' => 'Este campo não pode estar vazio!',
        ]);
        try {
            if ($dados['senha']) {
                $this->user->where('id', $id)
                ->update([
                    'name' => $dados['name'],
                    'email' => $dados['email'],
                    'cargo' => $dados['cargo'],
                    'password' => Hash::make($dados['senha']),
                    'empresa_id' => $dados['empresa'],
                ]);
            } else {
                $this->user->where('id', $id)
                ->update([
                    'name' => $dados['name'],
                    'email' => $dados['email'],
                    'cargo' => $dados['cargo'],
                    'empresa_id' => $dados['empresa'],
                ]);
            }
            return redirect()->back()->withSuccess('Atualizado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false' => 'Não foi possível atualizar.']);
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
        //
    }
}
