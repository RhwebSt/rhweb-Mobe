<?php

namespace App\Http\Controllers\Comisionario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Comissionado\Validacao;
use Illuminate\Support\Facades\Auth;
use App\Comissionado;
use DataTables;
class ComisionarioController extends Controller
{
    private $comissionado;
    public function __construct()
    {
        $this->comissionado = new Comissionado;
    }
    public function index()
    {
        $user = Auth::user();
        $search = request('search');
        $comissionado = new Comissionado;
        $comissionados = $comissionado->buscaListaComissionado($search);
        return view('comisionado.index',compact('user','comissionados'));
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

    public function lista()
    {
        $user = Auth::user();
        $comissionado = $this->comissionado
        ->join('trabalhadors', 'trabalhadors.id', '=', 'comissionados.trabalhador_id')
        ->join('tomadors', 'tomadors.id', '=', 'comissionados.tomador_id')
        ->select(
            'comissionados.*',
            'trabalhadors.tsnome as trabalhador',
            'trabalhadors.tsmatricula',
            'tomadors.tsnome as tomador',
        )
        ->where('trabalhadors.empresa_id',$user->empresa_id)
        ->get();
        return DataTables::of($comissionado)
        ->addColumn('csindece', function($csindece) {
            return '% '.number_format((float)$csindece->csindece, 2, ',', '.');
        })
        ->addColumn('id', function($id) {
            return [
                'editar'=>'<a href="'.route('comisionado.edit',base64_encode($id->id)).'" class="button__editar btn" ><i class="icon__color fas fa-pen"></i></a>',
                'excluir'=>' <button class="btn button__excluir" data-bs-toggle="modal" data-bs-target="#deleteComissionado'.$id->id.'"><i class="icon__color fad fa-trash"></i></button>
                <section class="delete__tabela--tomador">
                      <div class="modal fade" id="deleteComissionado'.$id->id.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered col-8">
                              <div class="modal-content">
                                  <form action="'.route('comisionado.destroy',$id->id).'" id="" method="post">
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
                                                                        
                                                                        <p class="content--deletar2">Obs: Será excluído tudo o que há vinculado á este comissionado.</p>
                                                  
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
        ->rawColumns(['csindece','id.editar','id.excluir'])
        ->make(true);
    }
    
    
    public function store(Validacao $request)
    {
        $dados = $request->all();
        $comissionado = new Comissionado;
        try {
        $comissionados = $comissionado->verifica($dados);
        if ($comissionados) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Estes dados já estão cadastrados.']);  
        }
        $comissionados = $comissionado->cadastro($dados);
        if ($comissionados) {
            return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
        }
       } catch (\Throwable $th) {
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
        $comissionado = new Comissionado;
        $comissionados = $comissionado->first($id);
        return response()->json($comissionados);
    }

    public function pesquisa()
    {
        $comissionado = new Comissionado;
        $comissionados = $comissionado->pesquisas();
        return response()->json($comissionados);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $comissionado = new Comissionado;
        $comissionados = $comissionado->buscaListaComissionado();
        $dados = $comissionado->buscaUnidadeComissionado($id);
        return view('comisionado.edit',compact('comissionados','user','dados'));
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
            'nome__trabalhador' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'nome_tomador' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'tomador'=>'required|numeric',
            'trabalhador'=>'required|numeric',
            'indice'=>'required|max:6',
            'matricula__trab'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
        ]
        );
        $comissionado = new Comissionado;
        $comissionados = $comissionado->editar($dados,$id);
        if ($comissionados) {
            return redirect()->back()->withSuccess('Atualizado com sucesso.');  
        }else{
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível atualizar o registro.']);  
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
        $comissionado = new Comissionado;
        try {
            $comissionados = $comissionado->deletar($id);
            return redirect()->back()->withSuccess('Deletado com sucesso.'); 
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['false'=>'Não foi possível deletar o registro.']);
        }
    }
}
