<?php

namespace App\Http\Controllers\Descontos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Descontos;
class DescontosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $desconto = new Descontos;
        $descontos = $desconto->lista($user->empresa);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all();

        $request->validate([
            'competencia' => 'required|max:20',
            'matricula' => 'required',
            'nome__trab'=>'required|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'descricao'=>'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'quinzena'=>'required|max:17|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'valor'=>'required',
        ],
        [
            'competencia.required'=>'Campo não pode esta vazio.',
            'competencia.max'=>'Campo não ter mais de 100 caracteres.',
            'matricula.required'=>'Campo não pode esta vazio.',

            'nome__trab.required'=>'Campo não pode esta vazio.',
            'nome__trab.regex'=>'O campo nome social tem um formato inválido.',
        
            'descricao.required'=>'Campo não pode esta vazio.',
            'descricao.max'=>'Campo não ter mais de 100 caracteres.',
            'descricao.regex'=>'O campo  tem um formato inválido.',

            'quinzena.required'=>'Campo não pode esta vazio.',
            'quinzena.max'=>'Campo não ter mais de 100 caracteres.',
            'quinzena.regex'=>'O campo  tem um formato inválido.',
            'valor.required'=>'Campo não pode esta vazio.',
        ]
        );
        $desconto = new Descontos;
        try {
            $descontos = $desconto->cadastro($dados);
            return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi prossível cadastrar.']);
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
        $descontos = $desconto->lista($user->empresa);
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
    public function update(Request $request, $id)
    {
        $dados = $request->all();
        
        $request->validate([
            'competencia' => 'required|max:20',
            'descricao'=>'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'quinzena'=>'required|max:17|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'valor'=>'required',
        ],
        [
            'competencia.required'=>'Campo não pode esta vazio.',
            'competencia.max'=>'Campo não ter mais de 100 caracteres.',
        
            'descricao.required'=>'Campo não pode esta vazio.',
            'descricao.max'=>'Campo não ter mais de 100 caracteres.',
            'descricao.regex'=>'O campo  tem um formato inválido.',

            'quinzena.required'=>'Campo não pode esta vazio.',
            'quinzena.max'=>'Campo não ter mais de 100 caracteres.',
            'quinzena.regex'=>'O campo  tem um formato inválido.',
            'valor.required'=>'Campo não pode esta vazio.',
        ]
        );
        $desconto = new Descontos;
        try {
            $descontos = $desconto->editar($dados,$id);
            return redirect()->back()->withSuccess('Atualizador com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssível realizar a atualização.']);
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
            return redirect()->back()->withErrors(['false'=>'Não foi porssível deletar o registro.']);
        }
    }
}
