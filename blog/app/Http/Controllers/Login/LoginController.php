<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $user;
    public function __construct()
    {
        $this->user = new User;
    }
    public function index()
    {
        if (auth()->check()){
            return redirect()->route('home.index');
        }
        return view('index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('login.index'); 
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
        // $user = $this->user->verificausuario($dados['user']);
       
        $request->validate([
            'user' => 'required',
            'password'=>'required' 
        ],[
            'user.required'=>'Campo usuário não pode estar vazio!',
            'password.required'=>'Informe sua senha!',
            'password.min'=>'A senha não pode conter menos de 6 caracteres!',
            
        ]);
       
        // $user = $this->user->buscaListaUserLogin($dados);
        // if (!$user->uscontado) {
        //     $user->uscontado += 1;
        // }else{
        //     $user->uscontado += 1;
        // }
        // $this->user->editeLoginContador($dados,$user->uscontado);
        // if ($user->uscontado === 1) {
        //     return redirect()->back()->withInput()->withErrors(['mensagem'=>'Você tem mais 2 tentativa.']);
        // }
        // if ($user->uscontado === 3) {
        //     return redirect()->back()->withInput()->withErrors(['mensagem'=>'Você atigil as 3 tentetivas tente novamento mais tarde.']);
        // }
        if (Auth::attempt(['name'=>$dados['user'],'password'=>$dados['password']])) {
            // $this->user->editeLoginContador($dados,null);
            // $user->givePermissionTo('user');
            $user = $this->user->where('name', $dados['user'])->with('empresa.user')->first();
        
            if (!$user->empresa_id) {
                return redirect()->back()->withInput()->withErrors(['mensagem'=>'Você precissa informa e sua empresa.']);
            }
            return redirect()->route('home.index');
        } 
        return redirect()->route('login.create')->withInput()->withErrors(['mensagem'=>'Erro ao realizar o login do usuário. Tente novamente.']);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
    public function logout()
    {
        Auth::logout();
        return redirect()->route('/.index');
    }
}
