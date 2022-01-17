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
use App\IncideFolhar;
use App\IndiceFatura;
use App\TabelaPreco;
use App\Bolcartaoponto;
use App\Lancamentorublica;
use App\Lancamentotabela;
use App\Comissionado;
use App\ValoresRublica;
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
        $valorrublica = new ValoresRublica;
        $valorrublica_matricular = $valorrublica->buscaUnidadeEmpresa($user->empresa);
        return view('tomador.index',compact('user','valorrublica_matricular'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        // return view('tomador.create',compact('user'));
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
        $user = auth()->user();
        $tomador = new Tomador;
        $valorrublica = new ValoresRublica;
        $request->validate([
            'nome__completo' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'nome__fantasia' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'cnpj' => 'required|max:19|cnpj',
            'matricula'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'simples'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'telefone'=>'required|max:16',
            'cep'=>'required|max:16|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'logradouro'=>'required|max:50|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'numero'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'bairro'=>'required:max:40|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'localidade'=>'required|max:30|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'uf'=>'required|max:2|uf|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'taxa_adm'=>'required',
            'taxa__fed'=>'required',
            'deflator'=>'required|max:100',
            'das'=>'required',
            'cod__fpas'=>'required',
            // 'cod__fap'=>'required',
            'cod__grps'=>'required',
            'cod__recol'=>'required',
            'cnae'=>'required',
            'fap__aliquota'=>'required',
            'rat__ajustado'=>'required',
            'fpas__terceiros'=>'required',
            'aliq__terceiros'=>'required',
            'alimentacao'=>'required',
            'transporte'=>'required',
            'epi'=>'required',
            'seguro__trabalhador'=>'required',
            'folhartransporte'=>'required',
            'folhartipotrans'=>'required',
            'folharalim'=>'required',
            'folhartipoalim'=>'required',
            'dias_uteis'=>'max:5',
            'sabados'=>'max:5',
            'domingos'=>'max:5',
            // 'inss__empresa'=>'required',
            // 'retencaoinss'=>'required',
            // 'fgts__empresa'=>'required',
            // 'retencaofgts'=>'required',
            // 'valor_fatura'=>'required',
            'banco'=>'max:100',
            'agencia'=>'max:4',
            'operacao'=>'max:3',
            'conta'=>'max:10',
            'pix'=>'max:255'
        ]
        );
        // $tomadores = $tomador->verificaCadastroCnpj($dados);
        // if ($tomadores) {
        //     return redirect()->back()->withErrors(['cnpj'=>'Este CNPJ já esta cadastrador.']);
        // }
        $taxa = new Taxa;
        $endereco = new Endereco;
        $bancario = new Bancario;
        // $retencaofatura = new RetencaoFatura;
        $cartaoponto = new CartaoPonto;
        $parametrosefip = new Parametrosefip;
        $incidefolhar = new IncideFolhar;
        // $taxatrabalhador = new TaxaTrabalhador;
        $indicefatura = new IndiceFatura; 
        try {
            $tomadors = $tomador->cadastro($dados);
            if ($tomadors) {
                $dados['tomador'] = $tomadors['id'];
                $incidefolhars = $incidefolhar->cadastro($dados);
                $enderecos = $endereco->cadastro($dados); 
                $taxas = $taxa->cadastro($dados);
                $bancarios = $bancario->cadastro($dados);
                // $retencaofaturas = $retencaofatura->cadastro($dados);
                $cartaoponto = $cartaoponto->cadastro($dados);
                $parametrosefips = $parametrosefip->cadastro($dados);
                // $taxatrabalhador = $taxatrabalhador->cadastro($dados);
                $indicefaturas = $indicefatura->cadastro($dados);
                $valorrublica->editarMatricularTomador($dados,$user->empresa);
                return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
            }
        
        } catch (\Throwable $th) {
            $cartaoponto = $cartaoponto->deletar($dados['tomador']);
            $parametrosefips = $parametrosefip->deletar($dados['tomador']);
            $indicefaturas = $indicefatura->deletar($dados['tomador']);
            $taxas = $taxa->deletar($dados['tomador']);
            $incidefolhars = $incidefolhar->deletar($dados['tomador']);
            $endereco->deletarTomador($dados['tomador']);
            $bancario->deletarTomador($dados['tomador']);
            $tomador->deletar($dados['tomador']); 
            return redirect()->route('tomador.index')->withInput()->withErrors(['false'=>'Não foi prossível cadastrar.']);
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
    public function pesquisa($id)
    {
        $tomador = new Tomador;
        $tomadors = $tomador->pesquisa($id);
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
        $request->validate([
            'nome__completo' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'nome__fantasia' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'cnpj' => 'required|max:19|cnpj',
            'matricula'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'simples'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'telefone'=>'required|max:16',
            'cep'=>'required|max:16|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'logradouro'=>'required|max:50|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'numero'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'bairro'=>'required:max:40|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'localidade'=>'required|max:30|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'uf'=>'required|max:2|uf|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'taxa_adm'=>'required',
            'taxa__fed'=>'required',
            'deflator'=>'required|max:100',
            'das'=>'required',
            'cod__fpas'=>'required',
            // 'cod__fap'=>'required',
            'cod__grps'=>'required',
            'cod__recol'=>'required',
            'cnae'=>'required',
            'fap__aliquota'=>'required',
            'rat__ajustado'=>'required',
            'fpas__terceiros'=>'required',
            'aliq__terceiros'=>'required',
            'alimentacao'=>'required',
            'transporte'=>'required',
            'epi'=>'required',
            'seguro__trabalhador'=>'required',
            'folhartransporte'=>'required',
            'folhartipotrans'=>'required',
            'folharalim'=>'required',
            'folhartipoalim'=>'required',
            'dias_uteis'=>'max:5',
            'sabados'=>'max:5',
            'domingos'=>'max:5',
            // 'inss__empresa'=>'required',
            // 'retencaoinss'=>'required',
            // 'fgts__empresa'=>'required',
            // 'retencaofgts'=>'required',
            // 'valor_fatura'=>'required',
            'banco'=>'max:100',
            'agencia'=>'max:4',
            'operacao'=>'max:3',
            'conta'=>'max:10',
            'pix'=>'max:255'
        ],
        // [
        //     'nome__completo.required'=>'Campo não pode esta vazio!',
        //     'matricula.required'=>'Campo não pode esta vazio!',
        //     'matricula.max'=>'A matricula não pode ter mais de 4 caracteris!',
        //     'num__trabalhador.required'=>'Campo não pode esta vazio!',
        //     'num__trabalhador.numeric'=>'O campo naõ pode conter letras',
        //     'liboletim.required'=>'Campo não pode esta vazio!',
        //     'liboletim.numeric'=>'O campo naõ pode conter letras',
        //     'data.required'=>'O campo não pode esta vazio!'
            
        // ]
        );
        $tomador = new Tomador;
        $endereco = new Endereco;
        $taxa = new Taxa;
        $bancario = new Bancario;
        // $retencaofatura = new RetencaoFatura;
        $cartaoponto = new CartaoPonto;
        $parametrosefip = new Parametrosefip;
        $incidefolhar = new IncideFolhar;
        // $taxatrabalhador = new TaxaTrabalhador;
        $indicefatura = new IndiceFatura; 
      
        try {
            $tomadors = $tomador->editar($dados,$id);
            $enderecos = $endereco->editar($dados,$dados['endereco']); 
            $bancarios = $bancario->editar($dados,$dados['bancario']);
            // $retencaofaturas = $retencaofatura->editar($dados,$id);
            $cartaoponto = $cartaoponto->editar($dados,$id);
            $parametrosefips = $parametrosefip->editar($dados,$id);
            // $taxatrabalhador = $taxatrabalhador->editar($dados,$id);
            $indicefaturas = $indicefatura->editar($dados,$id);
            $incidefolhars = $incidefolhar->editar($dados,$id);
            $taxas = $taxa->editar($dados,$id);
            // dd($tomadors , $enderecos , $taxas
            // , $bancarios , $retencaofaturas , 
            // $cartaoponto , $parametrosefips , $indicefaturas);
            if ($tomadors && $enderecos && $taxas
            && $bancarios  && $incidefolhars &&
            $cartaoponto && $parametrosefips && $indicefaturas) {
                return redirect()->back()->withSuccess('Atualizador com sucesso.'); 
                
            }
        } catch (\Throwable $th) {
            return redirect()->route('tomador.index')->withInput()->withErrors(['false'=>'Não foi porssível atualizar os dados.']);
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
        
        $tomador = new Tomador;
        $endereco = new Endereco;
        $taxa = new Taxa;
        $comissionado = new Comissionado;
        $bancario = new Bancario;
        $retencaofatura = new RetencaoFatura;
        $cartaoponto = new CartaoPonto;
        $parametrosefip = new Parametrosefip;
        $incidefolhar = new IncideFolhar;
        // $taxatrabalhador = new TaxaTrabalhador;
        $indicefatura = new IndiceFatura; 
        $tabelapreco = new TabelaPreco;
        $valorrublica = new ValoresRublica;
        $bolcartaoponto = new Bolcartaoponto;
        $lancamentorublica = new Lancamentorublica;
        $lancamentotabela = new Lancamentotabela;
        $user = auth()->user();
        $dados = ['matricula'=>''];
        $lancamentotabelas = $lancamentotabela->buscaTomador($id);
        
            foreach ($lancamentotabelas as $key => $value) {
                $bolcartaopontos = $bolcartaoponto->deletar($value->id);
                $lancamentorublicas = $lancamentorublica->deletar($value->id);
            }
            
            $campoendereco = 'tomador';
            $campobacario = 'tomador';
            $lancamentotabelas = $lancamentotabela->deletarTomador($id);
            $comissionados = $comissionado->deletaTomador($id);
            $bancarios = $bancario->first($id,$campobacario);
            $exbancarios = $bancario->deletar($bancarios->biid);
            $tabelaprecos = $tabelapreco->deletatomador($id);
            $enderecos = $endereco->first($id,$campoendereco); 
            $exenderecos = $endereco->deletar($enderecos->eiid); 
            // $retencaofaturas = $retencaofatura->deletar($id);
            $cartaoponto = $cartaoponto->deletar($id);
            $parametrosefips = $parametrosefip->deletar($id);
            // $taxatrabalhador = $taxatrabalhador->deletar($id);
            $indicefaturas = $indicefatura->deletar($id);
            $taxas = $taxa->deletar($id);
            $incidefolhars = $incidefolhar->deletar($id);
            $tomadors = $tomador->deletar($id); 
            $valorrublica_matricular = $valorrublica->buscaUnidadeEmpresa($user->empresa);
            if (isset($valorrublica_matricular->vimatriculartomador)) {
                $dados['matricula'] =  $valorrublica_matricular->vimatriculartomador - 1;
                $valorrublica->editarMatricularTomador($dados,$user->empresa);
            }
            return redirect()->back()->withSuccess('Deletado com sucesso.'); 
        try {
            
        } catch (\Throwable $th) {
            return redirect()->route('tomador.index')->withInput()->withErrors(['false'=>'Não foi porssível deletar o registro.']);
        }
    }
}
