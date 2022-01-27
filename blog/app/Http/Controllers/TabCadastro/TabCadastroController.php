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
                return redirect()->route('tabcadastro.create',$novodados)->withErrors(['false'=>'Este trabalhador já foi lançado com este código.']);
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
            $lancamentorublicas = $lancamentorublica->cadastro($dados);
            if ($lancamentorublicas == $dados['numtrabalhador']) {
                return redirect()->route('tabcadastro.create',$novodados)->withErrors(['false'=>'Os'.$dados['numtrabalhador'].' já foram lançados.']);
            }else{
                return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
            }
       } catch (\Exception $e) {
            return redirect()->back()->withErrors(['false'=>'Não foi porssivél realizar o cadastro.']);
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
    public function edit($quantidade,$boletim,$tomador,$id,$trabalhador,$data)
    {
       $lancamentorublica = new Lancamentorublica;
       $user = Auth::user();
       $lista = $lancamentorublica->listacadastro($id);
    
       $lancamentorublicas = $lancamentorublica->buscaUnidadeRublica($trabalhador);
       return view('tabelaCadastro.edit',compact('lancamentorublicas','user','boletim','quantidade','tomador','id','lista','data'));
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
        try {
            $lancamentorublica->editar($dados,$id);
            return redirect()->route('tabcadastro.create',$novodados)->withErrors(['true'=>'Atualizado com sucesso.']);
        } catch (\Throwable $th) {
            echo('Não foi porssivél realizar o cadastro.');
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
        if (!$lancamentotabelas) {
            return redirect()->route('tabcadastro.create',$novodados)->withErrors(['false'=>'Não foi porssivél deleta o registro.']);
        }
        try {
            $lancamentorublicas = $lancamentorublica->deletar($id);
            return redirect()->route('tabcadastro.create',$novodados)->withErrors(['true'=>'Registro deletado com sucesso.']);
        } catch (\Throwable $th) {
            echo('Não foi porssivél deleta o registro.');
        }
      
    }
}
