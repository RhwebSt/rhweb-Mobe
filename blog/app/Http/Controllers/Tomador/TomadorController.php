<?php

namespace App\Http\Controllers\Tomador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tomador;
use App\Taxa;
use App\Endereco;
use App\Bancario;
use App\RetencaoFatura;
use App\CartaoPonto;
use App\Parametrosefip;
use App\TaxaTrabalhador;
use App\IndiceFatura;
use App\TabelaPreco;
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
        $user = Auth::user();
        return view('tomador.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('tomador.create',compact('user'));
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
        $enderecos = $endereco->editar($dados,$dados['endereco']); 
        $bancarios = $bancario->editar($dados,$dados['bancario']);
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
        $tabelapreco = new TabelaPreco;
       $campoendereco = 'tomador';
       $campobacario = 'tomador';
       $bancarios = $bancario->first($id,$campobacario);
    //    dd($bancarios);
       $exbancarios = $bancario->deletar($bancarios->biid);

        $tabelaprecos = $tabelapreco->deletar($id);

        $enderecos = $endereco->first($id,$campoendereco); 
        // dd($enderecos);
        $exenderecos = $endereco->deletar($enderecos->eiid); 

       

        $retencaofaturas = $retencaofatura->deletar($id);
        $cartaoponto = $cartaoponto->deletar($id);
        $parametrosefips = $parametrosefip->deletar($id);
        $taxatrabalhador = $taxatrabalhador->deletar($id);
        $indicefaturas = $indicefatura->deletar($id);
        $taxas = $taxa->deletar($id);
        if ($exenderecos && $taxas
        && $exbancarios && $retencaofaturas && 
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
