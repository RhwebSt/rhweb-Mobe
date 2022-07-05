<?php

namespace App\Http\Controllers\BoletimCartaoPonto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Boletim\CartaoPonto\Lanca\Validacao;
use Spatie\Permission\Models\Permission;
use App\Bolcartaoponto;
use App\CartaoPonto;
use Carbon\Carbon;
use App\Empresa;
use DataTables;
class BoletimCartaoPontoController extends Controller
{
    private $bolcartaoponto,$empresa;
    public function __construct()
    {
        $this->bolcartaoponto = new Bolcartaoponto;
        $this->empresa = new Empresa;
        
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
        $empresa = $this->empresa->where('id',$user->empresa_id)->first();
        // $permissions = Permission::where('name','like','%'.'mbcpl'.'%')->first(); 
        // if ($user->hasPermissionTo($permissions->name) === false && $user->hasPermissionTo('admin') === false){
        //     return redirect()->back()->withInput()->withErrors(['permissaonegada'=>'true']);
        // }
        // $lista = $bolcartaoponto->listaCartaoPontoPaginacao($id,$data);
        $lista = $this->bolcartaoponto->where('lancamentotabela_id',$id)
        ->with('trabalhador')->paginate(5);
        // dd($lista,$id);
        return view('cadastroCartaoPonto.cadastracartaoponto',compact('user','empresa','id','lista','domingo','sabado','diasuteis','data','boletim','tomador','feriado'));
    }

