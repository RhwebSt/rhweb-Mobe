<?php

namespace App\Http\Controllers\Administrador\Rublica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rublica;
class RublicaController extends Controller
{
    private $rublica;
    public function __construct()
    {
        $this->rublica = new Rublica;
    }
    public function index()
    {
        $user = Auth::user();
        $search = request('search');
        $condicao = request('codicao');
        $lista = $this->rublica->lista($search,'asc');
        return view('administrador.rublica.lista',compact('user','lista'));
        // if ($condicao) {
        //     $rublicas = $this->rublica->editarRublicas($condicao);
        //     return view('administrador.rublica.edit', compact('user','rublicas','lista'));
        // }else{
        //     return view('administrador.rublica.lista',compact('user','lista'));
        // }
    }

    public function ordem($ordem,$id = null)
    {
        $user = Auth::user();
        $lista = $this->rublica->lista(null,$ordem);
        return view('administrador.rublica.lista',compact('lista'));
        // if ($id) {
        //     $rublicas = $this->rublica->editarRublicas($id);
        //     return view('rublica.edit', compact('user','rublicas','lista'));
        // }else{
        //     return view('rublica.index',compact('user','lista'));
        // }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrador.rublica.criar');
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
            'rubricas'=>'required|max:15',
            'descricao'=>'required|max:60|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-(),+.%]*$/',
            'incidencia'=>'required'
        ],[
            'rubricas.required'=>'Este campo não pode estar vazio.',
            'rubricas.max'=>'Este campo não pode conter mais de 15 caracteres.',
            'descricao.required'=>'Este campo não pode estar vazio.',
            'descricao.max'=>'Este campo não pode conter mais de 15 caracteres.',
            'descricao.regex'=>'Este campo possui um formato inválido.',
            'incidencia.required'=>'Este campo não pode estar vazio.',
        ]);
        try {
          
            $rublicas = $this->rublica->cadastro($dados); 
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
        $rublicas = $this->rublica->buscaUnidadeRublica($id);
        return response()->json($rublicas);
    }
    public function pesquisa($id = null)
    {
        $rublicas = $this->rublica->buscaListaRublica($id);
        return response()->json($rublicas);
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
        $rublicas = $this->rublica->editarRublicas($id);
        $lista = $this->rublica->lista(null,'asc');
        return view('administrador.rublica.edit', compact('user','rublicas','lista'));
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
            'rubricas'=>'required|max:15',
            'descricao'=>'required|max:20|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-(),+.%]*$/',
            'incidencia'=>'required'
        ],[
            'rubricas.required'=>'Este campo não pode estar vazio.',
            'rubricas.max'=>'Este campo não pode conter mais de 15 caracteres.',
            'descricao.required'=>'Este campo não pode estar vazio.',
            'descricao.max'=>'Este campo não pode conter mais de 15 caracteres.',
            'descricao.regex'=>'Este campo possui um formato inválido.',
            'incidencia.required'=>'Este campo não pode estar vazio.',
        ]);
        try {
            $rublicas = $this->rublica->editar($dados,$id);
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
            $rublicas = $this->rublica->deletar($id);
            return redirect()->back()->withSuccess('Deletado com sucesso.'); 
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['false'=>'Não foi possível deletar o registro.']);
        }
    }
}
