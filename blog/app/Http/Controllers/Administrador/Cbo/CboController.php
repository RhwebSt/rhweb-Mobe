<?php

namespace App\Http\Controllers\Administrador\Cbo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Cbo;
class CboController extends Controller
{
    private $cbo;
    public function __construct()
    {
        $this->cbo = new Cbo;
    }
    public function index()
    {
        $search = request('search');
        $lista = $this->cbo->buscaListaCbo($search,'asc');
        return view('administrador.cbo.index',compact('lista'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('administrador.cbo.cadastrar',compact('user'));
    }

    public function ordem($ordem,$id = null)
    {
        $search = request('search');
        $lista = $this->cbo->buscaListaCbo(null,$ordem);
        return view('administrador.cbo.index',compact('lista'));
    }
    public function store(Request $request)
    {
        $dados = $request->all();
       
        // dd($dados);
        // $verificar =  $this->cbo->verificarCbo($dados['codigo__cbo']);
        // if ($verificar) {
        //     return redirect()->back()->withInput()->withErrors(['codigo__cbo'=>'Este CBO já esta cadastrador.']);
        // }
        // $request->validate([
        //     'codigo__cbo'=>'required|max:11',
        //     'descricao__cbo'=>'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-(),+.%]*$/',
        // ],[
        //     'codigo__cbo.required'=>'O campo não pode estar vazio.',
        //     'codigo__cbo.max'=>'O campo não pode conter mais de 11 caracteres.',
        //     'descricao__cbo.required'=>'O campo não pode estar vazio.',
        //     'descricao__cbo.max'=>'O campo não pode conter mais de 100 caracteres.',
        //     'descricao__cbo.regex'=>'O campo possui um formato inválido.',
        // ]);
        $this->cbo->cadastro($dados);
        return response()->json($dados);
        // try{
            
        //     return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
        // } catch (\Throwable $th) {
        //     return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível cadastrar.']);
        // }
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

    public function pesquisa()
    { 
        $cbo = $this->cbo->lista();
        return response()->json($cbo);
    }
    public function edit($id)
    {
        $editar = $this->cbo->editar($id);
        return view('administrador.cbo.editar',compact('editar'));
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
        $verificar =  $this->cbo->verificarCbo($dados['codigo__cbo']);
        if ($verificar) {
            return redirect()->back()->withInput()->withErrors(['codigo__cbo'=>'Este CBO já está cadastrado']);
        }
        $request->validate([
            'codigo__cbo'=>'required|max:11',
            'descricao__cbo'=>'required|max:40|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-(),+.%]*$/',
        ],[
            'codigo__cbo.required'=>'Este campo não pode estar vazio.',
            'codigo__cbo.max'=>'Este campo não pode conter mais de 11 caracteres.',
            'descricao__cbo.required'=>'Este campo não pode estar vazio.',
            'descricao__cbo.max'=>'Este campo não pode conter mais de 40 caracteres.',
            'descricao__cbo.regex'=>'Este campo possui um formato inválido.',
        ]);
        try{
            $this->cbo->atualizar($dados,$id);
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
        //
    }
}
