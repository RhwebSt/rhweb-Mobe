<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Pessoai;
class UsuarioController extends Controller
{
    private $user;
    public function __construct()
    {
        $this->user = new User;
        $this->pessoais = new Pessoai;
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
        $user = Auth::user();
        $id = [];
        $search = request('search');
        $codicao = request('codicao');
        $users = $this->user->listaUser('asc',$search); 
        $permissio = $this->user->permission();

        foreach ($users as $key => $use) {
            array_push($id,$use->id);
        }
        $permissao = $this->user->permissao($id);
        // dd($permissao);
        if ($codicao) {
            $editar = $this->user->edit($codicao);
            return view('usuarios.edit',compact('user','users','editar','permissao','permissio'));
        }else{
            return view('usuarios.trabalhador.index',compact('user','users','permissao','permissio'));
        }
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
        $user = new User;
        try {
            $users = $user->cadastro($dados);
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
        $user = new User;
        $users = $user->first($id);
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
        // $user = Auth::user();
        // $dados = $this->user->edit($id);
        // return view('usuarios.dadosPessoais.index',compact('user'));
        $id = base64_decode($id);
        $user = Auth::user();
        $search = request('search');
        $users = $this->user->listaUser('asc',$search);
        $editar = $this->user->edit($id);
        return view('usuarios.trabalhador.edit',compact('user','users','editar'));
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
        $user = new User;
        try {
            $users = $user->editar($dados,$id);
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
