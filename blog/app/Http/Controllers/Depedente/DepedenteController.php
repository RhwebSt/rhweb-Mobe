<?php

namespace App\Http\Controllers\Depedente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Dependente;
use App\Empresa;

class DepedenteController extends Controller
{
   
    private $empresa,$depedente;
    public function __construct()
    {
        $this->empresa = new Empresa;
        $this->depedente = new Dependente;
    }
    public function index($depedente)
    {
        
        $id =  base64_decode($depedente);
        $depedentes = $this->depedente->buscaListaDepedente($id); 
        $user = Auth::user();
        $valorrublica_matricular = $this->empresa->where('id',$user->empresa_id)->with('valoresrublica')->first();
        return view('trabalhador.depedente.index',compact('depedentes','id','user','valorrublica_matricular'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = Auth::user();
        $valorrublica_matricular = $this->empresa->where('id',$user->empresa_id)->with('valoresrublica')->first();
        return view('trabalhador.depedente.create',compact('id','user','valorrublica_matricular'));
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
        $depedentes_cpf = $this->depedente->verificaCpf($dados);
        $depedentes_quant = $this->depedente->quantidadeDependente($dados);
        if ($depedentes_cpf) {
            return redirect()->back()->withInput()->withErrors(['dscpf'=>'Este dependente já está cadastrado neste CPF.']);
        }elseif ($depedentes_quant > 10) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Já exedeu o limite de dependentes que podem ser cadastrados.']);
        }
        $request->validate([
            'dscpf'=>'required|cpf|formato_cpf',
            'data__nascimento'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'nome__dependente'=>'required|max:60|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            // 'tipo__dependente'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-]*$/',
            // 'irrf'=>'required|max:20|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-]*$/',
            // 'sf'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-]*$/'
        ]);
        try {
            $this->depedente->cadastro($dados);
            return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível realizar o cadastro.']);
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
        $id =  base64_decode($id);
        $depedentes = $this->depedente->buscaUnidadeDepedente($id);
        $user = Auth::user();
        $valorrublica_matricular = $this->empresa->where('id',$user->empresa_id)->with('valoresrublica')->first();
        return view('trabalhador.depedente.edit',compact('depedentes','id','user','valorrublica_matricular'));
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
            // 'tipo__dependente'=>'required|max:60|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-]*$/',
            // 'irrf'=>'required|max:20|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-]*$/',
            // 'sf'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-]*$/'
        ]);
        try {
            $depedentes = $this->depedente->editar($dados,$id);
            if($depedentes) {
                return redirect()->back()->withSuccess('Atualizado com sucesso.');
            }
        } catch (\Throwable $th) {
            return redirect()->route('depedente.edit',$id)->withInput()->withErrors(['false'=>'Não foi possível atualizar os dados.']);
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
            $excluir = $this->depedente->deletar($id);
            return redirect()->back()->withSuccess('Deletado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['false'=>'Não foi possível deletar o registro.']);
        }
    }
}
