<?php

namespace App\Http\Controllers\Administrador\Categoria;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classe;
use App\ClassePrimeira;
use App\ClasseSegunda;
class CategoriaController extends Controller
{
    private $classe,$classeprimeiro,$classesegunda;
    public function __construct()
    {
        $this->classe = new Classe;
        $this->classeprimeiro = new ClassePrimeira;
        $this->classesegunda = new ClasseSegunda;
    }
    public function index()
    {
        $search = request('search');
        $lista = $this->classe->buscaListaCategoria($search,'asc');
        return view('administrador.categoria.index',compact('lista'));
    }
    public function ordem($ordem,$id = null)
    {
        $lista = $this->classe->buscaListaCategoria(null,$ordem);
        return view('administrador.categoria.index',compact('lista'));
    }
    public function pesquisa()
    {
        $classe = $this->classe->lista();
        return response()->json($classe);
    }
    public function create()
    {
        $user = Auth::user();
        return view('administrador.categoria.cadastrar',compact('user'));
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
        // dd($dados);
        // $request->validate([
        //     'codigo__categoria'=>'required|max:11',
        //     'descricao__categoria'=>'required|max:255',
        //     // 'texto1'=>'required|max:255',
        //     // 'texto2'=>'required|max:255',
        // ],[
        //     // 'codigo__cbo.required'=>'O campo não pode estar vazio.',
        //     // 'codigo__cbo.max'=>'O campo não pode conter mais de 11 caracteres.',
        //     // 'descricao__cbo.required'=>'O campo não pode estar vazio.',
        //     // 'descricao__cbo.max'=>'O campo não pode conter mais de 100 caracteres.',
        //     // 'descricao__cbo.regex'=>'O campo possui um formato inválido.',
        // ]);
        try{
            $classe = $this->classe->cadastro($dados);
            $dados['classes'] = $classe['id'];
            $this->classeprimeiro->cadastro($dados);
            $this->classesegunda->cadastro($dados);
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
        $editar = $this->classe->editar($id);
        return view('administrador.categoria.editar',compact('editar'));
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
        // dd($dados);
        // $request->validate([
        //     'codigo__categoria'=>'required|max:11',
        //     'descricao__categoria'=>'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-(),+.%]*$/',
        //     'texto1'=>'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-(),+.%]*$/',
        //     'texto2'=>'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-(),+.%]*$/',
        // ],[
        //     // 'codigo__cbo.required'=>'O campo não pode estar vazio.',
        //     // 'codigo__cbo.max'=>'O campo não pode conter mais de 11 caracteres.',
        //     // 'descricao__cbo.required'=>'O campo não pode estar vazio.',
        //     // 'descricao__cbo.max'=>'O campo não pode conter mais de 100 caracteres.',
        //     // 'descricao__cbo.regex'=>'O campo possui um formato inválido.',
        // ]);
        try{
            $this->classe->atualizar($dados,$id);
            $this->classeprimeiro->atualizar($dados,$id);
            $this->classesegunda->atualizar($dados,$id);
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
        //
    }
}
