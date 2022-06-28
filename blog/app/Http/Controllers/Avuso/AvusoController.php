<?php

namespace App\Http\Controllers\Avuso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Avuso\Validacao;
use App\Avuso;
use App\AvusoDescricao;
use App\ValoresRublica;
use DataTables;
class AvusoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $avuso,$descricao,$valorrublica;
   public function __construct()
    {
        $this->avuso = new Avuso;
        $this->descricao = new AvusoDescricao;
        $this->valorrublica = new ValoresRublica;

    }
    public function index()
    {
        $user = Auth::user();
        $valorrublica_avuso = $this->valorrublica->buscaUnidadeEmpresa($user->empresa_id);
        $lista = $this->avuso->buscaListaRecibos();
        
        return view('avuso.index',compact('user','valorrublica_avuso','lista'));
    }
    public function filtroPesquisa(Request $request)
    {
        $dados = $request->all();
        // dd($dados);
        // $request->validate([
        //     'pesquisa' => 'required|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
        //     'ano_inicial1'=>'required|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
        //     'ano_final1'=>'required|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
        // ],
        // [
        //     'ano_inicial1.required'=>'Campo não pode esta vazio.',
        //     'ano_inicial1.regex'=>'O campo nome social tem um formato inválido.',
        //     'ano_final1.required'=>'Campo não pode esta vazio.',
        //     'ano_final1.regex'=>'O campo nome social tem um formato inválido.',
        // ]
        // );
        $user = auth()->user();
        
            $valorrublica_avuso = $this->valorrublica->buscaUnidadeEmpresa($user->empresa_id);
            $lista = $this->avuso->filtraPesquisa($dados);
            return view('avuso.index',compact('user','valorrublica_avuso','lista'));
            try {
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível realizar a pesquisa.']);
        }
    }
    public function lista()
    {
        $user = auth()->user();
      
        $avuso = $this->avuso->where('empresa_id',$user->empresa_id)->get();
       
        return DataTables::of($avuso)
        ->addColumn('id', function($id) {
            return [
                'imprimir'=>'<a href="'.route('recibo.avulso',[base64_encode($id->id),base64_encode($id->asinicial),base64_encode($id->asfinal)]).'" class="btn btn__imprimir" ><i class="icon__color fad fa-print"></i></a>',
                'excluir'=>' <button class="btn button__excluir" data-bs-toggle="modal" data-bs-target="#staticBackdrop'.$id->id.'"><i class="icon__color fad fa-trash"></i></button>
                <section class="delete__tabela--tomador">
                      <div class="modal fade" id="staticBackdrop'.$id->id.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered col-8">
                              <div class="modal-content">
                                  <form action="'.route('avuso.destroy',base64_encode($id->id)).'" id="" method="post">
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
        ->rawColumns(['id.imprimir','id.excluir'])
        ->make(true);
    }
    public function filtroPesquisaOrdem($condicao)
    {
        $user = auth()->user();
        $valorrublica_avuso = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
        $lista = $this->avuso->buscaListaRecibosOrdem($condicao);
        return view('avuso.index',compact('user','valorrublica_avuso','lista'));
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
    public function store(Validacao $request)
    {
        $user = Auth::user(); 
        $dados = $request->all();
        $verifica = $this->avuso->verifica($dados['codigo']);
        if ($verifica) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Já existe um recibo com este código.']);
        }
        $credito = 0;
        $desconto = 0;
        $total = 0;
        for ($i = 0; $i < $dados['quantidade']; $i++) { 
            if (isset($dados['cd'.$i])) {
                if ($dados['cd'.$i] === 'Crédito') {
                    $credito += str_replace(",",".",str_replace(".","",$dados['valor'.$i]));
                }else{
                    $desconto += str_replace(",",".",str_replace(".","",$dados['valor'.$i]));
                }
            }
        }
        if ($credito < $desconto) {
            return redirect()->back()->withInput()->withErrors(['false'=>'O desconto não pode ser maior que o crédito.']);
        }
        $total = $credito - $desconto;
        $dados['liquido'] = $total;
        
            $avuso = $this->avuso->cadastro($dados);
            if ($avuso['id']) {
                $dados['avuso'] = $avuso['id'];
                for ($i=0; $i < $dados['quantidade']; $i++) { 
                    if (isset($dados['cd'.$i])) {
                        $this->descricao->cadastro($dados,$i);
                    }
                }
                // $this->valorrublica->editarAvuso($dados,$dados['empresa']);
                $this->valorrublica->where('empresa_id', $dados['empresa'])
                ->chunkById(100, function ($valorrublica) use ($dados) {
                    foreach ($valorrublica as $valorrublicas) {
                        if ($valorrublicas->vsreciboavulso >= 0) {
                            $numero = $valorrublicas->vsreciboavulso += 1;
                            $this->valorrublica->where('empresa_id', $dados['empresa'])
                            ->update(['vsreciboavulso'=>$numero]);
                        }
                       
                    }
                });
            }
            
            return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
            try {
        } catch (\Throwable $th) {
            $this->avuso->deletar_store($dados);
            $this->valorrublica->where('empresa_id', $dados['empresa'])
            ->chunkById(100, function ($valorrublica) use ($dados) {
                foreach ($valorrublica as $valorrublicas) {
                    if ($valorrublicas->vsreciboavulso > 0) {
                        $numero = $valorrublicas->vsreciboavulso -= 1;
                        $this->valorrublica->where('empresa_id', $dados['empresa'])
                        ->update(['vsreciboavulso'=>$numero]);
                    }
                   
                }
            });
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível realizar o cadastro.']);
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
        //
    }

    public function pesquisa($id = null)
    {
        $avuso = $this->avuso->buscaListaAvuso($id);
        return response()->json($avuso);
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
        $user = auth()->user();
        try {
            // $this->descricao->deletarAvuso($id);
            $this->avuso->deletar($id);
            $this->valorrublica->where('empresa_id', $user->empresa_id)
            ->chunkById(100, function ($valorrublica) use ($user) {
                foreach ($valorrublica as $valorrublicas) {
                    if ($valorrublicas->vsreciboavulso > 0) {
                        $numero = $valorrublicas->vsreciboavulso -= 1;
                        $this->valorrublica->where('empresa_id', $user->empresa_id)
                        ->update(['vsreciboavulso'=>$numero]);
                    }
                }
            });
            return redirect()->back()->withSuccess('Deletado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível deletar o registro.']);
        }
    }
}
