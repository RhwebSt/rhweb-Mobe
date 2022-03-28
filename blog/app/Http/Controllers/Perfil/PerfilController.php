<?php

namespace App\Http\Controllers\Perfil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Pessoai;
use App\Endereco;
class PerfilController extends Controller
{
    private $user,$pessoais,$endereco;
    public function __construct()
    {
        $this->user = new User;
        $this->pessoais = new Pessoai;
        $this->endereco = new Endereco;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user = auth()->user();
        try {
            $pessoais = $this->pessoais->editar($id);
            return view('usuarios.pessoais.index',compact('user','pessoais'));
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Erro.']);
        }
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
}
