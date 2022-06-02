<?php

namespace App\Http\Controllers\TabelaPreco;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\Tomador\TabelaPreco\Validacao;
use App\TabelaPreco;
use App\Tomador;
use Carbon\Carbon;

class TabelaPrecoController extends Controller
{
    private $tomador, $tabelapreco,$dt;
    public function __construct()
    {
        $this->tomador = new Tomador;
        $this->tabelapreco = new TabelaPreco;
        $today = Carbon::today();
        $this->dt = Carbon::create($today);
    }
    public function index($id = null, $tomador)
    {
        $user = auth()->user();
        $search = request('search');
        $condicao = request('codicao');
        $tomador = base64_decode($tomador);
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
                    ['tsano',$this->dt->year]
                ]);
            }
        })
        ->orderBy('tsano', 'asc')
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
            return view('tomador.tabelapreco.index', compact('id', 'user', 'tabelaprecos', 'tomador'));
        }
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
                ['tsano',$this->dt->year]
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
        if ($dados['ano'] > $this->dt->year) {
            return redirect()->back()->withInput()->withErrors(['ano'=>'Só é valida data atuais!']);
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
                    ['id','>',$id],
                    ['tomador_id',$tomador],
                    ['empresa_id', $user->empresa_id]
                ])
                ->where('tsano', $this->dt->year);
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
        // $tabelaprecos = $tabelapreco->buscaTabelaTomador($tomador, $this->dt->year,null,'asc');
         // $tabelaprecos_editar = $tabelapreco->buscaTabelaPrecoEditar($id);
        $tabelaprecos = $this->tabelapreco->where('tomador_id',$tomador)->paginate(5);
        $tabelaprecos_editar = $this->tabelapreco
        ->where([
            ['id',$id],
            ['tsano',$this->dt->year]
        ])
        ->first();
        return view('tomador.tabelapreco.edit', compact('tabelaprecos_editar', 'tabelaprecos', 'tomador', 'id', 'user'));
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
            return redirect()->back()->withInput()->withErrors(['ano'=>'Só é valida data atuais!']);
        }
        try {
            $tabelaprecos = $this->tabelapreco->editar($dados, $id);
            return redirect()->back()->withSuccess('Atualizador com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false' => 'Não foi porssível realizar a atualização.']);
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
                    'mensagem' => 'Não tem tomadores registados'
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
