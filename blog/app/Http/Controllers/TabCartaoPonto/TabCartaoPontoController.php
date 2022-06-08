<?php

namespace App\Http\Controllers\TabCartaoPonto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Boletim\Tabela\Validacao;
use Spatie\Permission\Models\Permission;
use App\Lancamentotabela;
use App\Lancamentorublica;
use App\ValoresRublica;
use App\TabelaPreco;
use App\Bolcartaoponto;
use Carbon\Carbon;
class TabCartaoPontoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $tabelapreco,$lancamentorublica,$valorrublica,$lancamentotabela,$bolcartaoponto;
    public function __construct()
    {
        $this->lancamentorublica = new Lancamentorublica;
        $this->valorrublica = new ValoresRublica;
        $this->lancamentotabela = new Lancamentotabela;
        $this->bolcartaoponto = new Bolcartaoponto;
        $this->tabelapreco = new TabelaPreco;
    }
    public function index()
    {
        // $search = request('search');
        // $condicao = request('codicao'); 
        // if ($search) {
        //     $lancamentotabelas = $this->lancamentotabela->pesquisaLista('M','asc',$search);
        // }else{
        //     $lancamentotabelas = $this->lancamentotabela->buscaListas('M','asc');
        // }
        $search = request('search');
        $condicao = request('codicao'); 
        $today = Carbon::today();
        $user = auth()->user();
        $lancamentotabelas = $this->lancamentotabela
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
        ->select('tomadors.tsnome','tomadors.tscnpj','lancamentotabelas.*')
        ->where(function($query) use ($search,$user){
           if ($search) {
            $query->where([
                ['lancamentotabelas.lsstatus','M'],
                ['lancamentotabelas.empresa_id', $user->empresa_id],
                ['lancamentotabelas.liboletim',$search] 
            ])
            ->orWhere([
                ['lancamentotabelas.lsstatus','M'],
                ['lancamentotabelas.empresa_id', $user->empresa_id],
                ['tomadors.tsnome','like','%'.$search.'%']
            ])
            ->orWhere([
                ['lancamentotabelas.lsstatus','M'],
                ['lancamentotabelas.empresa_id', $user->empresa_id],
                ['tomadors.tscnpj',$search]
            ]);
           }else{
            $query->where([
                ['lancamentotabelas.lsstatus','M'],
                ['lancamentotabelas.empresa_id', $user->empresa_id]
            ]);
           }
        })
        ->with('tomador.cartaoponto')
        ->orderBy('liboletim', 'asc')
        ->paginate(10);
    
    
        $numboletimtabela = $this->valorrublica->where('empresa_id',$user->empresa->id)->first();
        if ($condicao) {
            // $numboletimtabela = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
            // $dados = $this->lancamentotabela->buscaUnidade($condicao);
            $dados = $this->lancamentotabela->where('id',$condicao)->with('tomador')->first();
            return view('tabCartaoPonto.edit',compact('user','dados','numboletimtabela','lancamentotabelas'));
        }else{
            // $numboletimtabela = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
           
            return view('tabCartaoPonto.index',compact('user','numboletimtabela','lancamentotabelas'));
        }
        
    }

    public function filtroPesquisaOrdem($condicao)
    {
        $user = Auth::user();
        $lancamentotabelas = $this->lancamentotabela
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
        ->where(function($query) use ($user){
            $query->where([
                ['lancamentotabelas.lsstatus','M'],
                ['lancamentotabelas.empresa_id', $user->empresa_id]
            ]);
        })
        ->with('tomador.cartaoponto')
        ->orderBy('liboletim', $condicao)
        ->paginate(10);
        $numboletimtabela = $this->valorrublica->where('empresa_id',$user->empresa->id)->first();
        // $numboletimtabela = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
        // $lancamentotabelas = $this->lancamentotabela->buscaListas('M',$condicao);
        return view('tabCartaoPonto.index',compact('user','numboletimtabela','lancamentotabelas'));
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
        // dd($dados);
        $user = auth()->user();
        $permissions = Permission::where('name','like','%'.'mbctc'.'%')->first(); 
         if ($user->hasPermissionTo($permissions->name) === false && $user->hasPermissionTo('admin') === false){
            return redirect()->back()->withInput()->withErrors(['permissaonegada'=>'true']);
        }
       
        $today = Carbon::today();
        if (strtotime($dados['data']) > strtotime($today) ) {
            return redirect()->back()->withInput()->withErrors(['data'=>'Só é válida data atuais!']);
        }
        // $novadata = explode('-',$dados['data']);
        $lancamentotabelas = $this->lancamentotabela->where([
            ['liboletim',$dados['liboletim']],
            ['lsstatus',$dados['status']],
            ['empresa_id', $dados['empresa']]
        ])
        ->whereDate('created_at',$dados['data'])
        ->count();
        // $lancamentotabelas = $this->lancamentotabela->verificaBoletimMes($dados,$novadata); 
        $tabelaprecos = $this->tabelapreco
        ->where([
            ['tomador_id',$dados['tomador']],
            ['tsano',$today->year]
        ])->count();
        if (!$tabelaprecos) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi encontrada todas as rúbricas necessárias do ano '.date('Y').'!']);
        }
        if ($lancamentotabelas) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Este boletim já foi cadastrado este mês!']);
        }
      
        
            $lancamentotabelas = $this->lancamentotabela->cadastro($dados);
            // $this->valorrublica->editarBoletimTabela($dados,$user->empresa);
            // $this->valorrublica->where('empresa_id', $user->empresa_id)
            // ->update(['vsnroboletins'=>$dados['liboletim']]);
            $this->valorrublica->where('empresa_id', $user->empresa_id)
            ->chunkById(100, function ($valorrublica) use ($user) {
                foreach ($valorrublica as $valorrublicas) {
                    if ($valorrublicas->vsnroboletins >= 0) {
                        $numero = $valorrublicas->vsnroboletins += 1;
                        $this->valorrublica->where('empresa_id', $user->empresa_id)
                        ->update(['vsnroboletins'=>$numero]);
                    }
                }
            });
        return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
        try {
        } catch (\Throwable $th) {
            $this->valorrublica->where('empresa_id', $user->empresa_id)
            ->chunkById(100, function ($valorrublica) use ($user) {
                foreach ($valorrublica as $valorrublicas) {
                    if ($valorrublicas->vsnroboletins > 0) {
                        $numero = $valorrublicas->vsnroboletins -= 1;
                        $this->valorrublica->where('empresa_id', $user->empresa_id)
                        ->update(['vsnroboletins'=>$numero]);
                    }
                }
            });
            $this->lancamentotabela->deletar($lancamentotabelas['id']);
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível cadastrar.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$status)
    {
        $lancamentotabelas = $this->lancamentotabela->buscaUnidadeLancamentoTab($id,$status);
        return response()->json($lancamentotabelas);
    }
    public function pesquisa($id,$status) 
    {
        $lancamentotabelas = $this->lancamentotabela->buscaListaLancamentoTab($id,$status);
        return response()->json($lancamentotabelas);
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
        $id = base64_decode($id);
        $search = request('search');
        $lancamentotabelas = $this->lancamentotabela->where(function($query) use ($search,$user){
            if ($search) {
             $query->where([
                 ['lsstatus','M'],
                 ['empresa_id', $user->empresa_id],
                 ['liboletim','like','%'.$search.'%'] 
             ])
             ->orWhere([
                 ['lsstatus','M'],
                 ['empresa_id', $user->empresa_id],
                 ['tsnome','like','%'.$search.'%']
             ])
             ->orWhere([
                 ['lsstatus','M'],
                 ['empresa_id', $user->empresa_id],
                 ['tscnpj','like','%'.$search.'%']
             ]);
            }else{
             $query->where([
                 ['lsstatus','M'],
                 ['empresa_id', $user->empresa_id]
             ]);
            }
         })
         ->with('tomador.cartaoponto')
         ->orderBy('liboletim', 'asc')
         ->paginate(10);
        $dados = $this->lancamentotabela->where('id',$id)->with('tomador')->first();
        $numboletimtabela = $this->valorrublica->where('empresa_id',$user->empresa->id)->first();
        // dd($dados);
        // $numboletimtabela = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
        // $lancamentotabelas = $this->lancamentotabela->buscaListas('M','asc');
        // $dados = $this->lancamentotabela->buscaUnidade($id);
        return view('tabCartaoPonto.edit',compact('user','dados','numboletimtabela','lancamentotabelas'));
    }
    public function filtroPesquisaOrdemEdit($id,$condicao)
    {
        $user = Auth::user();
        if ($id !== ' ') {
            $numboletimtabela = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
            $lancamentotabelas = $this->lancamentotabela->buscaListas('M',$condicao);
            $dados = $this->lancamentotabela->buscaUnidade($id);
            return view('tabCartaoPonto.edit',compact('user','dados','numboletimtabela','lancamentotabelas'));
        }else{
            return redirect()->route('ordem.tabela.cartao.ponto', [$condicao]);
        }
       
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
        $permissions = Permission::where('name','like','%'.'mbctd'.'%')->first(); 
        $user = Auth::user();
        if ($user->hasPermissionTo($permissions->name) === false && $user->hasPermissionTo('admin') === false){
            return redirect()->back()->withInput()->withErrors(['permissaonegada'=>'true']);
        }
        // $quantidadeTrabalhador = $this->lancamentorublica->verificaTrabalhador($dados,$novadata);
        // $lancamentorublica = $this->lancamentorublica->where('lancamentotabela_id', $dados['lancamento'])->count();
        // if ($lancamentorublica > $dados['num__trabalhador']) {
        //     return redirect()->back()->withInput()->withErrors(['num__trabalhador'=>'Possui o número menor que a quantidade já cadastrada.']);
        // }
      
        try {
            $lancamentotabelas = $this->lancamentotabela->editar($dados,$id);
            // $this->lancamentorublica->editarBoletim($dados,$id);
            // $this->bolcartaoponto->editarBoletim($dados,$id);
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
        try {
            $user = Auth::user();
            $permissions = Permission::where('name','like','%'.'mbcte'.'%')->first(); 
            if ($user->hasPermissionTo($permissions->name) === false && $user->hasPermissionTo('admin') === false){
                return redirect()->back()->withInput()->withErrors(['permissaonegada'=>'true']);
            }
            // $this->lancamentorublica->deletar($id);
           
            $this->valorrublica->where('empresa_id', $user->empresa_id)
            ->chunkById(100, function ($valorrublica) use ($user) {
                foreach ($valorrublica as $valorrublicas) {
                    if ($valorrublicas->vsnroboletins > 0) {
                        $numero = $valorrublicas->vsnroboletins -= 1;
                        $this->valorrublica->where('empresa_id', $user->empresa_id)
                        ->update(['vsnroboletins'=>$numero]);
                    }
                }
            });
            $this->lancamentotabela->deletar($id);
            return redirect()->back()->withSuccess('Deletado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível deletar o registro.']);
        }
    }
}
