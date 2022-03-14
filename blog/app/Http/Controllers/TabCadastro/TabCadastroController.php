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
   private $lancamentorublica;
   public function __construct()
   {
    $this->lancamentorublica = new Lancamentorublica;
   }
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
        $quantidade = base64_decode($quantidade);
        $boletim = base64_decode($boletim);
        $tomador = base64_decode($tomador);
        $id = base64_decode($id);
        $data = base64_decode($data); 
        $user = Auth::user(); 
        $lista = $this->lancamentorublica->listacadastro($id);
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

        
        $quantidadeTrabalhador = $this->lancamentorublica->verificaTrabalhador($dados,$novadata);
          
            $lancamentorublicas = $this->lancamentorublica->verifica($dados,$novadata);
            if ($lancamentorublicas) {
                return redirect()->back()->withErrors(['false'=>'Este trabalhador já foi lançado com esse código.']);
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
                    'codigo.max'=>'O campo código não pode ser superior a 4 caracteres.'
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
            if ( count($quantidadeTrabalhador) == $dados['numtrabalhador']) {
                return redirect()->back()->withErrors(['false'=>'Os'.$dados['numtrabalhador'].' já foram lançados.']);
            }else{
                $this->lancamentorublica->cadastro($dados);
                return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
            }
            try {
       } catch (\Exception $e) {
            return redirect()->back()->withErrors(['false'=>'Não foi possível realizar o cadastro.']);
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
        
       $quantidade = base64_decode($quantidade);
       $boletim = base64_decode($boletim);
       $tomador = base64_decode($tomador);
       $id = base64_decode($id);
       $trabalhador = base64_decode($trabalhador);
       $data = base64_decode($data);
       $user = Auth::user();
       $lista = $this->lancamentorublica->listacadastro($id);
       $lancamentorublicas = $this->lancamentorublica->buscaUnidadeRublica($trabalhador);
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
        
        $request->validate([
            'nome__completo' => 'required',
            'matricula'=>'required|max:4',
            'rubrica'=>'required|max:60',
            'quantidade'=>'required'
        ]);
       
        
            $this->lancamentorublica->editar($dados,$id);
        
            return redirect()->back()->withSuccess('Atualizado com sucesso.');
            try {
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível realizar a atualização.']);
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
            $lancamentorublicas = $this->lancamentorublica->deletar($id);
            return redirect()->back()->withSuccess('Registro deletado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['false'=>'Não foi possivél deletar o registro.']);
        }
      
    }
}
