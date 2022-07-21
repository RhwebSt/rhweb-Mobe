<?php

namespace App\Http\Controllers\CadastroCartaoPonto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Boletim\CartaoPonto\Validacao;
use Spatie\Permission\Models\Permission;
use App\Lancamentotabela;
use App\Bolcartaoponto;
use App\Trabalhador;
use App\TabelaPreco;
use App\ValoresRublica;
use App\Empresa;
use App\Folhar;
use Carbon\Carbon;
use DataTables;
use PDF;
class CadastroCartaoPontoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $valorrublica,$lancamentotabela,$tabelapreco,$bolcartaoponto,$empresa,$folhar;
    public function __construct()
    {
        $this->valorrublica = new ValoresRublica;
        $this->lancamentotabela = new Lancamentotabela;
        $this->tabelapreco = new TabelaPreco;
        $this->bolcartaoponto = new Bolcartaoponto;
        $this->empresa = new Empresa;
        $this->folhar = new Folhar;
    }
    public function index()
    {
      
    }
    public function filtroPesquisaOrdem($condicao = null,$ordem)
    {
        $search = request('search');
        $today = Carbon::today();
        $user = auth()->user(); 
        $lancamentotabelas = $this->lancamentotabela
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
        ->select('tomadors.tsnome','tomadors.tscnpj','lancamentotabelas.*')
        ->where(function($query) use ($search,$user){
           if ($search) {
            $query->where([
                ['lancamentotabelas.lsstatus','D'],
                ['lancamentotabelas.empresa_id', $user->empresa_id],
                ['lancamentotabelas.liboletim','like','%'.$search.'%'] 
            ])
            ->orWhere([
                ['lancamentotabelas.lsstatus','D'],
                ['lancamentotabelas.empresa_id', $user->empresa_id],
                ['tomadors.tsnome','like','%'.$search.'%']
            ])
            ->orWhere([
                ['lancamentotabelas.lsstatus','D'],
                ['lancamentotabelas.empresa_id', $user->empresa_id],
                ['tomadors.tscnpj','like','%'.$search.'%']
            ]);
           }else{
            $query->where([
                ['lancamentotabelas.lsstatus','D'],
                ['lancamentotabelas.empresa_id', $user->empresa_id]
            ]);
           }
        })
        ->with('tomador.cartaoponto')
        ->orderBy('lancamentotabelas.liboletim', $ordem)
        ->paginate(10);
        // $numboletimtabela = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
        // $lancamentotabelas = $this->lancamentotabela->buscaListas('D',$condicao);
        $numboletimtabela = $this->valorrublica->where('empresa_id',$user->empresa->id)->first();
        if ($condicao != ' ') {
            $dados = $this->lancamentotabela->where('id',$condicao)->with('tomador')->first();
            return view('cadastroCartaoPonto.edit',compact('user','dados','numboletimtabela','lancamentotabelas'));
        }
        return view('cadastroCartaoPonto.index',compact('user','numboletimtabela','lancamentotabelas'));
    }

    public function lista()
    {
        $user = auth()->user(); 
        $lancamentotabelas = $this->lancamentotabela
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
        ->join('cartao_pontos', 'tomadors.id', '=', 'cartao_pontos.tomador_id')
        ->select(
            'tomadors.tsnome',
            'tomadors.tscnpj',
            'lancamentotabelas.*',
            'cartao_pontos.csdiasuteis',
            'cartao_pontos.cssabados',
            'cartao_pontos.csdomingos'
        )
        
        ->where([
            ['lancamentotabelas.lsstatus','D'],
            ['lancamentotabelas.empresa_id', $user->empresa_id]
        ])
        ->get();
        return DataTables::of($lancamentotabelas)
        ->addColumn('id', function($id) {
            return [
                'relatorio'=>'<a class="btn btn__relatorio modal-botao" href="'.route('cadastrocartaoponto.relatoriocartaoponto',[base64_encode($id->id),base64_encode($id->csdomingos)?$id->csdomingos:' ',$id->cssabados?base64_encode($id->cssabados):' ',$id->csdiasuteis?base64_encode($id->csdiasuteis):' ',base64_encode($id->lsdata),base64_encode($id->liboletim),base64_encode($id->tomador_id),base64_encode($id->lsferiado)]).'"><i class="icon__color fas fa-file-alt"></i></a>',
                'visualizar'=>'<a class="btn btn__vizualizar" href="'.route('boletimcartaoponto.create',[base64_encode($id->id),base64_encode($id->csdomingos)?$id->csdomingos:' ',$id->cssabados?base64_encode($id->cssabados):' ',$id->csdiasuteis?base64_encode($id->csdiasuteis):' ',base64_encode($id->lsdata),base64_encode($id->liboletim),base64_encode($id->tomador_id),base64_encode($id->lsferiado)]).'"><i class="icon__color fad fa-eye"></i></a>',
                'editar'=>'<a href="'.route('cartao.ponto.editar',base64_encode($id->id)).'" class="button__editar btn" ><i class="icon__color fas fa-pen"></i></a>',
                'excluir'=>' <button class="btn button__excluir" data-bs-toggle="modal" data-bs-target="#deleteTabelaPreco'.$id->id.'"><i class="icon__color fad fa-trash"></i></button>
                <section class="delete__tabela--tomador">
                      <div class="modal fade" id="deleteTabelaPreco'.$id->id.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered col-8">
                              <div class="modal-content">
                                  <form action="'.route('cartao.ponto.deletar',base64_encode($id->id)).'" id="" method="post">
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
                                                                        
                                                  <p class="content--deletar2">Obs: Excluir esse boletim pode afetar em alguns cálculos.</p>
                                                  
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
        ->rawColumns(['id.relatorio','id.editar','id.excluir','id.visualizar'])
        ->make(true);
    }
    public function create()
    {
        $search = request('search');
        $condicao = request('codicao'); 
        $today = Carbon::today();
        $user = auth()->user(); 
        $permissions = Permission::where('name','like','%'.'mbcpc'.'%')->first(); 
        if ($user->hasPermissionTo($permissions->name) === false && $user->hasPermissionTo('admin') === false){
            return redirect()->back()->withInput()->withErrors(['permissaonegada'=>'true']);
        }
      
        $lancamentotabelas = $this->lancamentotabela
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
        ->select('tomadors.tsnome','tomadors.tscnpj','lancamentotabelas.*')
        ->where(function($query) use ($search,$user){
           if ($search) {
            $query->where([
                ['lancamentotabelas.lsstatus','D'],
                ['lancamentotabelas.empresa_id', $user->empresa_id],
                ['lancamentotabelas.liboletim',$search] 
            ])
            ->orWhere([
                ['lancamentotabelas.lsstatus','D'],
                ['lancamentotabelas.empresa_id', $user->empresa_id],
                ['tomadors.tsnome','like','%'.$search.'%']
            ])
            ->orWhere([
                ['lancamentotabelas.lsstatus','D'],
                ['lancamentotabelas.empresa_id', $user->empresa_id],
                ['tomadors.tscnpj',$search]
            ]);
           }else{
            $query->where([
                ['lancamentotabelas.lsstatus','D'],
                ['lancamentotabelas.empresa_id', $user->empresa_id]
            ]);
           }
        })
        ->with('tomador.cartaoponto')
        ->orderBy('lancamentotabelas.liboletim', 'asc')
        ->paginate(10);
        // dd($lancamentotabelas);
        // if ($search) {
        //     $lancamentotabelas = $this->lancamentotabela->pesquisaLista('D','asc',$search);
        // }else{
        //     $lancamentotabelas = $this->lancamentotabela->buscaListas('D','asc');
        // }
        $numboletimtabela = $this->valorrublica->where('empresa_id',$user->empresa->id)->first();
        $empresa = $this->empresa->where('id',$user->empresa_id)->first();
        // ->buscaUnidadeEmpresa($user->empresa);
        if ($condicao) {
            $dados = $this->lancamentotabela->where('id',$condicao)->with('tomador')->first();
            return view('cadastroCartaoPonto.edit',compact('user','dados','numboletimtabela','lancamentotabelas'));
        }
        return view('cadastroCartaoPonto.index',compact('user','empresa','numboletimtabela','lancamentotabelas'));
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
        $user = Auth::user();
        $permissions = Permission::where('name','like','%'.'mbcpc'.'%')->first(); 
        if ($user->hasPermissionTo($permissions->name) === false && $user->hasPermissionTo('admin') === false){
            return redirect()->back()->withInput()->withErrors(['permissaonegada'=>'true']);
        }
        $today = Carbon::today();
        if ($dados['feriadostatus'] === 'true' && $dados['feriado'] === 'Não') {
            return redirect()->back()->withInput()->withErrors(['feriado'=>'Esta data é um feriado ou final de semana, o campo tem que ser "sim"!']);
        }
        if (strtotime($dados['data']) > strtotime($today) ) {
            return redirect()->back()->withInput()->withErrors(['data'=>'Só é válido data atuais!']);
        }
        // $lancamentotabelas = $this->lancamentotabela->verificaBoletimDias($dados);
        $lancamentotabelas = $this->lancamentotabela->where([
            ['liboletim',$dados['liboletim']],
            ['lsstatus',$dados['status']],
            ['empresa_id', $dados['empresa']]
        ])
        ->whereDate('created_at',$dados['data'])
        ->count();
        $tabelaprecos = $this->tabelapreco
        ->where([
            ['tomador_id',$dados['tomador']],
            ['tsano',$today->year]
        ])->count();
        if (!$tabelaprecos) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi encontrada todas as rúbricas necessárias do ano'.date('Y').'!']);
        }
        if ($lancamentotabelas) { 
            return redirect()->back()->withInput()->withErrors(['false'=>'Este boletim já foi cadastrado!']);
        }
        
        try {
            $lancamentotabelas = $this->lancamentotabela->cadastro($dados); 
            if ($lancamentotabelas) {
                // $this->valorrublica->editarUnidadeNuCartaoPonto($user->empresa,$dados);
                // $this->valorrublica->where('empresa_id', $user->empresa_id)
                // ->update(['vsnrocartaoponto'=>$dados['liboletim']]); 
                $this->valorrublica->where('empresa_id', $user->empresa_id)
                ->chunkById(100, function ($valorrublica) use ($user) {
                    foreach ($valorrublica as $valorrublicas) {
                        if ($valorrublicas->vsnrocartaoponto >= 0) {
                            $numero = $valorrublicas->vsnrocartaoponto += 1;
                            $this->valorrublica->where('empresa_id', $user->empresa_id)
                            ->update(['vsnrocartaoponto'=>$numero]);
                        }
                    }
                });
            }
            return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível realizar o cadastro!']);
        }
      
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$tomador)
    {
      
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
        $id =  base64_decode($id);
        $today = Carbon::today();
        $permissions = Permission::where('name','like','%'.'mbcpd'.'%')->first(); 
        if ($user->hasPermissionTo($permissions->name) === false && $user->hasPermissionTo('admin') === false){
            return redirect()->back()->withInput()->withErrors(['permissaonegada'=>'true']);
        }
        $lancamentotabelas = $this->lancamentotabela
        ->where([
            ['lsstatus','D'],
            ['empresa_id', $user->empresa_id],
            ['id',$id]
        ])
        ->first();
        $folhar = $this->folhar
        ->where('fscompetencia', date('Y-m',strtotime($lancamentotabelas->lsdata)))
        ->get();
        foreach ($folhar as $key => $folhas) {
            if(strtotime($folhas->fsfinal) > strtotime($lancamentotabelas->lsdata)){
                return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssível atualizar. Pos já existe um folhar lançada']);
            }
        }
        // $valorrublica = new ValoresRublica;
        // $lancamentotabela = new Lancamentotabela;
        // $numboletimtabela = $valorrublica->buscaUnidadeEmpresa($user->empresa);
        $search = request('search');
        $numboletimtabela = $this->valorrublica->where('empresa_id',$user->empresa->id)->first();
        // $lancamentotabelas = $lancamentotabela->buscaListas('D','asc');
        $lancamentotabelas = $this->lancamentotabela->where(function($query) use ($search,$user){
            if ($search) {
             $query->where([
                 ['lsstatus','D'],
                 ['empresa_id', $user->empresa_id],
                 ['liboletim','like','%'.$search.'%'] 
             ])
             ->orWhere([
                 ['lsstatus','D'],
                 ['empresa_id', $user->empresa_id],
                 ['tsnome','like','%'.$search.'%']
             ])
             ->orWhere([
                 ['lsstatus','D'],
                 ['empresa_id', $user->empresa_id],
                 ['tscnpj','like','%'.$search.'%']
             ]);
            }else{
             $query->where([
                 ['lsstatus','D'],
                 ['empresa_id', $user->empresa_id]
             ]);
            }
         })
         ->with('tomador')
         ->orderBy('liboletim', 'asc')
         ->paginate(10);
        $dados = $this->lancamentotabela->where('id',$id)->with('tomador')->first();
        $empresa = $this->empresa->where('id',$user->empresa_id)->first();
        return view('cadastroCartaoPonto.edit',compact('empresa','user','dados','numboletimtabela','lancamentotabelas'));
    }
    public function filtroPesquisaOrdemEdit($id,$condicao)
    {
        $user = Auth::user();
        $numboletimtabela = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
        $lancamentotabelas = $this->lancamentotabela->buscaListas('D',$condicao);
        $dados = $this->lancamentotabela->buscaUnidade($id);
        return view('cadastroCartaoPonto.edit',compact('user','dados','numboletimtabela','lancamentotabelas'));
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
        $id =  base64_decode($id);
        $permissions = Permission::where('name','like','%'.'mbcpd'.'%')->first(); 
        $user = Auth::user();
        if ($user->hasPermissionTo($permissions->name) === false && $user->hasPermissionTo('admin') === false){
            return redirect()->back()->withInput()->withErrors(['permissaonegada'=>'true']);
        }
        $today = Carbon::today();
        if ($dados['feriadostatus'] === 'true' && $dados['feriado'] === 'Não') {
            return redirect()->back()->withInput()->withErrors(['feriado'=>'Esta data é um feriado ou final de semana, o campo tem que ser "sim"!']);
        }
        if (strtotime($dados['data']) > strtotime($today) ) {
            return redirect()->back()->withInput()->withErrors(['data'=>'Só é válido data atuais!']);
        }
        try {
            $lancamentotabelas = $this->lancamentotabela->editar($dados,$id);
            // $lista = $this->bolcartaoponto->listaCartaoPontoPaginacao($id,$dados['data']);
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
       
        $user = Auth::user();
        $id =  base64_decode($id);
        $today = Carbon::today();
        $permissions = Permission::where('name','like','%'.'mbcpe'.'%')->first(); 
        if ($user->hasPermissionTo($permissions->name) === false && $user->hasPermissionTo('admin') === false){
            return redirect()->back()->withInput()->withErrors(['permissaonegada'=>'true']);
        }
        $lancamentotabelas = $this->lancamentotabela
        ->where([
            ['lsstatus','D'],
            ['empresa_id', $user->empresa_id],
            ['id',$id]
        ])
        ->first();
        $folhar = $this->folhar
        ->where('fscompetencia', date('Y-m',strtotime($lancamentotabelas->lsdata)))
        ->get();
        foreach ($folhar as $key => $folhas) {
            if(strtotime($folhas->fsfinal) > strtotime($lancamentotabelas->lsdata)){
                return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível deletar o registro. Pos já existe um folhar lançada']);
            }
        }
        $this->valorrublica->where('empresa_id', $user->empresa_id)
        ->chunkById(100, function ($valorrublica) use ($user) {
            foreach ($valorrublica as $valorrublicas) {
                if ($valorrublicas->vsnrocartaoponto > 0) {
                    $numero = $valorrublicas->vsnrocartaoponto -= 1;
                    $this->valorrublica->where('empresa_id', $user->empresa_id)
                    ->update(['vsnrocartaoponto'=>$numero]);
                }
            }
        });
        try {
            // $bolcartaopontos = $this->bolcartaoponto->deletarLancamentoTabela($id);
            $this->lancamentotabela->deletar($id);
            return redirect()->back()->withSuccess('Deletado com sucesso.'); 
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível deletar o registro.']);
        }
      
    }
  
}
