<?php

namespace App\Http\Controllers\Avuso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Avuso\Validacao;
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
        $valorrublica_avuso = $this->valorrublica->buscaUnidadeEmpresa($user->empresa_id);
        $lista = $this->avuso->buscaListaRecibos();
        
        return view('avuso.index',compact('user','valorrublica_avuso','lista'));
    }
    public function filtroPesquisa(Request $request)
    {
        $dados = $request->all();
        // dd($dados);
        // $request->validate([
        //     'pesquisa' => 'required|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
        //     'ano_inicial1'=>'required|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
        //     'ano_final1'=>'required|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
        // ],
        // [
        //     'ano_inicial1.required'=>'Campo não pode esta vazio.',
        //     'ano_inicial1.regex'=>'O campo nome social tem um formato inválido.',
        //     'ano_final1.required'=>'Campo não pode esta vazio.',
        //     'ano_final1.regex'=>'O campo nome social tem um formato inválido.',
        // ]
        // );
        $user = auth()->user();
        
            $valorrublica_avuso = $this->valorrublica->buscaUnidadeEmpresa($user->empresa_id);
            $lista = $this->avuso->filtraPesquisa($dados);
            return view('avuso.index',compact('user','valorrublica_avuso','lista'));
            try {
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível realizar a pesquisa.']);
        }
    }
    public function filtroPesquisaOrdem($condicao)
    {
        $user = auth()->user();
        $valorrublica_avuso = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
        $lista = $this->avuso->buscaListaRecibosOrdem($condicao);
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
    public function store(Validacao $request)
    {
        $user = Auth::user(); 
        $dados = $request->all();
        $verifica = $this->avuso->verifica($dados['codigo']);
        if ($verifica) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Já existe um recibo com este codigo.']);
        }
        $credito = 0;
        $desconto = 0;
        $total = 0;
        for ($i = 0; $i < $dados['quantidade']; $i++) { 
            if (isset($dados['cd'.$i])) {
                if ($dados['cd'.$i] === 'Crédito') {
                    $credito += str_replace(",",".",str_replace(".","",$dados['valor'.$i]));
                }else{
                    $desconto += str_replace(",",".",str_replace(".","",$dados['valor'.$i]));
                }
            }
        }
        if ($credito < $desconto) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Desconto não pode ser maior que o crédito.']);
        }
        $total = $credito - $desconto;
        $dados['liquido'] = $total;
        
            $avuso = $this->avuso->cadastro($dados);
            if ($avuso['id']) {
                $dados['avuso'] = $avuso['id'];
                for ($i=0; $i < $dados['quantidade']; $i++) { 
                    if (isset($dados['cd'.$i])) {
                        $this->descricao->cadastro($dados,$i);
                    }
                }
                // $this->valorrublica->editarAvuso($dados,$dados['empresa']);
                $this->valorrublica->where('empresa_id', $dados['empresa'])
                ->chunkById(100, function ($valorrublica) use ($dados) {
                    foreach ($valorrublica as $valorrublicas) {
                        if ($valorrublicas->vsreciboavulso >= 0) {
                            $numero = $valorrublicas->vsreciboavulso += 1;
                            $this->valorrublica->where('empresa_id', $dados['empresa'])
                            ->update(['vsreciboavulso'=>$numero]);
                        }
                       
                    }
                });
            }
            
            return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
            try {
        } catch (\Throwable $th) {
            $this->avuso->deletar_store($dados);
            $this->valorrublica->where('empresa_id', $dados['empresa'])
            ->chunkById(100, function ($valorrublica) use ($dados) {
                foreach ($valorrublica as $valorrublicas) {
                    if ($valorrublicas->vsreciboavulso > 0) {
                        $numero = $valorrublicas->vsreciboavulso -= 1;
                        $this->valorrublica->where('empresa_id', $dados['empresa'])
                        ->update(['vsreciboavulso'=>$numero]);
                    }
                   
                }
            });
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível cadastrar o registro.']);
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
        $user = auth()->user();
        try {
            // $this->descricao->deletarAvuso($id);
            $this->avuso->deletar($id);
            $this->valorrublica->where('empresa_id', $user->empresa_id)
            ->chunkById(100, function ($valorrublica) use ($user) {
                foreach ($valorrublica as $valorrublicas) {
                    if ($valorrublicas->vsreciboavulso > 0) {
                        $numero = $valorrublicas->vsreciboavulso -= 1;
                        $this->valorrublica->where('empresa_id', $user->empresa_id)
                        ->update(['vsreciboavulso'=>$numero]);
                    }
                }
            });
            return redirect()->back()->withSuccess('Deletado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível deletar o registro.']);
        }
    }
}
