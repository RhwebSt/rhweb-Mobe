<?php

namespace App\Http\Controllers\Tomador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ValidacaoTomador;
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
use App\Rublica;
use App\BaseCalculo;
use App\Empresa;
use DataTables;
class TomadorController extends Controller
{
    private $rublica,$tomador,$valorrublica,$taxa,$endereco,$bancario,
    $tabelapreco,$cartaoponto,$parametrosefip,$incidefolhar,$indicefatura,
    $comissionado,$retencaofatura,$bolcartaoponto,$lancamentorublica,$lancamentotabela
    ,$basecalculo,$empresa;
    public function __construct()
    {
        $this->rublica = new Rublica;
        $this->tomador = new Tomador;
        $this->valorrublica = new ValoresRublica;
        $this->taxa = new Taxa;
        $this->endereco = new Endereco;
        $this->bancario = new Bancario;
        $this->tabelapreco = new TabelaPreco;
        $this->cartaoponto = new CartaoPonto;
        $this->parametrosefip = new Parametrosefip;
        $this->incidefolhar = new IncideFolhar;
        $this->indicefatura = new IndiceFatura; 
        $this->comissionado = new Comissionado;
        $this->retencaofatura = new RetencaoFatura;
        $this->bolcartaoponto = new Bolcartaoponto;
        $this->lancamentorublica = new Lancamentorublica;
        $this->lancamentotabela = new Lancamentotabela;
        $this->basecalculo = new BaseCalculo;
        $this->empresa = new Empresa;
    }
    public function index()
    {
        
    }
    public function ordem($ordem,$id = null,$search = null)
    {
        $user = Auth::user();
        $tomadors = $this->tomador->buscaListaTomadorPaginate($search,$ordem);
        if ($id) {
            $tomador = $this->tomador->first($id);
            return view('tomador.edit',compact('user','tomador','tomadors'));
        }else{
            $valorrublica_matricular = $this->valorrublica->buscaUnidadeEmpresa($user->empresa_id);
            
            return view('tomador.index',compact('user','valorrublica_matricular','tomadors'));
        }
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
        $condicao = request('codicao');
        $tomadors = $this->tomador 
        ->where(function($query) use ($search,$user){
          
            if ($search) {
                $query->orWhere([
                    ['tomadors.tsnome','like','%'.$search.'%'],
                    ['tomadors.empresa_id', $user->empresa_id]
                ])
                ->orWhere([
                    ['tomadors.tscnpj','like','%'.$search.'%'],
                    ['tomadors.empresa_id', $user->empresa_id]
                    ])
                ->orWhere([
                    ['tomadors.tsmatricula','like','%'.$search.'%'],
                    ['tomadors.empresa_id', $user->empresa_id]
                ]);
            }else{
                $query->where('empresa_id', $user->empresa_id);
            }   
        })
        ->orderBy('tsnome','asc') 
        ->orderBy('tsmatricula','asc')
        ->distinct()
        ->paginate(10);
        // dd($tomadors);
        $valorrublica_matricular = $this->empresa->where('id',$user->empresa_id)->with('valoresrublica')->first();
        if ($condicao) {
            $tomador = $this->tomador->first($condicao);
            return view('tomador.edit',compact('user','tomador','tomadors'));
        }else{
            // $valorrublica_matricular = $this->valorrublica->buscaUnidadeEmpresa($user->empresa_id);
            // dd($valorrublica_matricular);
            return view('tomador.index',compact('user','valorrublica_matricular','tomadors'));
        }
    }

