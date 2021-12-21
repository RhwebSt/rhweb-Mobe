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
        $user = Auth::user();
        $bolcartaoponto = new Bolcartaoponto;
        $lista = $bolcartaoponto->listaCartaoPontoPaginacao($id);
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
        $novodados = [
            $dados['lancamento'],
            $dados['domingo'],
            $dados['sabado'],
            $dados['diasuteis'],
            $dados['data'],
            $dados['boletim'],
            $dados['tomador'],
            $dados['feriado']
        ];
        $bolcartaoponto = new Bolcartaoponto;
        try {
        $bolcartaopontos = $bolcartaoponto->verifica($dados);
        if ($bolcartaopontos) {
            return redirect()->route('boletimcartaoponto.create',$novodados)->withErrors(['false'=>'Este trabalhador já ta cadastrador!']);
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
            return redirect()->route('boletimcartaoponto.create',$novodados)->withErrors($validator);
        }
        $bolcartaopontos = $bolcartaoponto->cadastro($dados);
        if ($bolcartaopontos) {
            return redirect()->route('boletimcartaoponto.create',$novodados)->withErrors(['true'=>'Cadastro realizado com sucesso!']);
        }else{
            return redirect()->route('boletimcartaoponto.create',$novodados)->withErrors(['false'=>'Cadastro realizado com sucesso!']);
        }
        } catch (\Throwable $th) {
            $id = 'cartao ponto';
            return view('error',compact('id','novodados'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($trabalhador,$boletim)
    {
        $bolcartaoponto = new Bolcartaoponto;
        $bolcartaopontos = $bolcartaoponto->buscaBoletimCartaoPonto($trabalhador,$boletim);
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
        $novodados = [
            $dados['lancamento'],
            $dados['domingo'],
            $dados['sabado'],
            $dados['diasuteis'],
            $dados['data'],
            $dados['boletim'],
            $dados['tomador'],
            $dados['feriado']
        ];
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
            return redirect()->route('boletimcartaoponto.create',$novodados)->withErrors($validator);
        }
        try {
            $bolcartaopontos = $bolcartaoponto->editar($dados,$id);
            if ($bolcartaopontos) {
                return redirect()->route('boletimcartaoponto.create',$novodados)->withErrors(['true'=>'Atualizado com sucesso!']);
            }else{
                return redirect()->route('boletimcartaoponto.create',$novodados)->withErrors(['false'=>'Não foi porssível atualizar os dados!']);
            }
        } catch (\Throwable $th) {
            $id = 'cartao ponto';
            return view('error',compact('id','novodados'));
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
        $cartaoponto = new CartaoPonto;
        $bolcartaopontos = $bolcartaoponto->buscaUnidadeLancamento($id);
        $cartaopontos = $cartaoponto->buscaTomador($bolcartaopontos->tomador);
        $novodados = [
            $bolcartaopontos->id,
            $cartaopontos->csdomingos?$cartaopontos->csdomingos:0,
            $cartaopontos->cssabados? $cartaopontos->cssabados:0,
            $cartaopontos->csdiasuteis,
            $bolcartaopontos->lsdata,
            $bolcartaopontos->liboletim,
            $bolcartaopontos->tomador,
            $bolcartaopontos->lsferiado
        ];
        try {
            $bolcartaopontos = $bolcartaoponto->deletar($id);
            if ($bolcartaopontos) {
                return redirect()->route('boletimcartaoponto.create',$novodados)->withErrors(['true'=>'Deletador com sucesso!']);
            }
        } catch (\Throwable $th) {
            $id = 'cartao ponto';
            return view('error',compact('id','novodados'));
        }
    }
}
