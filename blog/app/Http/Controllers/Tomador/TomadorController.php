<?php

namespace App\Http\Controllers\Tomador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tomador;
use App\Taxa;
use App\Endereco;
use App\Bancario;
use App\RetencaoFatura;
use App\CartaoPonto;
use App\Parametrosefip;
use App\TaxaTrabalhador;
use App\IndiceFatura;
class TomadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tomador = new Tomador;
        // $tomadors = $tomador->lista();
        
        return view('tomador.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tomador.create');
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
        // dd($dados);
        $tomador = new Tomador;
        $taxa = new Taxa;
        $endereco = new Endereco;
        $bancario = new Bancario;
        $retencaofatura = new RetencaoFatura;
        $cartaoponto = new CartaoPonto;
        $parametrosefip = new Parametrosefip;
        $taxatrabalhador = new TaxaTrabalhador;
        $indicefatura = new IndiceFatura; 
        $tomadors = $tomador->cadastro($dados);
        if ($tomadors) {
            $dados['tomador'] = $tomadors['id'];
            $enderecos = $endereco->cadastro($dados); 
            $taxas = $taxa->cadastro($dados);
            $bancarios = $bancario->cadastro($dados);
            $retencaofaturas = $retencaofatura->cadastro($dados);
            $cartaoponto = $cartaoponto->cadastro($dados);
            $parametrosefips = $parametrosefip->cadastro($dados);
            $taxatrabalhador = $taxatrabalhador->cadastro($dados);
            $indicefaturas = $indicefatura->cadastro($dados);
            if ($enderecos && $taxas
            && $bancarios && $retencaofaturas && 
            $cartaoponto && $parametrosefips && 
            $taxatrabalhador && $indicefaturas) {
                $condicao = 'cadastratrue';
            }else{
                $condicao = 'cadastrafalse';
            }
            return redirect()->route('tomador.index')->withInput()->withErrors([$condicao]);
            
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
        $tomador = new Tomador;
        $tomadors = $tomador->first($id);
        return response()->json($tomadors);
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
        // dd($dados);
        $tomador = new Tomador;
        $endereco = new Endereco;
        $taxa = new Taxa;
        $bancario = new Bancario;
        $retencaofatura = new RetencaoFatura;
        $cartaoponto = new CartaoPonto;
        $parametrosefip = new Parametrosefip;
        $taxatrabalhador = new TaxaTrabalhador;
        $indicefatura = new IndiceFatura; 
        $condicao = '';
        $tomadors = $tomador->editar($dados,$id);
        $enderecos = $endereco->editartomador($dados,$id); 
        $bancarios = $bancario->editarbacario($dados,$id);
        $retencaofaturas = $retencaofatura->editar($dados,$id);
        $cartaoponto = $cartaoponto->editar($dados,$id);
        $parametrosefips = $parametrosefip->editar($dados,$id);
        $taxatrabalhador = $taxatrabalhador->editar($dados,$id);
        $indicefaturas = $indicefatura->editar($dados,$id);
        $taxas = $taxa->editar($dados,$id);
        if ($tomadors && $enderecos && $taxas
        && $bancarios && $retencaofaturas && 
        $cartaoponto && $parametrosefips && 
        $taxatrabalhador && $indicefaturas) {
            $condicao = 'edittrue';
        }else{
            $condicao = 'editfalse';
        }
        return redirect()->route('tomador.index')->withInput()->withErrors([$condicao]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tomador = new Tomador;
        $endereco = new Endereco;
        $taxa = new Taxa;
        $bancario = new Bancario;
        $retencaofatura = new RetencaoFatura;
        $cartaoponto = new CartaoPonto;
        $parametrosefip = new Parametrosefip;
        $taxatrabalhador = new TaxaTrabalhador;
        $indicefatura = new IndiceFatura; 
        $enderecos = $endereco->deletar($id); 
        $bancarios = $bancario->deletar($id);
        $retencaofaturas = $retencaofatura->deletar($id);
        $cartaoponto = $cartaoponto->deletar($id);
        $parametrosefips = $parametrosefip->deletar($id);
        $taxatrabalhador = $taxatrabalhador->deletar($id);
        $indicefaturas = $indicefatura->deletar($id);
        $taxas = $taxa->deletar($id);
        if ($enderecos && $taxas
        && $bancarios && $retencaofaturas && 
        $cartaoponto && $parametrosefips && 
        $taxatrabalhador && $indicefaturas) {
            $tomadors = $tomador->deletar($id);
            $condicao = 'deletatrue';
        }else{
            $condicao = 'deletafalse';
        }
        return redirect()->route('tomador.index')->withInput()->withErrors([$condicao]);
    }
}
