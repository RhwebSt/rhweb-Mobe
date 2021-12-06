<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Empresa;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        // $users = $user->first('jose');
        return view('usuarios.index',compact('user'));
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
            'name' => 'required|unique:users',
            'senha'=>'required|min:6',
            'nome__completo'=>'required',
            'empresa'=>'required|min:1',
        ],[
            'nome__completo.required'=>'Campo não pode esta vazio!',
            'name.required'=>'Campo não pode esta vazio!',
            'senha.min'=>'A senha não pode ter menos de 6 caracteris!',
            'senha.required'=>'Campo não pode esta vazio!',
            'empresa.required'=>'Tomador não ta cadastro ou não foi encontrado!',
            'empresa.min'=>'Tomador não ta cadastro ou não foi encontrado!'
            
        ]);
        $user = new User;
        $users = $user->cadastro($dados);
        if ($users) {
            $condicao = 'cadastratrue';
        }else{
            $condicao = 'cadastrafalse';
        }
        return redirect()->route('user.create')->withInput()->withErrors([$condicao]);
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
        $empresa = new Empresa;
        $empresas = $empresa->usuario($id);
        if ($empresas) {
            return response()->json($empresas);
        }else{
            $users = $user->first($id);
            return response()->json($users);
        }
        
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
        $dados = $request->all();
        
        $request->validate([
            'name' => 'required',
            'senha'=>'min:6',
            'nome__completo'=>'required',
            'empresa'=>'required|min:1',
        ]
        // [
        //     'nome__completo.required'=>'Campo não pode esta vazio!',
        //     'usuario.required'=>'Campo não pode esta vazio!',
        //     'senha.min'=>'A senha não pode ter menos de 6 caracteris!',
        //     'senha.required'=>'Campo não pode esta vazio!',
        //     'empresa.required'=>'Tomador não ta cadastro ou não foi encontrado!',
        //     'empresa.min'=>'Tomador não ta cadastro ou não foi encontrado!'
        // ]
        );
        $user = new User;
        $users = $user->editar($dados,$id);
        if ($users) {
            $condicao = 'edittrue';
        }else{
            $condicao = 'editfalse';
        }
        return redirect()->route('user.create')->withInput()->withErrors([$condicao]);
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
