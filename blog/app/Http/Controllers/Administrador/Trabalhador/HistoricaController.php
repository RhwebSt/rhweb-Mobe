<?php

namespace App\Http\Controllers\Administrador\Trabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabalhador;
use App\Bolcartaoponto;
use App\Lancamentorublica;
use App\Folhar;
class HistoricaController extends Controller
{
    private $trabalhador,$bolcartaoponto,$lanrublica,$folhar;
    public function __construct()
    {
        $this->trabalhador = new Trabalhador;
        $this->bolcartaoponto = new Bolcartaoponto;
        $this->lanrublica = new Lancamentorublica;
        $this->folhar = new Folhar;
    }
    public function index()
    {
        $trabalhador = $this->trabalhador->listaTrabalhadorEmpresa();
        return view('administrador.trabalhador.table',compact('trabalhador'));
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
        $trabalhador = $this->trabalhador->buscaUnidadeTrabalhador($id);
        $cartaoponto = $this->bolcartaoponto->buscaListaCartaoPontoTrabalhador($id);
        $lanrublica = $this->lanrublica->buscaListaTablelaTrabalhador($id);
        $folhar = $this->folhar->listaTrabalhadorFolhar($id);
        return view('administrador.trabalhador.arquivo',compact('trabalhador','cartaoponto','lanrublica','folhar'));
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
}
