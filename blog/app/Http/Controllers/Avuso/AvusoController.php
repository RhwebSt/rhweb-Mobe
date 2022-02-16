<?php

namespace App\Http\Controllers\Avuso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Avuso;
use App\AvusoDescricao;
use App\ValoresRublica;
class AvusoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $avuso,$descricao,$valorrublica;
   public function __construct()
    {
        $this->avuso = new Avuso;
        $this->descricao = new AvusoDescricao;
        $this->valorrublica = new ValoresRublica;

    }
    public function index()
    {
        $user = Auth::user();
        $valorrublica_avuso = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
        $lista = $this->avuso->buscaListaRecibos();
        
        return view('avuso.index',compact('user','valorrublica_avuso','lista'));
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
        $user = Auth::user();
        $dados = $request->all();
        
        $request->validate([
            'nome' => 'required|max:60|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'cpf' => 'required|max:15|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
            'ano_inicial'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'ano_final'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'descricao0'=>'required|max:60|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'valor0'=>'required',
        ],[
            'descricao0.required'=>'Campo não pode esta vazio.',
            'descricao0.max'=>'Campo não ter mais de 60 caracteres.',
            'descricao0.regex'=>'O campo nome social tem um formato inválido.',

            'ano_inicial.required'=>'Campo não pode esta vazio.',
            'ano_inicial.max'=>'Campo não ter mais de 60 caracteres.',
            'ano_inicial.regex'=>'O campo nome social tem um formato inválido.',

            'ano_final.required'=>'Campo não pode esta vazio.',
            'ano_final.max'=>'Campo não ter mais de 60 caracteres.',
            'ano_final.regex'=>'O campo nome social tem um formato inválido.',

            'valor0.required'=>'Campo não pode esta vazio.',
        ]);
        $credito = 0;
        $desconto = 0;
        $total = 0;
        for ($i = 0; $i < $dados['quantidade']; $i++) { 
            if ($dados['cd'.$i] === 'Crédito') {
                $credito += str_replace(",",".",$dados['valor'.$i]);
            }else{
                $desconto += str_replace(",",".",$dados['valor'.$i]);
            }
        }
        $total = $credito - $desconto;
        $dados['liquido'] = $total;
        $avuso = $this->avuso->cadastro($dados);
        $dados['avuso'] = $avuso['id'];
        for ($i=0; $i < $dados['quantidade']; $i++) { 
            $this->descricao->cadastro($dados,$i);
        }
        $this->valorrublica->editarAvuso($dados,$user->empresa);
        return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
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
        //
    }

    public function pesquisa($id = null)
    {
        $avuso = $this->avuso->buscaListaAvuso($id);
        return response()->json($avuso);
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
        //
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
            $this->descricao->deletarAvuso($id);
            $this->avuso->deletar($id);
            return redirect()->back()->withSuccess('Deletado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssível deletar o registro.']);
        }
    }
}
