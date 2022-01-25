<?php

namespace App\Http\Controllers\TabCartaoPonto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Lancamentotabela;
use App\Lancamentorublica;
use App\ValoresRublica;
class TabCartaoPontoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $valorrublica = new ValoresRublica;
        $numboletimtabela = $valorrublica->buscaUnidadeEmpresa($user->empresa);
        // dd($numboletimtabela);
        return view('tabCartaoPonto.index',compact('user','numboletimtabela'));
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
        $lancamentotabela = new Lancamentotabela;
        $valorrublica = new ValoresRublica;
        $user = auth()->user();
        $novadata = explode('-',$dados['data']);
        $lancamentotabelas = $lancamentotabela->verificaBoletimMes($dados,$novadata); 
        if ($lancamentotabelas) {
            return redirect()->route('tabcartaoponto.index')->withInput()->withErrors(['false'=>'Este boletim já foi cadastrador este mês!']);
        }
        $request->validate([
            'nome__completo' => 'required',
            'liboletim'=>'required|numeric',
            'matricula'=>'required|max:6',
            'num__trabalhador'=>'numeric',
            'num__trabalhador'=>'required',
            'data'=>'required',
            'tomador'=>'required',
        ],[
            'nome__completo.required'=>'Campo não pode esta vazio!',
            'tomador.required'=>'Campo não pode esta vazio!',
            'matricula.required'=>'Campo não pode esta vazio!',
            'matricula.max'=>'A matricula não pode ter mais de 4 caracteris!',
            'num__trabalhador.required'=>'Campo não pode esta vazio!',
            'num__trabalhador.numeric'=>'O campo naõ pode conter letras',
            'liboletim.required'=>'Campo não pode esta vazio!',
            'liboletim.numeric'=>'O campo naõ pode conter letras',
            'liboletim.exists'=>'O boletim ja ta cadastrado',
            'data.required'=>'O campo não pode esta vazio!'
            
        ]);
        $novodados = [
            $dados['num__trabalhador'],
            $dados['liboletim'],
            $dados['tomador']
        ];
      
        $lancamentorublica = new Lancamentorublica;
        $listalancamentotabela = $lancamentotabela->buscaUnidadeLancamentoTab($dados['liboletim'],$dados['status']);
        if (!$listalancamentotabela) {
            $lancamentotabelas = $lancamentotabela->cadastro($dados);
            $valorrublica->editarBoletimTabela($dados,$user->empresa);
            array_push($novodados,$lancamentotabelas['id']);
            array_push($novodados,$dados['data']);
            return redirect()->route('tabcadastro.create',$novodados);
        }else if ($listalancamentotabela) {
            array_push($novodados,$listalancamentotabela->id);
            array_push($novodados,$dados['data']);
            return redirect()->route('tabcadastro.create',$novodados);
        }
        $condicao = 'cadastrafalse';
        return redirect()->route('tabcartaoponto.index')->withInput()->withErrors([$condicao]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$status)
    {
        $lancamentotabela = new Lancamentotabela;
        $lancamentotabelas = $lancamentotabela->buscaUnidadeLancamentoTab($id,$status);
        return response()->json($lancamentotabelas);
    }
    public function pesquisa($id,$status) 
    {
        
        $lancamentotabela = new Lancamentotabela; 
        $lancamentotabelas = $lancamentotabela->buscaListaLancamentoTab($id,$status);
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
        //
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
            'matricula'=>'required|max:6',
            'num__trabalhador'=>'numeric',
            'num__trabalhador'=>'required',
            'data'=>'required'
        ],[
            'nome__completo.required'=>'Campo não pode esta vazio!',
            'matricula.required'=>'Campo não pode esta vazio!',
            'matricula.max'=>'A matricula não pode ter mais de 4 caracteris!',
            'num__trabalhador.required'=>'Campo não pode esta vazio!',
            'num__trabalhador.numeric'=>'O campo naõ pode conter letras',
            'liboletim.required'=>'Campo não pode esta vazio!',
            'liboletim.numeric'=>'O campo naõ pode conter letras',
            'data.required'=>'O campo não pode esta vazio!'
            
        ]);
      
        $novodados = [
            $dados['num__trabalhador'],
            $dados['liboletim'],
            $dados['tomador'],
            $id,
            $dados['data']
        ];
        $lancamentotabela = new Lancamentotabela;
        $lancamentorublica = new Lancamentorublica;
        $lancamentotabelas = $lancamentotabela->editar($dados,$id);
        if ($lancamentotabelas) {
            return redirect()->route('tabcadastro.create',$novodados);
        }else{
            $condicao = 'editfalse';
            return redirect()->route('tabcartaoponto.index')->withInput()->withErrors([$condicao]);
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
        $lancamentorublica = new Lancamentorublica;
        $lancamentotabela = new Lancamentotabela;
        $lancamentorublicas = $lancamentorublica->deletar($id);
        if ($lancamentorublicas) {
           $lancamentotabelas =  $lancamentotabela->deletar($id);
           if ($lancamentotabelas) {
                $condicao = 'deletatrue';
           }else{
                $condicao = 'deletafalse';
           }
           
        }else{
            $lancamentotabelas =  $lancamentotabela->deletar($id);
            if ($lancamentotabelas) {
                $condicao = 'deletatrue';
            }else{
                $condicao = 'deletafalse';
            }
            
        }
        return redirect()->route('tabcartaoponto.index')->withInput()->withErrors([$condicao]);
    }
}
