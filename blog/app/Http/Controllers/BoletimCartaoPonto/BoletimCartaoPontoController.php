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
        // dd($lista,$id);
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
        if ($dados['entrada1']) {
            if (self::calcularhoras($dados['entrada1']) < 5 || self::calcularhoras($dados['entrada1']) >= 12) {
                return redirect()->back()->withErrors(['entrada1'=>'Este campo só pode receber valores entre 05 à 12 horas']);
            }
        }
        if ($dados['saida']) {
            if (self::calcularhoras($dados['saida']) < 5 || self::calcularhoras($dados['saida']) >= 15) {
                return redirect()->back()->withErrors(['saida'=>'Este campo só pode receber valores entre 05 à 15 horas']);
            }
        }
        if ($dados['entrada2']) {
                if (self::calcularhoras($dados['entrada2']) < 12 && self::calcularhoras($dados['entrada2']) > 22) {
                    return redirect()->back()->withErrors(['entrada2'=>'Este campo só pode receber valores entre 12 à 22 horas']);
                }
        }
        if ($dados['saida2']) {
            if (self::calcularhoras($dados['saida2']) < 12 || self::calcularhoras($dados['saida2']) > 22) {
                return redirect()->back()->withErrors(['saida2'=>'Este campo só pode receber valores entre 12 à 22 horas']);
            }
        }
        if ($dados['entrada3']) {
            if (self::calcularhoras($dados['entrada3']) < 22) {
                return redirect()->back()->withErrors(['entrada3'=>'Este campo só pode receber valores entre 22 à 03 horas']);
            }
        }
        if ($dados['saida3']) {
            if (self::calcularhoras($dados['saida3']) >= 0 && self::calcularhoras($dados['saida3']) <= 5) {
               
            }else{
                return redirect()->back()->withErrors(['saida3'=>'Este campo só pode receber valores entre 03 à 05 horas']);
            }
        }
       if ($dados['entrada4']) {
        if (self::calcularhoras($dados['entrada4']) >= 0 && self::calcularhoras($dados['entrada4']) <= 5) {
        
        }else{
            return redirect()->back()->withErrors(['entrada4'=>'Este campo só pode receber valores entre 00 à 05 horas']);
        }
       }
       if ($dados['saida4']) {
        if (self::calcularhoras($dados['saida4']) >= 0 && self::calcularhoras($dados['saida4']) <= 5) { 
        
        }else{
            return redirect()->back()->withErrors(['saida4'=>'Este campo só pode receber valores entre 00 à 05 horas']);
        }
       }
        // $today = Carbon::today();
        
        // $bolcartaopontos = $bolcartaoponto->verifica($dados);
        // $bolcartaopontos = $this->bolcartaoponto->where([
        //     ['lancamentotabela_id', $dados['lancamento']],
        //     ['trabalhador_id', $dados['trabalhador']],
        // ])
        // ->whereDate('created_at', $today)
        // ->count();
        $bolcartaopontos = $this->bolcartaoponto->buscaBoletimCartaoPonto($dados['trabalhador'],$dados['lancamento'],$dados['data']);
        if ($bolcartaopontos) {
            return redirect()->back()->withErrors(['false'=>'Este trabalhador já está cadastrado!']);
        }
      
        $bolcartaopontos = $this->bolcartaoponto->cadastro($dados);
        return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
        try {
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
        // $today = Carbon::today();
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
    public function edit($id,$idboletim,$domingo = null ,$sabado = null,$diasuteis,$data,$boletim,$tomador,$feriado)
    {
        $id =  base64_decode($id);
        $idboletim = base64_decode($idboletim);
        $domingo = base64_decode($domingo);
        $sabado = base64_decode($sabado);
        $diasuteis = base64_decode($diasuteis);
        $data = base64_decode($data);
        $boletim = base64_decode($boletim);
        $tomador = base64_decode($tomador);
        $feriado = base64_decode($feriado);
        $lista = $this->bolcartaoponto->where('lancamentotabela_id',$idboletim)
        ->with('trabalhador')->paginate(5);
        $bolcartaoponto = $this->bolcartaoponto->where('id',$id)
        ->with('trabalhador:id,tsnome,tsmatricula')->first();
        $id = $idboletim;
        // dd($idboletim ,$id);
        $user = Auth::user();
        return view('cadastroCartaoPonto.cartaoPonto.edit',compact('bolcartaoponto','user','id','lista','domingo','sabado','diasuteis','data','boletim','tomador','feriado'));
        
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
        // dd(self::calcularhoras($dados['saida4']),'ok');
        // dd($dados,(int)$result);
        if ($dados['entrada1']) {
            if (self::calcularhoras($dados['entrada1']) < 5 || self::calcularhoras($dados['entrada1']) >= 12) {
                return redirect()->back()->withErrors(['entrada1'=>'Este campo só pode receber valores entre 05 à 12 horas']);
            }
        }
        if ($dados['saida']) {
            if (self::calcularhoras($dados['saida']) < 5 || self::calcularhoras($dados['saida']) >= 15) {
                return redirect()->back()->withErrors(['saida'=>'Este campo só pode receber valores entre 05 à 15 horas']);
            }
        }
        if ($dados['entrada2']) {
                if (self::calcularhoras($dados['entrada2']) < 12 && self::calcularhoras($dados['entrada2']) > 22) {
                    return redirect()->back()->withErrors(['entrada2'=>'Este campo só pode receber valores entre 12 à 22 horas']);
                }
        }
        if ($dados['saida2']) {
            if (self::calcularhoras($dados['saida2']) < 12 || self::calcularhoras($dados['saida2']) > 22) {
                return redirect()->back()->withErrors(['saida2'=>'Este campo só pode receber valores entre 12 à 22 horas']);
            }
        }
        if ($dados['entrada3']) {
            if (self::calcularhoras($dados['entrada3']) < 22) {
                return redirect()->back()->withErrors(['entrada3'=>'Este campo só pode receber valores entre 22 à 03 horas']);
            }
        }
        if ($dados['saida3']) {
            if (self::calcularhoras($dados['saida3']) >= 0 && self::calcularhoras($dados['saida3']) <= 5) {
               
            }else{
                return redirect()->back()->withErrors(['saida3'=>'Este campo só pode receber valores entre 03 à 05 horas']);
            }
        }
       if ($dados['entrada4']) {
        if (self::calcularhoras($dados['entrada4']) >= 0 && self::calcularhoras($dados['entrada4']) <= 5) {
        
        }else{
            return redirect()->back()->withErrors(['entrada4'=>'Este campo só pode receber valores entre 00 à 05 horas']);
        }
       }
       if ($dados['saida4']) {
        if (self::calcularhoras($dados['saida4']) >= 0 && self::calcularhoras($dados['saida4']) <= 5) { 
        
        }else{
            return redirect()->back()->withErrors(['saida4'=>'Este campo só pode receber valores entre 00 à 05 horas']);
        }
       }
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
public function calcularhoras($horas)
{
    if(strpos($horas,':')){
        list($horas,$minitos) = explode(':',$horas);
        $horasex = $horas * 3600 + $minitos * 60;
        $horasex = $horasex/60;
        $horasex = ($horasex/60);
    }else{
        $horasex = $horas;
    }
    return $horasex; 
}
}