<?php

namespace App\Http\Controllers\CalculoFolha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Folhar\Validacao;
use DataTables;
use App\Folhar;
use App\BaseCalculo;
use App\Empresa;

class calculoFolhaController extends Controller
{
    private $folhar,$basecalculo,$empresa;
    public function __construct()
    {
        $this->folhar = new Folhar;
        $this->basecalculo = new BaseCalculo;
        $this->empresa = new Empresa;
    }
    public function index()
    {
        $user = Auth::user();
        $empresa = $this->empresa->where('id',$user->empresa_id)->first();
        $idfolhas = [];
        $folhas = $this->folhar->buscaListaFolhar($user->empresa_id);
        foreach ($folhas as $key => $folha) {
            array_push($idfolhas,$folha->id);
        }
        $trabalhadores = $this->basecalculo->listaTrabalhador($idfolhas);
        $tomadores = $this->basecalculo->listaTomador($idfolhas,'asc');
    
        return view('calculofolha.index',compact('empresa','user','folhas','trabalhadores','tomadores'));
    }
    public function store(Validacao $request)
    {
        $dados = $request->all();
        $user = auth()->user();
        $permissions = Permission::where('name','like','%'.'mcfc'.'%')->first(); 
        if ($user->hasPermissionTo($permissions->name) === false && $user->hasPermissionTo('admin') === false){
            return redirect()->back()->withInput()->withErrors(['permissaonegada'=>'true']);
        }
      
        $dados = $request->only('ano_inicial','ano_final','competencia');
        return redirect()->route('calculo.folha.geral',$dados);
    }
    public function filtroPesquisaTomador(Request $request)
    {
        $user = Auth::user();
        $esocial =  DB::table('tomadors')
            ->join('base_calculos', 'tomadors.id', '=', 'base_calculos.tomador_id')
            ->join('folhars', 'folhars.id', '=', 'base_calculos.folhar_id')
            ->select('folhars.*','tomadors.tsnome','base_calculos.tomador_id')
            ->where('folhars.empresa_id',$user->empresa_id)
            ->distinct()
            ->get();
        return DataTables::of($esocial)
        ->addColumn('tomador_id', function($id) {
            // dd($id);
            $trabalhadores = $this->basecalculo->where([
                ['folhar_id',$id->id],
                ['tomador_id',$id->tomador_id]
            ])
            ->with('trabalhador:id,tsnome')
            ->get();
            $opcoes = '';
            foreach ($trabalhadores as $key => $trabalhador) {
                $opcoes .= "<option value='".$trabalhador->trabalhador->tsnome."'/>";
            }
        $recibo = '  <a class="btn btn__recibo" data-bs-toggle="offcanvas" href="#tomador_trabalhador'.$id->id.'" role="button" aria-controls="offcanvasExample">
                        <i class="icon__color fad fa-print"></i>
                    </a>
                    
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="tomador_trabalhador'.$id->id.'" aria-labelledby="offcanvasExampleLabel">
                    
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title text-white" id="offcanvasExampleLabel'.$id->id.'"><i class="fad fa-file-alt"></i> Recibo por Trabalhador</h5>
                            <i class="fas fa-2x fa-times icon__exit--side--bar" data-bs-dismiss="offcanvas"></i>
                        </div>
                        
                        <form action="'.route('calculo.folha.tomador.trabalhador.imprimir').'" method="post">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                                
                            <div class="offcanvas-body off__canvas--body">
                                
                                <div class="col-md-12 col-12 mt-2 p-1 pesquisar">
                                    <div class="d-flex">
                                        <label for="exampleDataList" class="form-label"></label>
                                       
                            
                                            <input type="hidden" name="folhar" value="'.$id->id.'">
                                            
                                          
                                        <input type="hidden" name="tomador" value="'.$id->tomador_id.'">
                                        
                                        <input type="hidden" name="empresa" value="'.$id->empresa_id.'">
                                        <input class="form-control pesquisa" list="listatomador'.$id->id.'" name="trabalhador" id="trabalhador1" placeholder="duplo clique para pesquisar">
                                        <datalist id="listatomador'.$id->id.'"> 
                                            '.$opcoes.'
                                        </datalist>
                                        
                                        <button type="submit" class="btn botao__search" id="butao_trabalhador">
                                            <i class="icon__search fas fa-search fa-md" id="icon"></i>
                                        </button>

                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>';
            return [
                'relatorio'=>' <div class="dropdown">
                                <button class="btn btn__relatorio modal-botao dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="icon__color fas fa-file-alt"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item modal-botao" href="'.route('folhar.tomador.resumo.pagamento',[base64_encode($id->tomador_id),base64_encode($id->id)]).'"><i class="fas fa-file"></i> Resumo Folha de Pagamento</a></li>
                                    <li><a class="dropdown-item modal-botao" href="'.route('folhar.tomador.evento.1270',[base64_encode($id->tomador_id),base64_encode($id->id)]).'"><i class="fad fa-file-invoice"></i> Resumo Evento s-1270</a></li>
                                </ul>
                            </div>',
                'imprimim'=>' <a class="btn btn__imprimir" href="'.route('calculo.folha.tomador.imprimir',[base64_encode($id->id),base64_encode($id->tomador_id)]).'"><i class="icon__color fad fa-print"></i></a>',
                'analitica'=>' <a href="'.route('tomador.calculo.folha.analitica',[$id->id,$id->tomador_id]).'" class="btn btn__analitico"><i class="icon__color fad fa-analytics"></i></a>',
                'recibo'=> $recibo,
                'sefip'=>' <a href="'.route('gera.txt.sefip',[base64_encode($id->tomador_id),base64_encode($id->id),base64_encode($id->empresa_id)]).'" class="btn btn__sefip $dias"><i class="icon__color fad fa-file-alt"></i></a>'
            ];
        })
        ->rawColumns(['tomador_id.relatorio','tomador_id.imprimim','tomador_id.recibo','tomador_id.analitica','tomador_id.sefip'])
        ->make(true);
        // $idfolhas = [];
        // $dados = $request->all();
        // $dados['inicio'] = $dados['competencia'].'-01';
        // $dados['final'] = $dados['competencia'].'-31';
        // $folhas = $this->folhar->filtraListaTomador($dados,$user->empresa_id);
        // foreach ($folhas as $key => $folha) {
        //     array_push($idfolhas,$folha->id);
        // }
        // $trabalhadores = $this->basecalculo->listaTrabalhador($idfolhas);
        // $tomadores = $this->basecalculo->listaTomador($idfolhas,'asc');
        // return view('calculofolha.index',compact('user','folhas','trabalhadores','tomadores'));
        
    }
    public function filtroPesquisaGeral(Request $request)
    {
        $user = Auth::user();
        // $idfolhas = [];
        // $dados = $request->all();
        // $dados['inicio'] = $dados['competencia'].'-01';
        // $dados['final'] = $dados['competencia'].'-31';
        // $folhas = $this->folhar->filtraListaGeral($dados,$user->empresa_id);
        
        // foreach ($folhas as $key => $folha) {
        //     array_push($idfolhas,$folha->id);
        // }
        // $trabalhadores = $this->basecalculo->listaTrabalhador($idfolhas);
        // $tomadores = $this->basecalculo->listaTomador($idfolhas,'asc');
        // return view('calculofolha.index',compact('user','folhas','trabalhadores','tomadores'));
        // $esocial = DB::table('folhars')
        // ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar_id')
        // ->join('trabalhadors', function ($join) {
        //     $join->on('trabalhadors.id', '=', 'base_calculos.trabalhador_id')
        //     ->where('base_calculos.tomador_id','=',null);
        // })
        // ->select(
        //     'folhars.id',
        //     ''
        // )
        // // ->orderBy('fscodigo', 'asc')
        // ->distinct()
        // ->get();
        $esocial = $this->folhar->where('empresa_id',$user->empresa_id)->get();
        // dd($esocial);
        return DataTables::of($esocial)
        ->addColumn('id', function($id) {
            $trabalhadores = $this->basecalculo->where([
                ['folhar_id',$id->id],
                ['tomador_id',null]
            ])
            ->with('trabalhador:id,tsnome','trabalhador.bancario:trabalhador_id,bsbanco','valorcalculo:base_calculo_id,vsdescricao')
            ->get();
          
            $opcoes = '';
            $opcoes_rublicas = '';
            $opcoes_banco = '';
            foreach ($trabalhadores as $key => $trabalhador) {
    
                $opcoes .= "<option value='".$trabalhador->trabalhador->tsnome."'/>";
                $opcoes_rublicas .= "<option value='".$trabalhador->valorcalculo[0]->vsdescricao."'/>";
                $opcoes_banco .= "<option value='".$trabalhador->trabalhador->bancario[0]->bsbanco."'/>";
            }
            
            $recibo = '  <a class="btn btn__recibo" data-bs-toggle="offcanvas" href="#offcanvasExample1'.$id->id.'" role="button" aria-controls="offcanvasExample1">
                            <i class="icon__color fad fa-print"></i>
                        </a>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample1'.$id->id.'" aria-labelledby="offcanvasExampleLabel1">
                            
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title text-white" id="offcanvasExampleLabel1"><i class="fad fa-file-alt"></i> Recibo por Trabalhador</h5>
                                <i class="fas fa-2x fa-times icon__exit--side--bar" data-bs-dismiss="offcanvas"></i>
                            </div>
                            
                            <form action="'.route('calculo.folha.trabalhador.imprimir').'" method="post">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                                <div class="offcanvas-body off__canvas--body">
                                    
                                    <div class="col-md-12 col-12 mt-2 p-1 pesquisar">
                                        <div class="d-flex">
                                            <label for="exampleDataList" class="form-label"></label>
                                            <input type="hidden" name="folhar" value="'.$id->id.'">
                                            <input type="hidden" name="empresa" value="'.$id->empresa_id.'">
                                            <input type="text" class="form-control trabalhador" name="trabalhador"   list="lista'.$id->id.'" placeholder="duplo clique para pesquisar">
                                            
                                            <datalist id="lista'.$id->id.'">
                                               '.$opcoes.'
                                            </datalist>
                                            
                                            <button type="submit" class="btn botao__search" id="butao_trabalhador">
                                                <i class="icon__search fas fa-search fa-md" id="icon"></i>
                                            </button>

                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>';
            $rublica = '<a class="btn btn__rubricas" data-bs-toggle="offcanvas" href="#rublica'.$id->id.'" role="button" aria-controls="rublica">
                            <i class="icon__color fad fa-file-invoice"></i>
                        </a>
                        
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="rublica'.$id->id.'" aria-labelledby="offcanvasExampleLabel2">
                            
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasExampleLabel1"><i class="fad fa-file-edit"></i> Rúbricas</h5>
                                <i class="fas fa-2x fa-times icon__exit--side--bar" data-bs-dismiss="offcanvas"></i>
                            </div>
                            
                            <form action="'.route('calculo.folha.rublica.imprimir').'" method="post">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                                <div class="offcanvas-body off__canvas--body">

                                    <div class="col-md-12 col-12 mt-2 p-1 pesquisar">
                                        <div class="d-flex">
                                            <input type="hidden" name="folharublica" value="'.$id->id.'">
                                            <input type="hidden" name="empresarublica" value="'.$id->empresa_id.'">
                                            <input type="hidden" name="inicio" value="'.$id->fsinicio.'">
                                            <input type="hidden" name="final" value="'.$id->fsfinal.'">
                                            <label for="exampleDataList" class="form-label"></label>
                                            <input class="form-control" list="listarublica'.$id->id.'" data-id="{{$folhar->fscodigo}}" name="rublica" id="" placeholder="duplo clique para pesquisar">
                                            <datalist id="listarublica'.$id->id.'">
                                            '.$opcoes_rublicas.'
                                            </datalist>
                                            
                                            <button type="submit" class="btn botao__search">
                                                <i class="icon__search fas fa-search fa-md" id="icon"></i>
                                            </button>

                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>';
            $banco = ' <a class="btn btn__deposito" data-bs-toggle="offcanvas" href="#banco'.$id->id.'" role="button" aria-controls="banco">
                            <i class="icon__color fad fa-envelope-open-dollar"></i>
                        </a>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="banco'.$id->id.'" aria-labelledby="offcanvasExampleLabel2">
                            
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasExampleLabel1"><i class="fad fa-file-invoice-dollar"></i> Depósito por Banco</h5>
                                <i class="fas fa-2x fa-times icon__exit--side--bar" data-bs-dismiss="offcanvas"></i>
                            </div>
                            
                            <form action="'.route('calculo.folha.banco.imprimir').'" method="post">
                               
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <div class="offcanvas-body off__canvas--body">

                                    <div class="col-md-12 col-12 mt-2 p-1 pesquisar">
                                        <div class="d-flex">
                                            <input type="hidden" name="folharbanco" value="'.$id->id.'">
                                            <input type="hidden" name="empresabanco" value="'.$id->empresa_id.'">
                                            <label for="exampleDataList" class="form-label"></label>
                                            <input class="form-control banco" list="listabanco'.$id->id.'" name="banco" id="pesquisa" placeholder="duplo clique para pesquisar">
                                            <datalist id="listabanco'.$id->id.'">
                                            '.$opcoes_banco.'
                                            </datalist>
                                            
                                            <button type="submit" class="btn botao__search">
                                                <i class="icon__search fas fa-search fa-md" id="icon"></i>
                                            </button>

                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>';
            $excluir = '<a href="" class="btn button__excluir" data-bs-toggle="modal" data-bs-target="#deleteCalculoFolha'.$id->id.'"><i class="icon__color fad fa-trash"></i></a>
            <section class="delete__tabela--calculoFolha">
                <div class="modal fade" id="deleteCalculoFolha'.$id->id.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered col-8">
                        <div class="modal-content">
                            <form action="'.route('calculo.folha.deletar',$id->id).'" id="formdelete" method="get">
                                
                                <div class="modal-header header__modal">
                                    <h5 class="modal-title" id="rolDescontoTrabLabel"><i class="fad fa-trash"></i> Deletar</h5>
                                    <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
                                </div>
                                
                                <div class="modal-body body__modal ">
                                        <div class="d-flex align-items-center justify-content-center flex-column">
                                            <img class="gif__warning--delete" src="'.url('imagem/complain.png').'">
                                        
                                            <p class="content--deletar">Deseja realmente excluir?</p>
                                            
                                            <p class="content--deletar2">Obs: A exclusão pode afetar em outros cálculos.</p>
                                            
                                        </div>
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn botao__fechar--modal" data-bs-dismiss="modal"><i class="fad fa-times-circle"></i> Não</button>
                                    <button type="submit" class="btn botao__deletar--modal"><i class="fad fa-trash"></i> Deletar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>';
            return [
                'imprimim'=>' <a class="btn btn__imprimir" href="'.route('calculo.folha.imprimir',$id).'"><i class="icon__color fad fa-print"></i></a>',
                'analitica'=>' <a href="'.route('calculo.folha.analitica',$id).'" class="btn btn__analitico"><i class="icon__color fad fa-analytics"></i></a>',
                'evento'=>' <a class="btn btn__evento btn__padrao--evento" data-id="'.base64_encode($id->id).'" href="'.route('gera.evento.1200',$id).'"><i class="icon__color fas fa-file-invoice"></i></a>',
                'recibo'=> $recibo,
                'rublicas'=>$rublica,
                'banco'=>$banco,
                'excluir'=>$excluir
            ];
        })
        ->rawColumns(['id.imprimim','id.analitica','id.evento','id.recibo','id.rublicas','id.banco','id.excluir'])
        ->make(true);
        
    }
    

    public function filtroPesquisaOrdem($condicao)
    {
        $user = Auth::user();
        $idfolhas = [];
        $folhas = $this->folhar->buscaListaOrdem($user->empresa_id,$condicao);
        
        foreach ($folhas as $key => $folha) {
            array_push($idfolhas,$folha->id);
        }
        $trabalhadores = $this->basecalculo->listaTrabalhador($idfolhas);
        $tomadores = $this->basecalculo->listaTomador($idfolhas,$condicao);
        return view('calculofolha.index',compact('user','folhas','trabalhadores','tomadores'));
    }
}
