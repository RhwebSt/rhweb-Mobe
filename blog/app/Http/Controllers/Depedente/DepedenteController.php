<?php

namespace App\Http\Controllers\Depedente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Dependente;
class DepedenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($depedente)
    {
        
        $id = $depedente;
        $depedente = new Dependente;
        $depedentes = $depedente->buscaListaDepedente($id); 
        // dd($depedentes);
        $user = Auth::user();
        return view('trabalhador.depedente.index',compact('depedentes','id','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = Auth::user();
        return view('trabalhador.depedente.create',compact('id','user'));
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
        $depedente = new Dependente;
        $depedentes_cpf = $depedente->verificaCpf($dados);
        $depedentes_quant = $depedente->quantidadeDependente($dados);
        if ($depedentes_cpf) {
            return redirect()->back()->withInput()->withErrors(['dscpf'=>'Este dependente já está cadastrado neste CPF.']);
        }elseif ($depedentes_quant > 10) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Já exedeu o limite de dependentes.']);
        }
        $request->validate([
            'dscpf'=>'required|cpf|formato_cpf',
            'data__nascimento'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-]*$/',
            'nome__dependente'=>'required|max:30|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-]*$/',
            'tipo__dependente'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-]*$/',
            'irrf'=>'required|max:20|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-]*$/',
            'sf'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-]*$/'
        ]);
        $id = $dados['trabalhador'];
        
        $depedentes = $depedente->cadastro($dados);
        if ($depedentes) {
            return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
        }
         
        try {
            //code...
        } catch (\Throwable $th) {
            return redirect()->route('depedente.mostrar.create',$id)->withInput()->withErrors(['false'=>'Não foi porssivél realizar o cadastro.']);
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $depedente = new Dependente;
        $depedentes = $depedente->buscaUnidadeDepedente($id);
        $user = Auth::user();
        return view('trabalhador.depedente.edit',compact('depedentes','id','user'));
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
            'dscpf'=>'required|cpf|formato_cpf',
            'data__nascimento'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-]*$/',
            'nome__dependente'=>'required|max:30|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-]*$/',
            'tipo__dependente'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-]*$/',
            'irrf'=>'required|max:20|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-]*$/',
            'sf'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-]*$/'
        ]);
        $depedente = new Dependente;
        try {
            $depedentes = $depedente->editar($dados,$id);
            if($depedentes) {
                return redirect()->back()->withSuccess('Atualizador realizado com sucesso.');
            }
        } catch (\Throwable $th) {
            return redirect()->route('depedente.edit',$id)->withInput()->withErrors(['false'=>'Não foi porssivél atualizar os dados.']);
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
        $depedente = new Dependente;
        try {
            $excluir = $depedente->deletar($id);
            return redirect()->back()->withSuccess('Deletado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['false'=>'Não foi porssível deletar o registro.']);
        }
    }
}