   public function listaDiurno()
   {
        $user = Auth::user();
        $diurno = $this->bolcartaoponto
        ->join('lancamentotabelas', 'lancamentotabelas.id', '=', 'bolcartaopontos.lancamentotabela_id')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
        ->join('cartao_pontos', 'tomadors.id', '=', 'cartao_pontos.tomador_id')
        ->join('trabalhadors', 'trabalhadors.id', '=', 'bolcartaopontos.trabalhador_id')
        ->select(
            'bolcartaopontos.*',
            'lancamentotabelas.liboletim',
            'lancamentotabelas.tomador_id',
            'lancamentotabelas.lsdata',
            'lancamentotabelas.lsferiado',
            'trabalhadors.tsnome',
            'trabalhadors.tsmatricula',
            'cartao_pontos.csdiasuteis',
            'cartao_pontos.cssabados',
            'cartao_pontos.csdomingos'
        )
        ->where([
            ['lancamentotabelas.empresa_id',$user->empresa_id],
            ['bolcartaopontos.bsentradamanhao','!=',null],
            ['bolcartaopontos.bssaidamanhao','!=',null]
        ])
        ->orWhere([
            ['lancamentotabelas.empresa_id',$user->empresa_id],
            ['bolcartaopontos.bsentradatarde','!=',null],
            ['bolcartaopontos.bssaidatarde','!=',null]
        ])
        ->get();
        return DataTables::of($diurno)
        ->addColumn('id', function($id) {
            return[
                'editar'=>'<a href="'.route('boletim.cartaoponto.edit',[base64_encode($id->id),base64_encode($id->lancamentotabela_id),base64_encode($id->csdomingos)?$id->csdomingos:' ',$id->cssabados?base64_encode($id->cssabados):' ',$id->csdiasuteis?base64_encode($id->csdiasuteis):' ',base64_encode($id->lsdata),base64_encode($id->liboletim),base64_encode($id->tomador_id),base64_encode($id->lsferiado)]).'" class="button__editar btn" ><i class="icon__color fas fa-pen"></i></a>',
                'excluir'=>' <a class="btn button__excluir"  data-bs-toggle="modal" data-bs-target="#deleteListaDiurno'.$id->id.'"><i class="icon__color fad fa-trash"></i></a>
                <section class="delete__tabela--tomador">
                      <div class="modal fade" id="deleteListaDiurno'.$id->id.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered col-8">
                              <div class="modal-content">
                                  <form action="'.route('boletimcartaoponto.destroy',base64_encode($id->id)).'" id="" method="post">
                                  <input type="hidden" name="_token" value="'.csrf_token().'">
                                  <input type="hidden" name="method" value="delete">
                                      <div class="modal-header header__modal">
                                          <h5 class="modal-title" id="rolDescontoTrabLabel"><i class="fad fa-trash"></i> Deletar</h5>
                                          <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
                                      </div>
                                      
                                      <div class="modal-body body__modal ">
                                              <div class="d-flex align-items-center justify-content-center flex-column">
                                                  <img class="gif__warning--delete" src="'.url('imagem/complain.png').'">
                                              
                                                  <p class="content--deletar">Deseja realmente excluir?</p>
                                                                            
                                                  <p class="content--deletar2">Obs: Este trabalhador não irá fazer mais parte dos cálculos.</p>
                                              </div>
                                      </div>
                                      
                                      <div class="modal-footer">
                                          <button type="button" class="btn botao__fechar--modal" data-bs-dismiss="modal"><i class="fad fa-times-circle"></i> Não</button>
                                          <button type="submit" class="btn botao__deletar--modal  modal-botao"><i class="fad fa-trash"></i> Deletar</button>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </section>'
            ];
        })
        ->rawColumns(['id.editar','id.excluir'])
        ->make(true);
   }
   public function listaNoturno()
   {
        $user = Auth::user();
        $diurno = $this->bolcartaoponto
        ->join('lancamentotabelas', 'lancamentotabelas.id', '=', 'bolcartaopontos.lancamentotabela_id')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
        ->join('cartao_pontos', 'tomadors.id', '=', 'cartao_pontos.tomador_id')
        ->join('trabalhadors', 'trabalhadors.id', '=', 'bolcartaopontos.trabalhador_id')
        ->select(
            'bolcartaopontos.*',
            'lancamentotabelas.liboletim',
            'lancamentotabelas.tomador_id',
            'lancamentotabelas.lsdata',
            'lancamentotabelas.lsferiado',
            'trabalhadors.tsnome',
            'trabalhadors.tsmatricula',
            'cartao_pontos.csdiasuteis',
            'cartao_pontos.cssabados',
            'cartao_pontos.csdomingos'
        )
        ->where([
            ['lancamentotabelas.empresa_id',$user->empresa_id],
            ['bolcartaopontos.bsentradanoite','!=',null],
            ['bolcartaopontos.bssaidanoite','!=',null]
        ])
        ->orWhere([
            ['lancamentotabelas.empresa_id',$user->empresa_id],
            ['bolcartaopontos.bsentradamadrugada','!=',null],
            ['bolcartaopontos.bssaidamadrugada','!=',null]
        ])
        ->get();
        return DataTables::of($diurno)
        ->addColumn('id', function($id) {
            return[
                'editar'=>'<a href="'.route('boletim.cartaoponto.edit',[base64_encode($id->id),base64_encode($id->lancamentotabela_id),base64_encode($id->csdomingos)?$id->csdomingos:' ',$id->cssabados?base64_encode($id->cssabados):' ',$id->csdiasuteis?base64_encode($id->csdiasuteis):' ',base64_encode($id->lsdata),base64_encode($id->liboletim),base64_encode($id->tomador_id),base64_encode($id->lsferiado)]).'" class="button__editar btn" ><i class="icon__color fas fa-pen"></i></a>',
                'excluir'=>' <a class="btn button__excluir"  data-bs-toggle="modal" data-bs-target="#deleteListaDiurno'.$id->id.'"><i class="icon__color fad fa-trash"></i></a>
                <section class="delete__tabela--tomador">
                      <div class="modal fade" id="deleteListaDiurno'.$id->id.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered col-8">
                              <div class="modal-content">
                                  <form action="'.route('boletimcartaoponto.destroy',base64_encode($id->id)).'" id="" method="post">
                                  <input type="hidden" name="_token" value="'.csrf_token().'">
                                  <input type="hidden" name="method" value="delete">
                                      <div class="modal-header header__modal">
                                          <h5 class="modal-title" id="rolDescontoTrabLabel"><i class="fad fa-trash"></i> Deletar</h5>
                                          <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
                                      </div>
                                      
                                      <div class="modal-body body__modal ">
                                              <div class="d-flex align-items-center justify-content-center flex-column">
                                                  <img class="gif__warning--delete" src="'.url('imagem/complain.png').'">
                                              
                                                  <p class="content--deletar">Deseja realmente excluir?</p>
                                                                            
                                                  <p class="content--deletar2">Obs: Este trabalhador não irá fazer mais parte dos cálculos.</p>
                                              </div>
                                      </div>
                                      
                                      <div class="modal-footer">
                                          <button type="button" class="btn botao__fechar--modal" data-bs-dismiss="modal"><i class="fad fa-times-circle"></i> Não</button>
                                          <button type="submit" class="btn botao__deletar--modal  modal-botao"><i class="fad fa-trash"></i> Deletar</button>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </section>'
            ];
        })
        ->rawColumns(['id.editar','id.excluir'])
        ->make(true);
   }
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
        $empresa = $this->empresa->where('id',$user->empresa_id)->first();
        return view('cadastroCartaoPonto.cartaoPonto.edit',compact('empresa','bolcartaoponto','user','id','lista','domingo','sabado','diasuteis','data','boletim','tomador','feriado'));
        
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
            return redirect()->back()->withSuccess('Atualizado com sucesso.'); 
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['false'=>'Não foi possível atualizar.']);
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
            return redirect()->back()->withErrors(['false'=>'Não foi possível deletar o registro.']);
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