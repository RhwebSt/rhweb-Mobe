<?php

namespace App\Http\Controllers\TabelaPreco;

use App\Empresa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\Tomador\TabelaPreco\Validacao;
use App\TabelaPreco;
use App\Tomador;
use App\Rublica;
use Carbon\Carbon;
use DataTables;
class TabelaPrecoController extends Controller
{
    private $tomador, $tabelapreco,$dt,$empresa,$rublica;
    public function __construct()
    {
        $this->rublica = new Rublica;
        $this->tomador = new Tomador;
        $this->tabelapreco = new TabelaPreco;
        $this->empresa = new Empresa;
        $today = Carbon::today();
        $this->dt = Carbon::create($today);
    }
    public function index($id = null, $tomador)
    {
        $user = auth()->user();
        $search = request('search');
        $condicao = request('codicao');
        $tomador = base64_decode($tomador);
        $empresa = $this->empresa->where('id',$user->empresa_id)->first();
        // $tabelaprecos = $this->tabelapreco->buscaTabelaTomador($tomador,null,$search,'asc'); 
        $tabelaprecos = $this->tabelapreco->where(function($query) use ($tomador,$search){
            if ($search) {
                $query->where([
                    ['tomador_id',$tomador],
                    ['tsano',$this->dt->year],
                    ['tsrubrica','like','%'.$search.'%']
                ])
                ->orWhere([
                    ['tomador_id',$tomador],
                    ['tsano',$this->dt->year],
                    ['tsdescricao','like','%'.$search.'%']
                ]);
            }else{
                $query->where([
                    ['tomador_id',$tomador],
                    // ['tsano',$this->dt->year]
                ]);
            }
        })
        ->orderBy('tsano', 'desc')
        ->paginate(5);
        if ($condicao) {
            // $tabelaprecos_editar = $this->tabelapreco->buscaTabelaPrecoEditar($condicao);
            $tabelaprecos_editar = $this->tabelapreco
            ->where([
                ['id',$id],
                ['tsano',$this->dt->year]
            ])
            ->first();
            return view('tomador.tabelapreco.edit', compact('tabelaprecos_editar', 'tabelaprecos', 'tomador', 'id', 'user'));
        }else{
            return view('tomador.tabelapreco.index', compact('id', 'user', 'tabelaprecos','empresa', 'tomador'));
        }
    }
    public function lista($tomador)
    {
       
       $tabelapreco =  $this->tabelapreco->where('tomador_id',$tomador)->get();
       return DataTables::of($tabelapreco)
       ->addColumn('tstomvalor', function($tstomvalor) {
            return 'R$ '.number_format((float)$tstomvalor->tstomvalor, 2, ',', '.');
       })
       ->addColumn('tsvalor', function($tsvalor) {
        return 'R$ '.number_format((float)$tsvalor->tsvalor, 2, ',', '.');
        })
        ->addColumn('id', function($id) {
            return [
                'editar'=>'<a href="'.route('tabela.preco.editar',[base64_encode($id->id),base64_encode($id->tomador_id)]).'" class="button__editar btn" ><i class="icon__color fas fa-pen"></i></a>',
                'excluir'=>' <button class="btn button__excluir" data-bs-toggle="modal" data-bs-target="#deleteTabelaPreco'.$id->id.'"><i class="icon__color fad fa-trash"></i></button>
                <section class="delete__tabela--tomador">
                      <div class="modal fade" id="deleteTabelaPreco'.$id->id.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered col-8">
                              <div class="modal-content">
                                  <form action="'.route('tabelapreco.destroy',$id->id).'"  method="post">
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
                                                  
                                                  <p class="content--deletar2">Obs: a exclusão pode afetar em cáculos e em outras páginas.</p>
                                                  
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
        ->rawColumns(['tsvalor','tstomvalor','id.editar','id.excluir'])
       ->make(true);
    }
    public function ordem($id = null, $tomador,$ordem)
    {
        $tomador = base64_decode($tomador);
        $id = base64_decode($id);
        // $tabelaprecos = $this->tabelapreco->buscaTabelaTomador($tomador,$this->dt->year,null,$ordem);
        $user = auth()->user();
        $tabelaprecos = $this->tabelapreco->where(function($query) use ($tomador){
            $query->where([
                ['tomador_id',$tomador],
                // ['tsano',$this->dt->year]
            ]);
        })
        ->orderBy('tsano', $ordem)
        ->paginate(5);
        if ($id && $id != ' ') {
            // $tabelaprecos_editar = $this->tabelapreco->buscaTabelaPrecoEditar($id);
            $tabelaprecos_editar = $this->tabelapreco
            ->where([
                ['id',$id],
                ['tsano',$this->dt->year]
            ])
            ->first();
            return view('tomador.tabelapreco.edit', compact('tabelaprecos_editar', 'tabelaprecos', 'tomador', 'id', 'user'));
        }else{
            return view('tomador.tabelapreco.index', compact('id', 'user', 'tabelaprecos', 'tomador'));
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tomador)
    {
        $tomador = base64_decode($tomador);
        $rublicas = $this->rublica->listaRublicaTabelaPreco();
        $user = auth()->user();
        foreach ($rublicas as $key => $rublica) {
            $dadostabelapreco = [
                'ano' => date('Y'),
                'rubricas' => $rublica->rsrublica,
                'descricao' => $rublica->rsdescricao,
                'status' => '',
                'valor' => 0,
                'valor__tomador' => 0,
                'empresa' => $user->empresa_id,
                'tomador' => $tomador
            ];
            $this->tabelapreco->cadastro($dadostabelapreco);
        }
        return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Validacao $request)
    {
        $dados = $request->all();
        // dd($dados);
        if ($dados['ano'] > $this->dt->year) {
            return redirect()->back()->withInput()->withErrors(['ano'=>'Só é válida data atuais!']);
        }
        // $tabelaprecos = $tabelapreco->verificaRublica($dados);
        $tabelaprecos = $this->tabelapreco->where([
            ['tsano',$dados['ano']],
            ['tsrubrica',$dados['rubricas']],
            ['tomador_id',$dados['tomador']]
        ])->count();
        if ($tabelaprecos) {
            return redirect()->back()->withInput()->withErrors(['descricao' => 'Esta rúbrica já está cadastrada.']);
        }
        
            $tabelaprecos = $this->tabelapreco->cadastro($dados);
            return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
            try {
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false' => 'Não foi possível cadastrar.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $tomador)
    {

        $tabelapreco = new TabelaPreco;
        $tabelaprecos = $tabelapreco->buscaUnidadeTabela($id, $tomador);
        return response()->json($tabelaprecos);
    }
    public function pesquisa($id, $tomador)
    {
        // $tabelaprecos = $tabelapreco->buscaListaTabela($id, $tomador);
        $tomador = base64_decode($tomador);
        $tabelaprecos = $this->tabelapreco->where(function($query) use ($id,$tomador){
            $user = auth()->user();
            if ($id) {
                $query->where([
                    ['tsrubrica','like','%'.$id.'%'],
                    ['tomador_id',$tomador],
                    ['empresa_id', $user->empresa_id]
                ])
                ->where('tsano', $this->dt->year)
                ->orWhere([
                    ['tsdescricao','like','%'.$id.'%'],
                    ['tomador_id',$tomador],
                    ['empresa_id', $user->empresa_id],
                ])
                ->where('tsano', $this->dt->year);
            }else{
                $query->where([
                    // ['id','>',$id],
                    ['tomador_id',$tomador],
                    ['empresa_id', $user->empresa_id]
                ]);
                // ->where('tsano', $this->dt->year);
            }  
        })
        ->orderBy('tsrubrica', 'asc')
        ->get();
        return response()->json($tabelaprecos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $tomador)
    {
        $id = base64_decode($id);
        $tomador = base64_decode($tomador);
        $user = Auth::user();
        $empresa = $this->empresa->where('id',$user->empresa_id)->first();
        // $tabelaprecos = $tabelapreco->buscaTabelaTomador($tomador, $this->dt->year,null,'asc');
         // $tabelaprecos_editar = $tabelapreco->buscaTabelaPrecoEditar($id);
        $tabelaprecos = $this->tabelapreco->where('tomador_id',$tomador)->paginate(5);
        $tabelaprecos_editar = $this->tabelapreco
        ->where([
            ['id',$id],
            ['tsano',$this->dt->year]
        ])
        ->first();
        return view('tomador.tabelapreco.edit', compact('tabelaprecos_editar','empresa', 'tabelaprecos', 'tomador', 'id', 'user'));
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
        if ($dados['ano'] > $this->dt->year) {
            return redirect()->back()->withInput()->withErrors(['ano'=>'Só é válida data atuais!']);
        }
        try {
            $tabelaprecos = $this->tabelapreco->editar($dados, $id);
            return redirect()->back()->withSuccess('Atualizador com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false' => 'Não foi porssível atualizar.']);
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
        try {
            // $tabelaprecos = $tabelapreco->buscaUnidadeTabela($id);
            $excluir = $this->tabelapreco->deletar($id);
            return redirect()->back()->withSuccess('Deletado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['false' => 'Não foi possível deletar o registro.']);
        }
    }
    public function verificaTabelaPreco($tomador)
    {
        $tabelapreco = new TabelaPreco;
        $tabelaprecos = $tabelapreco->buscaTabelaTomador($tomador, date('Y'),null,'asc');
        if (count($tabelaprecos) > 0) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    public function AtualizarTabelaPreco()
    {
        $user = Auth::user();
        $yesterday = Carbon::today();
        $today = Carbon::yesterday();
        $o = Carbon::create($today);
        $h = Carbon::create($yesterday);
        if ($h->year > $o->year) {
            $tomador =  $this->tomador->relatorioGeral($user->empresa);
            if (count($tomador) > 0) {
                foreach ($tomador as $key => $tomadores) {
                    $this->tabelapreco->Atualizar($tomadores->id, $h->year, $o->year);
                }
                return response()->json([
                    'status' => true,
                    'mensagem' => 'Processo encerrado'
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'mensagem' => 'Não possui tomadores cadastrados'
                ]);
            }
        }else{
            return response()->json([
                'status' => false,
                'mensagem' => ''
            ]);
        }
    }
}
