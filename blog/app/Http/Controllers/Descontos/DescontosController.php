<?php

namespace App\Http\Controllers\Descontos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Desconto\Validacao;
use Illuminate\Support\Facades\DB;
use App\Descontos;
use App\Empresa;
use App\Folhar;
use DataTables;
class DescontosController extends Controller
{
    private $folhar,$desconto,$empresa;
    public function __construct()
    {
        $this->folhar = new Folhar;
        $this->desconto = new Descontos;
        $this->empresa = new Empresa;
    }
    public function index()
    {
        $user = Auth::user();
        $search = request('search');
        $condicao = request('codicao');
        $descontos = $this->desconto->lista($user->empresa_id,$search,'asc');
        $empresa = $this->empresa->where('id',$user->empresa_id)->first();
        if ($condicao) {
            $dadosdescontos = $this->desconto->buscaUnidadeDesconto($condicao);
            return view('desconto.editDesconto',compact('user','descontos','dadosdescontos'));
        }
        
        return view('desconto.descontos',compact('user','empresa','descontos'));
    }

   
    public function create()
    {
        //
    }

    public function ordem($ordem,$id = null)
    {
       
        $user = Auth::user();
        $desconto = new Descontos;
        $descontos = $desconto->lista($user->empresa_id,null,$ordem);
        if ($id) {
            $dadosdescontos = $desconto->buscaUnidadeDesconto($id);
            return view('desconto.editDesconto',compact('user','descontos','dadosdescontos'));
        }
        
        return view('desconto.descontos',compact('user','descontos'));
    }
    public function lista()
    {
        $user = Auth::user();
        $desconto = $this->desconto
        ->join('trabalhadors', 'trabalhadors.id', '=', 'descontos.trabalhador_id')
        ->select(
            'descontos.*',
            'trabalhadors.tsnome',
            'trabalhadors.tsmatricula',
        )
        ->where('descontos.empresa_id',$user->empresa_id)
        ->get();
        return DataTables::of($desconto)
        ->addColumn('dfvalor', function($dfvalor) {
            return 'R$ '.number_format((float)$dfvalor->dfvalor, 2, ',', '.');
        })
        ->addColumn('id', function($id) {
            return[
                'relatorio'=>' <div class="dropdown">
                                <button class="btn btn__relatorio dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="icon__color fas fa-file-alt"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li class=""><a class="dropdown-item text-decoration-none ps-2 text-capitalize" onclick ="botaoModal()"  id="imprimir" role="button">Rol dos Descontos <i class="fas fa-file"></i></a></li>
                                    <li class=""><a class="dropdown-item text-decoration-none ps-2 text-capitalize"  id="imprimir" data-bs-toggle="modal" data-bs-target="#rolDescontoTrab'.$id->id.'" role="button">Rol dos Descontos - Por trabalhador <i class="fas fa-file"></i></a></li>
                                </ul>
                            </div>
                            <section class="modal__rol-descontos-trab">      
                                            <div class="modal fade" id="rolDescontoTrab'.$id->id.'" tabindex="-1" aria-labelledby="rolDescontoTrabLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered col-6">
                                                    <div class="modal-content">
                                                        <form action="'.route('descontos.relatorio.trabalhador').'" method="POST">
                                                        <input type="hidden" name="_token" value="'.csrf_token().'">
                                                            <input type="hidden" name="idtrabalhador" id="idtrabalhador" value="'.$id->trabalhador_id.'">
                                                            
                                                            <div class="modal-header header__modal">
                                                                <h5 class="modal-title" id="rolDescontoTrabLabel"><i class="fad fa-lg fa-percentage"></i> Rol dos Descontos - Por trabalhador</h5>
                                                                <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
                                                            </div>
                                                                
                                                            <div class="modal-body body__modal">
                                                    
                                                                <section class="section__search">
                                                                    <div class="col-md-12">
                                                                        
                                                                            
                                                                            <div class="d-flex">
                                                                                
                                                                                <input placeholder="" class="form-control" value="'.$id->tsnome.'" name="pesquisa" id="nome__trab">
                                                                               
                                                
                                                
                                                                                
                                                                                <!-- <button type="submit" class="btn botao__search">
                                                                                    <i class="icon__search fas fa-search fa-md" id="icon"></i>
                                                                                </button> -->
                                                
                                                                            </div>
                                                                            
                                                                        
                                                                    </div>
                                                                </section>
                                                    
                                                                <section class="section__modal--rolDesconto row">
                                                                    <div class="col-12 col-md-6 mt-2">
                                                                    <label for="ano" class="form-label">Data Inicial</label>
                                                                    <input type="date" class="form-control " name="ano_inicial" value="" id="dataInicialDesconto">
                                                                    </div>
                                                                    
                                                                    <div class="col-12 col-md-6 mt-2">
                                                                    <label for="ano" class="form-label">Data Final</label>
                                                                    <input type="date" class="form-control " name="ano_final" value="" id="dataFinalDesconto">
                                                                    </div>
                                                                </section>
                                                
                                                    
                                                            </div>
                                                                
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn botao" data-bs-dismiss="modal" >Fechar</button>
                                                                <button type="submit" class="btn botao__enviar" id="imprimir"><i class="fas fa-print"></i> Imprimir</button>
                                                            </div>
                                            
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </section> ',
                'editar'=>'<a href="'.route('descontos.edit',base64_encode($id->id)).'" class="button__editar btn" ><i class="icon__color fas fa-pen"></i></a>',
                'excluir'=>' <a class="btn button__excluir"  data-bs-toggle="modal" data-bs-target="#deleteDescontos'.$id->id.'"><i class="icon__color fad fa-trash"></i></a>
                <section class="delete__tabela--tomador">
                      <div class="modal fade" id="deleteDescontos'.$id->id.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered col-8">
                              <div class="modal-content">
                                  <form action="'.route('descontos.destroy',base64_encode($id->id)).'" id="" method="post">
                                  <input type="hidden" name="_token" value="'.csrf_token().'">
                                  <input type="hidden" name="_method" value="delete">
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
                                          <button type="submit" class="btn botao__deletar--modal  modal-botao"><i class="fad fa-trash"></i> Deletar</button>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </section>'
            ];
        })
        ->rawColumns(['dfvalor','id.relatorio','id.editar','id.excluir'])
        ->make(true);
    }
    public function store(Validacao $request)
    {
        $dados = $request->all();
        $folhar = $this->folhar
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar_id')
        ->select('folhars.id')
        ->where(function($query) use ($dados){
            if ($dados['quinzena'] === '2 - Segunda') {
                $datainicio = $dados['competencia'].'-16';
                $datafinal = $dados['competencia'].'-31';
                // dd($datainicio,$dados['quinzena']);
                $query->where([
                    ['folhars.empresa_id', $dados['empresa']],
                    ['base_calculos.trabalhador_id',$dados['trabalhador']],
                    ['base_calculos.tomador_id',null]
                ])
                ->whereBetween('folhars.fsfinal',[$datainicio,$datafinal]);
                // ->where('folhars.fsinicio','>',$datainicio)
                // ->where('folhars.fsfinal','<=',$datafinal);
               
            }else{
                $datainicio = $dados['competencia'].'-01';
                $datafinal = $dados['competencia'].'-15';
                $query->where([
                    ['folhars.empresa_id', $dados['empresa']],
                    ['base_calculos.trabalhador_id',$dados['trabalhador']],
                    ['base_calculos.tomador_id',null]
                ])
                ->whereBetween('folhars.fsfinal',[$datainicio,$datafinal]);
            }
        })->first();
    
        if ($folhar) {
            return redirect()->back()->withInput()->withErrors(['false'=>'A folha já foi cálculada nesta quizena.']);
        }
       
        try {
            $descontos = $this->desconto->cadastro($dados);
            return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
            
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível cadastrar.']);
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
        $id = base64_decode($id);
        $user = Auth::user();
        $empresa = $this->empresa->where('id',$user->empresa_id)->first();
        $descontos = $this->desconto->lista($user->empresa_id,null,'asc');
        $dadosdescontos = $this->desconto->buscaUnidadeDesconto($id);
        return view('desconto.editDesconto',compact('user','descontos','dadosdescontos','empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Validacao $request, $id)
    {
        $dados = $request->all();
        
        // $request->validate([
        //     'competencia' => 'required|max:20',
        //     'descricao'=>'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
        //     'quinzena'=>'required|max:17|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
        //     'valor'=>'required',
        // ],
        // [
        //     'competencia.required'=>'O campo não pode estar vazio.',
        //     'competencia.max'=>'O campo não ter mais de 100 caracteres.',
        
        //     'descricao.required'=>'O campo não pode estar vazio.',
        //     'descricao.max'=>'O campo não ter mais de 100 caracteres.',
        //     'descricao.regex'=>'O campo possui um formato inválido.',

        //     'quinzena.required'=>'O campo não pode estar vazio.',
        //     'quinzena.max'=>'O campo não ter mais de 100 caracteres.',
        //     'quinzena.regex'=>'O campo possui um formato inválido.',
        //     'valor.required'=>'O campo não pode estar vazio.',
        // ]
        // );
        try {
            $descontos = $this->desconto->editar($dados,$id);
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
        $id = base64_decode($id);
        try {
            $descontos = $this->desconto->deletar($id);
            return redirect()->back()->withSuccess('Deletado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['false'=>'Não foi possível deletar o registro.']);
        }
    }
}
