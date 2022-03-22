<?php

namespace App\Http\Controllers\TabelaPreco;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
        $search = request('search');
        $condicao = request('codicao');
        $tomador = base64_decode($tomador);
        $tabelaprecos = $this->tabelapreco->buscaTabelaTomador($tomador,$this->dt->year,$search,'asc');
        $user = Auth::user();
        if ($condicao) {
            $tabelaprecos_editar = $this->tabelapreco->buscaTabelaPrecoEditar($condicao);
            return view('tomador.tabelapreco.edit', compact('tabelaprecos_editar', 'tabelaprecos', 'tomador', 'id', 'user'));
        }else{
            return view('tomador.tabelapreco.index', compact('id', 'user', 'tabelaprecos', 'tomador'));
        }
    }
    public function ordem($id = null, $tomador,$ordem)
    {
        $tomador = base64_decode($tomador);
        $id = base64_decode($id);
        $tabelaprecos = $this->tabelapreco->buscaTabelaTomador($tomador,$this->dt->year,null,$ordem);
        $user = Auth::user();
        if ($id && $id != ' ') {
            $tabelaprecos_editar = $this->tabelapreco->buscaTabelaPrecoEditar($id);
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
    public function store(Request $request)
    {
        $dados = $request->all();
        $tabelapreco = new TabelaPreco;
        $request->validate([
            'ano' => 'required|max:4',
            'rubricas' => 'required|max:30',
            'descricao' => 'required|max:60|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîïôõûùüÿñæœ 0-9_\-%]*$/',
            'valor' => 'required',
            'valor__tomador' => 'required'
        ]);
        $tabelaprecos = $tabelapreco->verificaRublica($dados);
        if ($tabelaprecos) {
            return redirect()->back()->withInput()->withErrors(['descricao' => 'Esta rúbrica já está cadastrada.']);
        }
        try {
            $tabelaprecos = $tabelapreco->cadastro($dados);
            if ($tabelaprecos) {
                return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
            }
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

        $tabelapreco = new TabelaPreco;
        $tabelaprecos = $tabelapreco->buscaListaTabela($id, $tomador);
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
        $tabelapreco = new TabelaPreco;
        $tabelaprecos = $tabelapreco->buscaTabelaTomador($tomador, $this->dt->year,null,'asc');
        $tabelaprecos_editar = $tabelapreco->buscaTabelaPrecoEditar($id);
        return view('tomador.tabelapreco.edit', compact('tabelaprecos_editar', 'tabelaprecos', 'tomador', 'id', 'user'));
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
            'ano' => 'required|max:4',
            'rubricas' => 'required|max:30',
            'descricao' => 'required|max:60|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîïôõûùüÿñæœ 0-9_\-%]*$/',
            'valor' => 'required',
            'valor__tomador' => 'required'
        ]);

        $tabelapreco = new TabelaPreco;
        try {
            $tabelaprecos = $tabelapreco->editar($dados, $id);
            if ($tabelaprecos) {
                return redirect()->back()->withSuccess('Atualizador com sucesso.');
            }
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
        $tabelapreco = new TabelaPreco;
        try {
            $tabelaprecos = $tabelapreco->buscaUnidadeTabela($id);
            $excluir = $tabelapreco->deletar($id);
            return redirect()->back()->withSuccess('Deletado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['false' => 'Não foi possível deletar o registro.']);
        }
    }
    public function verificaTabelaPreco($tomador)
    {
        $tabelapreco = new TabelaPreco;
        $tabelaprecos = $tabelapreco->buscaTabelaTomador($tomador, date('Y'));
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
