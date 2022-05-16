<?php

namespace App\Http\Controllers\Descontos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Desconto\Validacao;
use Illuminate\Support\Facades\DB;
use App\Descontos;
use App\Folhar;
class DescontosController extends Controller
{
    private $folhar;
    public function __construct()
    {
        $this->folhar = new Folhar;
    }
    public function index()
    {
        $user = Auth::user();
        $desconto = new Descontos;
        $search = request('search');
        $condicao = request('codicao');
        $descontos = $desconto->lista($user->empresa_id,$search,'asc');
        if ($condicao) {
            $dadosdescontos = $desconto->buscaUnidadeDesconto($condicao);
            return view('desconto.editDesconto',compact('user','descontos','dadosdescontos'));
        }
        
        return view('desconto.descontos',compact('user','descontos'));
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

    public function ordem($ordem,$id = null)
    {
       
        $user = Auth::user();
        $desconto = new Descontos;
        $descontos = $desconto->lista($user->empresa_id,null,$ordem);
        if ($id) {
            $dadosdescontos = $desconto->buscaUnidadeDesconto($id);
            return view('desconto.editDesconto',compact('user','descontos','dadosdescontos'));
        }
        
        return view('desconto.descontos',compact('user','descontos'));
    }
    public function store(Validacao $request)
    {
        $dados = $request->all();
        $folhar = $this->folhar
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar_id')
        ->select('folhars.id')
        ->where(function($query) use ($dados){
            if ($dados['quinzena'] === '2 - Segunda') {
                $datainicio = $dados['competencia'].'-16';
                $datafinal = $dados['competencia'].'-31';
                // dd($datainicio,$dados['quinzena']);
                $query->where([
                    ['folhars.empresa_id', $dados['empresa']],
                    ['base_calculos.trabalhador_id',$dados['trabalhador']],
                    ['base_calculos.tomador_id',null]
                ])
                ->whereBetween('folhars.fsfinal',[$datainicio,$datafinal]);
                // ->where('folhars.fsinicio','>',$datainicio)
                // ->where('folhars.fsfinal','<=',$datafinal);
               
            }else{
                $datainicio = $dados['competencia'].'-01';
                $datafinal = $dados['competencia'].'-15';
                $query->where([
                    ['folhars.empresa_id', $dados['empresa']],
                    ['base_calculos.trabalhador_id',$dados['trabalhador']],
                    ['base_calculos.tomador_id',null]
                ])
                ->whereBetween('folhars.fsfinal',[$datainicio,$datafinal]);
            }
        })->first();
    
        if ($folhar) {
            return redirect()->back()->withInput()->withErrors(['false'=>'A folhar já foi calculada nesta quizena.']);
        }
        $desconto = new Descontos;
        try {
            $descontos = $desconto->cadastro($dados);
            return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
            
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível cadastrar.']);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $user = Auth::user();
        $desconto = new Descontos;
        $descontos = $desconto->lista($user->empresa_id,null,'asc');
        $dadosdescontos = $desconto->buscaUnidadeDesconto($id);
        return view('desconto.editDesconto',compact('user','descontos','dadosdescontos'));
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
        
        // $request->validate([
        //     'competencia' => 'required|max:20',
        //     'descricao'=>'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
        //     'quinzena'=>'required|max:17|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
        //     'valor'=>'required',
        // ],
        // [
        //     'competencia.required'=>'O campo não pode estar vazio.',
        //     'competencia.max'=>'O campo não ter mais de 100 caracteres.',
        
        //     'descricao.required'=>'O campo não pode estar vazio.',
        //     'descricao.max'=>'O campo não ter mais de 100 caracteres.',
        //     'descricao.regex'=>'O campo possui um formato inválido.',

        //     'quinzena.required'=>'O campo não pode estar vazio.',
        //     'quinzena.max'=>'O campo não ter mais de 100 caracteres.',
        //     'quinzena.regex'=>'O campo possui um formato inválido.',
        //     'valor.required'=>'O campo não pode estar vazio.',
        // ]
        // );
        $desconto = new Descontos;
        try {
            $descontos = $desconto->editar($dados,$id);
            return redirect()->back()->withSuccess('Atualizado com sucesso.');
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
        $desconto = new Descontos;
        try {
            $descontos = $desconto->deletar($id);
            return redirect()->back()->withSuccess('Deletado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['false'=>'Não foi possível deletar o registro.']);
        }
    }
}
