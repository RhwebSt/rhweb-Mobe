<?php

namespace App\Http\Controllers\BoletimCartaoPonto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Bolcartaoponto;
use App\CartaoPonto;
class BoletimCartaoPontoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('cadastroCartaoPonto.cadastracartaoponto',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */ 
   
    public function create($id,$domingo = null ,$sabado = null,$diasuteis,$data,$boletim,$tomador,$feriado)
    {
        $id =  base64_decode($id);
        $domingo = base64_decode($domingo);
        $sabado = base64_decode($sabado);
        $diasuteis = base64_decode($diasuteis);
        $data = base64_decode($data);
        $boletim = base64_decode($boletim);
        $tomador = base64_decode($tomador);
        $feriado = base64_decode($feriado);
        $user = Auth::user();
        $bolcartaoponto = new Bolcartaoponto;
        $lista = $bolcartaoponto->listaCartaoPontoPaginacao($id,$data);
        return view('cadastroCartaoPonto.cadastracartaoponto',compact('user','id','lista','domingo','sabado','diasuteis','data','boletim','tomador','feriado'));
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
        $bolcartaoponto = new Bolcartaoponto;
        try {
        $bolcartaopontos = $bolcartaoponto->verifica($dados);
        if ($bolcartaopontos) {
            return redirect()->back()->withErrors(['false'=>'Este trabalhador já ta cadastrador!']);
        }
        $validator = Validator::make($request->all(), [
            'nome__completo' => 'required|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-]*$/',
            'trabalhador'=>'required',
            'matricula'=>'required|max:4',
            'entrada1'=>'max:5',
            'saida'=>'max:5',
            'entrada2'=>'max:5',
            'saida2'=>'max:5',
            'entrada3'=>'max:5',
            'saida3'=>'max:5',
            'entrada4'=>'max:5',
            'saida4'=>'max:5',
            'total'=>'max:5|required'

        ],[
            // 'total.required'=>'O campo não pode esta vazio!',
            // 'total.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'entrada1.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'saida.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'entrada2.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'saida2.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'entrada3.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'saida3.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'entrada4.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'saida4.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'nome__completo.required'=>'O campo não pode esta vazio!',
            // 'trabalhador.required'=>'O campo não pode esta vazio!',
            // 'matricula.required'=>'O campo não pode esta vazio!',
            // 'matricula.min'=>'O campo não pode ter menos de 4 caracteres'
        ]);
        if ($validator->fails()) { 
            return redirect()->back()->withErrors($validator);
        }
        $bolcartaopontos = $bolcartaoponto->cadastro($dados);
        if ($bolcartaopontos) {
            return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
        }else{
            return redirect()->back()->withErrors(['false'=>'Cadastro realizado com sucesso!']);
        }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['false'=>'Cadastro realizado com sucesso!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($trabalhador,$boletim,$data)
    {
        $bolcartaoponto = new Bolcartaoponto;
        $bolcartaopontos = $bolcartaoponto->buscaBoletimCartaoPonto($trabalhador,$boletim,$data);
        return response()->json($bolcartaopontos); 
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
        $dados = $request->all();
        
        $bolcartaoponto = new Bolcartaoponto;  
        $validator = Validator::make($request->all(), [
            'nome__completo' => 'required|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-]*$/',
            'trabalhador'=>'required',
            'matricula'=>'required|max:4',
            'entrada1'=>'max:5',
            'saida'=>'max:5',
            'entrada2'=>'max:5',
            'saida2'=>'max:5',
            'entrada3'=>'max:5',
            'saida3'=>'max:5',
            'entrada4'=>'max:5',
            'saida4'=>'max:5',
            'total'=>'max:5|required'

        ],[
            // 'total.required'=>'O campo não pode esta vazio!',
            // 'total.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'entrada1.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'saida.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'entrada2.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'saida2.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'entrada3.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'saida3.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'entrada4.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'saida4.max'=>'Campo não pode ter mais de 5 caracteres!',
            // 'nome__completo.required'=>'O campo não pode esta vazio!',
            // 'trabalhador.required'=>'O campo não pode esta vazio!',
            // 'matricula.required'=>'O campo não pode esta vazio!',
            // 'matricula.min'=>'O campo não pode ter menos de 4 caracteres'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        try {
            $bolcartaopontos = $bolcartaoponto->editar($dados,$id);
            if ($bolcartaopontos) {
                return redirect()->back()->withSuccess('Atualizador com sucesso.'); 
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['false'=>'Não foi porssivél realizar a atualização.']);
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
        $bolcartaoponto = new Bolcartaoponto; 
        try {
            $bolcartaopontos = $bolcartaoponto->deletar($id);
            if ($bolcartaopontos) {
                return redirect()->back()->withSuccess('Deletado com sucesso.'); 
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['false'=>'Não foi porssivél deleta o registro.']);
        }
    }
}