    public function lista()
    {
        $user = auth()->user();
        $tomadors = $this->tomador->where('empresa_id',$user->empresa_id)->get(); 
        return DataTables::of($tomadors)
        ->addColumn('id', function($id) {
            return[
                'tabelapreco'=>'<a class="btn btn__tabela--preco" href="'.route('tabelapreco.index',[' ',base64_encode($id->id)]).'" class=""><i class="icon__color fas fa-dollar-sign"></i></a>',
                'relatorio'=>' <div class="dropdown">
                                    <button class="btn btn__relatorio dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="icon__color fas fa-file-alt"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#" onclick="botaoModal ('."'".$id->id."'".')"><i class="fas fa-file"></i> Rol dos Boletins</a></li>
                                        <li><a class="dropdown-item" href="'.route('tabela.preco.relatorio',base64_encode($id->id)).'"><i class="fas fa-dollar-sign"></i> Rol da Tabela de preço</a></li>
                                    </ul>
                                </div>',
                'evento'=>' <a class="btn__evento  btn btn__padrao--evento_tomador"  data-id="'.base64_encode($id->id).'" href="'.route('esocial.tomador',base64_encode($id->id)).'" class=""><i class="icon__color fas fa-file-invoice"></i></a>',
                'editar'=>'<a class="button__editar btn" href="'.route('tomador.editar',base64_encode($id->id)).'"><i class="icon__color fas fa-pen"></i></a>',
                'excluir'=>' <button class="btn button__excluir" data-bs-toggle="modal" data-bs-target="#deleteTomador'.$id->id.'"><i class="icon__color fad fa-trash"></i></button>
                            <section class="delete__tabela--tomador">
                                <div class="modal fade" id="deleteTomador'.$id->id.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered col-8">
                                        <div class="modal-content">
                                            <form action="'.route('tomador.deletar',$id->id).'" id="formdelete" method="post">
                                            <input type="hidden" name="_token" value="'.csrf_token().'">
                                            <input type="hidden" name="method" value="delete">
                                                <div class="modal-header header__modal">
                                                    <h5 class="modal-title" id="rolDescontoTrabLabel"><i class="fad fa-trash"></i> Deletar</h5>
                                                    <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
                                                </div>
                                                
                                                <div class="modal-body body__modal ">
                                                        <div class="d-flex align-items-center justify-content-center flex-column">
                                                            <img class="gif__warning--delete" src="'.url('imagem/complain.png').'">
                                                        
                                                            <p class="content--deletar">Deseja realmente excluir?</p>
                                                            
                                                            <p class="content--deletar2">Obs: Será excluído tudo o que está vinculado á este tomador.</p>
                                                            
                                                        </div>
                                                </div>
                                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn botao__fechar--modal" data-bs-dismiss="modal"><i class="fad fa-times-circle"></i> Não</button>
                                                    <button type="submit" class="btn botao__deletar--modal  modal-botao"><i class="fad fa-trash"></i> Deletar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </section>'
            ];
        })
        ->rawColumns(['id.tabelapreco','id.relatorio','id.evento','id.editar','id.excluir'])
        ->make(true);
    }
    public function store(ValidacaoTomador $request)
    {
        $dados = $request->all(); 
        $user = Auth::user();
        
        if ($dados['banco']) {
            $request->validate(['banco'=>'regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9-.]*$/']);
        }
        if($dados['pix']){
            $request->validate(['pix'=>'regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9]*$/']);
        }
        if ($dados['nome__fantasia']) {
            $request->validate(['nome__fantasia'=>'regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ ]*$/']);
        }
        // $tomadores = $this->tomador->verificaCadastroCnpj($dados);
        $tomador = $this->tomador->where([
            ['tscnpj',$dados['cnpj']],
            ['empresa_id',$user->empresa_id]
        ])->count();
        
        if ($tomador) {
            return redirect()->back()->withErrors(['cnpj'=>'Este CNPJ já está cadastrado.']);
        }
       
        $rublicas = $this->rublica->listaRublicaTabelaPreco(); 
        if (!$rublicas) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não existe nenhuma rúbrica, contacte o suporte.']);
        }
            $tomadors = $this->tomador->cadastro($dados);
            if ($tomadors) {
                $dados['tomador'] = $tomadors['id'];
                foreach ($rublicas as $key => $rublica) {
                    $dadostabelapreco = [
                        'ano'=>date('Y'),
                        'rubricas'=>$rublica->rsrublica,
                        'descricao'=>$rublica->rsdescricao,
                        'status'=>'',
                        'valor'=>0,
                        'valor__tomador'=>0,
                        'empresa'=>$user->empresa_id,
                        'tomador'=>$tomadors['id']
                    ];
                    $this->tabelapreco->cadastro($dadostabelapreco);
                }
                $incidefolhars = $this->incidefolhar->cadastro($dados);
                $enderecos = $this->endereco->cadastro($dados); 
                $taxas = $this->taxa->cadastro($dados);
                $bancarios = $this->bancario->cadastro($dados);
                // $retencaofaturas = $retencaofatura->cadastro($dados);
                $cartaoponto = $this->cartaoponto->cadastro($dados);
                $parametrosefips = $this->parametrosefip->cadastro($dados);
                // $taxatrabalhador = $taxatrabalhador->cadastro($dados);
                $indicefaturas = $this->indicefatura->cadastro($dados);
                // $this->valorrublica->editarMatricularTomador($dados,$user->empresa_id);
                $this->valorrublica->where('empresa_id', $user->empresa_id)
                ->chunkById(100, function ($valorrublica) use ($user) {
                    foreach ($valorrublica as $valorrublicas) {
                        if ($valorrublicas->vimatriculartomador >= 0) {
                            $numero = $valorrublicas->vimatriculartomador += 1;
                            $this->valorrublica->where('empresa_id', $user->empresa_id)
                            ->update(['vimatriculartomador'=>$numero]);
                        }
                    }
                });
                return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
            }
            try {
        } catch (\Throwable $th) {
            // $cartaoponto = $this->cartaoponto->deletar($dados['tomador']);
            // $parametrosefips = $this->parametrosefip->deletar($dados['tomador']);
            // $indicefaturas = $this->indicefatura->deletar($dados['tomador']);
            // $taxas = $this->taxa->deletar($dados['tomador']);
            // $incidefolhars = $this->incidefolhar->deletar($dados['tomador']);
            // $this->endereco->deletarTomador($dados['tomador']);
            // $this->bancario->deletarTomador($dados['tomador']);
            // $this->tabelapreco->deletatomador($dados['tomador']);
            $this->valorrublica->where('empresa_id', $user->empresa_id)
            ->chunkById(100, function ($valorrublica) use ($user) {
                foreach ($valorrublica as $valorrublicas) {
                    if ($valorrublicas->vimatriculartomador > 0) {
                        $numero = $valorrublicas->vimatriculartomador -= 1;
                        $this->valorrublica->where('empresa_id', $user->empresa_id)
                        ->update(['vimatriculartomador'=>$numero]);
                    }
                }
            });
            $this->tomador->deletar($dados['tomador']); 
            return redirect()->route('tomador.index')->withInput()->withErrors(['false'=>'Não foi possível cadastrar.']);
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
        
       
        $tomadors = $this->tomador->first($id);
        return response()->json($tomadors);
    }
    public function pesquisa($id)
    {
        // $tomadors = $this->tomador->pesquisa($id);
        
        $tomadors = $this->tomador->where(function($query) use ($id){
            $user = auth()->user();
            if ($id) {
                $query->where([
                       ['tsnome','like','%'.$id.'%'],
                       ['tomadors.empresa_id', $user->empresa_id]
                   ])
                   ->orWhere([
                       ['tscnpj',$id],
                       ['tomadors.empresa_id', $user->empresa_id],
                   ])
                //    ->orWhere([
                //        ['tomadors.id',$id],
                //        ['tomadors.empresa_id', $user->empresa_id],
                //    ])
                   ->orWhere([
                       ['tsmatricula',$id],
                       ['tomadors.empresa_id', $user->empresa_id],
                   ]);
               }else{
                   $query->where([
                       ['tomadors.id','>',$id],
                       ['tomadors.empresa_id', $user->empresa_id]
                   ]);
               }
           
        })
        ->orderBy('tsnome','asc')
        ->distinct()
        ->get();
        // dd($tomadors);
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
        $id = base64_decode($id);
        $user = Auth::user();
        $search = request('search');
        // $tomador = $this->tomador->first($id);
        $tomador = $this->tomador->where('id',$id)
        ->with(['taxa','endereco','bancario','cartaoponto','parametrosefip','indicefatura','incidefolhar'])->first();
        $tomadors = $this->tomador 
        ->where(function($query) use ($search,$user){
            if ($search) {
                $query->orWhere([
                    ['tomadors.tsnome','like','%'.$search.'%'],
                    ['tomadors.empresa_search', $user->empresa]
                ])
                ->orWhere([
                    ['tomadors.tscnpj','like','%'.$search.'%'],
                    ['tomadors.empresa_search', $user->empresa]
                    ])
                ->orWhere([
                    ['tomadors.tsmatricula','like','%'.$search.'%'],
                    ['tomadors.empresa_id', $user->empresa]
                ]);
            }else{
                $query->where('empresa_id', $user->empresa_id);
            }   
        })
        ->orderBy('tsnome','asc') 
        ->orderBy('tsmatricula','asc')
        ->distinct()
        ->paginate(20);
        return view('tomador.edit',compact('user','tomador','tomadors'));
    }
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacaoTomador $request, $id)
    {
        $dados = $request->all();
        if ($dados['banco']) {
            $request->validate(['banco'=>'regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9-.]*$/']);
        }
        if($dados['pix']){
            $request->validate(['pix'=>'regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9]*$/']);
        }
        if ($dados['nome__fantasia']) {
            $request->validate(['nome__fantasia'=>'regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ ]*$/']);
        }
        try {
            $tomadors = $this->tomador->editar($dados,$id);
            $enderecos = $this->endereco->editar($dados,$dados['endereco']); 
            $bancarios = $this->bancario->editar($dados,$dados['bancario']);
            // $retencaofaturas = $retencaofatura->editar($dados,$id);
            $cartaoponto = $this->cartaoponto->editar($dados,$id);
            $parametrosefips = $this->parametrosefip->editar($dados,$id);
            // $taxatrabalhador = $taxatrabalhador->editar($dados,$id);
            $indicefaturas = $this->indicefatura->editar($dados,$id);
            $incidefolhars = $this->incidefolhar->editar($dados,$id);
            $taxas = $this->taxa->editar($dados,$id);
            return redirect()->back()->withSuccess('Atualizado com sucesso.'); 
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível atualizar.']);
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
        $user = auth()->user();
        $tomador = $this->basecalculo->where('tomador_id',$id)->count();
        if ($tomador) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Este tomador não pode ser deletado.']);
        }
        $this->valorrublica->where('empresa_id', $user->empresa_id)
        ->chunkById(100, function ($valorrublica) use ($user) {
            foreach ($valorrublica as $valorrublicas) {
                if ($valorrublicas->vimatriculartomador > 0) {
                    $numero = $valorrublicas->vimatriculartomador -= 1;
                    $this->valorrublica->where('empresa_id', $user->empresa_id)
                    ->update(['vimatriculartomador'=>$numero]);
                }
            }
        });
        $tomadors = $this->tomador->deletar($id); 
        // $dados = ['matricula'=>''];
        // $lancamentotabelas = $this->lancamentotabela->buscaTomador($id);
        
        //     foreach ($lancamentotabelas as $key => $value) {
        //         $bolcartaopontos = $this->bolcartaoponto->deletar($value->id);
        //         $lancamentorublicas = $this->lancamentorublica->deletar($value->id);
        //     }
            
        //     $campoendereco = 'tomador';
        //     $campobacario = 'tomador';
        //     $lancamentotabelas = $this->lancamentotabela->deletarTomador($id);
        //     $comissionados = $this->comissionado->deletaTomador($id);
        //     $exbancarios = $this->bancario->deletarTomador($id);
        //     $tabelaprecos = $this->tabelapreco->deletatomador($id);
        //     $exenderecos = $this->endereco->deletarTomador($id); 
        //     $cartaoponto = $this->cartaoponto->deletar($id);
        //     $parametrosefips = $this->parametrosefip->deletar($id);
        //     $indicefaturas = $this->indicefatura->deletar($id);
        //     $taxas = $this->taxa->deletar($id);
        //     $incidefolhars = $this->incidefolhar->deletar($id);
            
            // $valorrublica_matricular = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
            // if (isset($valorrublica_matricular->vimatriculartomador)) {
            //     $dados['matricula'] =  $valorrublica_matricular->vimatriculartomador - 1;
            //     $this->valorrublica->editarMatricularTomador($dados,$user->empresa);
            // }
            return redirect()->back()->withSuccess('Deletado com sucesso.'); 
        try {
            
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível deletar o registro.']);
        }
    }
}
