<?php

namespace App\Http\Controllers\BoletimCartaoPonto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Boletim\CartaoPonto\Lanca\Validacao;
use App\Bolcartaoponto;
use App\CartaoPonto;
use Carbon\Carbon;
class BoletimCartaoPontoController extends Controller
{
    private $bolcartaoponto;
    public function __construct()
    {
        $this->bolcartaoponto = new Bolcartaoponto;
    }
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
        
        // $lista = $bolcartaoponto->listaCartaoPontoPaginacao($id,$data);
        $lista = $this->bolcartaoponto->where('lancamentotabela_id',$id)
        ->with('trabalhador')->paginate(5);
        return view('cadastroCartaoPonto.cadastracartaoponto',compact('user','id','lista','domingo','sabado','diasuteis','data','boletim','tomador','feriado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Validacao $request)
    {
        $dados = $request->all(); 
        $today = Carbon::today();
        try {
        // $bolcartaopontos = $bolcartaoponto->verifica($dados);
        $bolcartaopontos = $this->bolcartaoponto->where([
            ['lancamentotabela_id', $dados['lancamento']],
            ['trabalhador_id', $dados['trabalhador']],
        ])
        ->whereDate('created_at', $today)
        ->count();
        if ($bolcartaopontos) {
            return redirect()->back()->withErrors(['false'=>'Este trabalhador já está cadastrado!']);
        }
      
        $bolcartaopontos = $this->bolcartaoponto->cadastro($dados);
        return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
       
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['false'=>'Não foi possível cadastrar o registro.']);
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
        $today = Carbon::today();
        $bolcartaoponto = new Bolcartaoponto;
        $bolcartaopontos = $bolcartaoponto->buscaBoletimCartaoPonto($trabalhador,$boletim,$today);
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
    public function update(Validacao $request, $id)
    {
        $dados = $request->all();
        try {
            $bolcartaopontos = $this->bolcartaoponto->editar($dados,$id);
            return redirect()->back()->withSuccess('Atualizador com sucesso.'); 
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
        try {
            $bolcartaopontos = $this->bolcartaoponto->deletar($id);
            return redirect()->back()->withSuccess('Deletado com sucesso.'); 
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['false'=>'Não foi porssivél deleta o registro.']);
        }
    }
}
