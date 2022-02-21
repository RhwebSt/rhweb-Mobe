<?php

namespace App\Http\Controllers\Trabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Epi;
class EpiController extends Controller
{
    private $epi;
    public function __construct()
    {
        $this->epi = new Epi;
    }
    public function index()
    {
       
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
        // dd($dados);
        $request->validate([
            'quantidade0'=>'required|max:11',
            'descricao0'=>'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/'
        ]);
        dd('ok');
        $this->epi->deletar_cadastra($dados['trabalhador']);
        for ($i=0; $i < $dados['quantidade']; $i++) { 
            $this->epi->cadastro($dados,$i);
        }
        return redirect()->route('epi.show',[$dados['trabalhador']]);
        // return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->user();
        $listaepi = $this->epi->buscalista($id);
        // dd($listaepi);
        return view('trabalhador.epi.index',compact('user','id','listaepi'));
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
        $id = base64_decode($id);
        $this->epi->deletar($id);
        return redirect()->back()->withSuccess('Deletado com sucesso.');
    }
}
