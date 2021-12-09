<?php

namespace App\Http\Controllers\TabCadastro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Lancamentorublica;
use App\Lancamentotabela;
class TabCadastroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('tabelaCadastro.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($quantidade,$boletim,$tomador,$id,$data)
    {
        $user = Auth::user(); 
        $lancamentorublica = new Lancamentorublica;
        $lista = $lancamentorublica->listacadastro($id);
        return view('tabelaCadastro.index',compact('user','boletim','quantidade','tomador','id','lista','data'));
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
        $novadata = explode('-',$dados['data']);
        $lancamentorublica = new Lancamentorublica;
        $novodados = [
            $dados['numtrabalhador'],
            $dados['boletim'],
            $dados['tomador'],
            $dados['lancamento'],
            $dados['data']
        ];
        try {
            $lancamentorublicas = $lancamentorublica->verifica($dados,$novadata);
            if ($lancamentorublicas) {
                $condicao = 'jacadastrador';
                return redirect()->route('tabcadastro.create',$novodados)->withErrors($condicao);
            }
            $validator = Validator::make($request->all(), [
                'nome__completo' => 'required',
                'matricula'=>'required|max:4',
                'codigo'=>'required|max:4',
                'rubrica'=>'required|max:60',
                'quantidade'=>'required'
            ],
                [
                    'codigo.required'=>'O campo codigo é obrigatório.',
                    'codigo.max'=>'O campo codigo não pode ser superior a 4 caracteres.'
                ]
            );
            if ($validator->fails()) {
            return redirect()->route('tabcadastro.create',$novodados)->withErrors($validator);
            }
            $condicao = '';
            $lancamentorublicas = $lancamentorublica->cadastro($dados);
            if ($lancamentorublicas) {
                $condicao = 'cadastratrue';
            }else{
                $condicao = 'cadastrafalse';
            }
            return redirect()->route('tabcadastro.create',$novodados)->withErrors([$condicao]);
       } catch (\Exception $e) {
            echo('Não foi porssivél realizar o cadastro.');
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
        $lancamentorublica = new Lancamentorublica;
        $lancamentorublicas = $lancamentorublica->listafirst($id);
        return response()->json($lancamentorublicas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
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
        $lancamentorublica = new Lancamentorublica;
        $novodados = [
            $dados['numtrabalhador'],
            $dados['boletim'],
            $dados['tomador'],
            $dados['lancamento'],
            $dados['data']
        ];
        $validator = Validator::make($request->all(), [
            'nome__completo' => 'required',
            'matricula'=>'required|max:4',
            'rubrica'=>'required|max:60',
            'quantidade'=>'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route('tabcadastro.create',$novodados)->withErrors($validator);
        }
        $condicao = '';
        $lancamentorublicas = $lancamentorublica->editar($dados,$id);
        if ($lancamentorublicas) {
            $condicao = 'edittrue';
        }else{
            $condicao = 'editfalse';
        }
        return redirect()->route('tabcadastro.create',$novodados)->withErrors([$condicao]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lancamentotabela = new Lancamentotabela;
        $lancamentorublica = new Lancamentorublica;
        $lancamentorublicas = $lancamentorublica->UnidadeRublica($id);
        $novadata = explode(' ',$lancamentorublicas->created_at);
        $lancamentotabelas = $lancamentotabela->buscaUnidadeLancamentoTab($lancamentorublicas->lancamento);
        $novodados = [
            $lancamentotabelas->lsnumero,
            $lancamentotabelas->liboletim,
            $lancamentotabelas->tomador,
            $lancamentotabelas->id,
            $novadata[0]
        ];
        $lancamentorublicas = $lancamentorublica->deletar($id);
        if ($lancamentorublicas) {
            $condicao = 'deletatrue';
        }else{
            $condicao = 'deletafalse';
        }
        return redirect()->route('tabcadastro.create',$novodados)->withErrors([$condicao]);
    }
}
