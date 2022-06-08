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
use Carbon\Carbon;
use PDF;
class CadastroCartaoPontoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $valorrublica,$lancamentotabela,$tabelapreco,$bolcartaoponto;
    public function __construct()
    {
        $this->valorrublica = new ValoresRublica;
        $this->lancamentotabela = new Lancamentotabela;
        $this->tabelapreco = new TabelaPreco;
        $this->bolcartaoponto = new Bolcartaoponto;
    }
    public function index()
    {
        $search = request('search');
        // dd($search);
        $condicao = request('codicao'); 
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
        
        // ->buscaUnidadeEmpresa($user->empresa);
        if ($condicao) {
            $dados = $this->lancamentotabela->where('id',$condicao)->with('tomador')->first();
            return view('cadastroCartaoPonto.edit',compact('user','dados','numboletimtabela','lancamentotabelas'));
        }
        return view('cadastroCartaoPonto.index',compact('user','numboletimtabela','lancamentotabelas'));
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
        $dados = $request->all();
       // $permissions = Permission::where('name','like','%'.'mbcpc'.'%')->first(); 
        
        $user = Auth::user();
        // dd($permissions->name,$user->hasPermissionTo($permissions->name));
        // if ($user->hasPermissionTo($permissions->name) === false && $user->hasPermissionTo('admin') === false){
            
        //     return redirect()->back()->withInput()->withErrors(['permissaonegada'=>'true']);
        // }
       
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
        
        return view('cadastroCartaoPonto.edit',compact('user','dados','numboletimtabela','lancamentotabelas'));
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
        $permissions = Permission::where('name','like','%'.'mbcpe'.'%')->first(); 
        if ($user->hasPermissionTo($permissions->name) === false && $user->hasPermissionTo('admin') === false){
            return redirect()->back()->withInput()->withErrors(['permissaonegada'=>'true']);
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
            return redirect()->route('cadastrocartaoponto.index')->withSuccess('Deletado com sucesso.'); 
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível deletar o registro.']);
        }
      
    }
  
}
