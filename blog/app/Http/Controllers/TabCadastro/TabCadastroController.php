<?php

namespace App\Http\Controllers\TabCadastro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Boletim\Tabela\Lanca\Validacao;
use Spatie\Permission\Models\Permission;
use App\Lancamentorublica;
use App\Lancamentotabela;
use DataTables;
class TabCadastroController extends Controller
{
   private $lancamentorublica;
   public function __construct()
   {
    $this->lancamentorublica = new Lancamentorublica;
   }
    public function index()
    {
        $user = Auth::user();
        return view('tabelaCadastro.index',compact('user'));
    }

    public function create($quantidade,$boletim,$tomador,$id,$data)
    {
        $quantidade = base64_decode($quantidade);
        // dd($quantidade);
        // $boletim = base64_decode($boletim);
        // $tomador = base64_decode($tomador);
        $id = base64_decode($id);
        
        // $data = base64_decode($data); 
        $search = request('search');
        $trabalhador = request('codicao');
        $user = Auth::user(); 
        // $lista = $this->lancamentorublica->listacadastro($search,$id,'M','asc');
        //  $permissions = Permission::where('name','like','%'.'mbctl'.'%')->first(); 
        // if ($user->hasPermissionTo($permissions->name) === false && $user->hasPermissionTo('admin') === false){
        //     return redirect()->back()->withInput()->withErrors(['permissaonegada'=>'true']);
        // }
        $lista = $this->lancamentorublica->where('lancamentotabela_id',$id)
        ->with('trabalhador')->paginate(10);
        if ($trabalhador) {
            $lancamentorublicas = $this->lancamentorublica->buscaUnidadeRublica($trabalhador);
            return view('tabelaCadastro.edit',compact('lancamentorublicas','user','boletim','quantidade','tomador','id','lista','data','trabalhador'));
        }else{
            return view('tabelaCadastro.index',compact('user','boletim','quantidade','tomador','id','lista','data'));
        }
    }

    public function lista($id)
    {
        $lancamentorublica = $this->lancamentorublica->where('lancamentotabela_id',$id)
        ->join('lancamentotabelas', 'lancamentotabelas.id', '=', 'lancamentorublicas.lancamentotabela_id')
        ->join('trabalhadors', 'trabalhadors.id', '=', 'lancamentorublicas.trabalhador_id')
        ->select('lancamentorublicas.*','trabalhadors.tsnome','lancamentotabelas.liboletim','lancamentotabelas.tomador_id','lancamentotabelas.lsdata')
        ->get();
        return DataTables::of($lancamentorublica)
        ->addColumn('id', function($id) {
            return [
                'unitario'=>'R$ '.number_format((float)$id->lfvalor, 2, ',', '.'),
                'total'=>'R$ '.number_format((float)($id->lfvalor*$id->lsquantidade), 2, ',', '.'),
                'editar'=>' <a href="'.route('boletim.tabela.edit',[base64_encode($id->lsquantidade),base64_encode($id->liboletim),base64_encode($id->tomador_id),base64_encode($id->lancamentotabela_id),base64_encode($id->id),base64_encode($id->lsdata)]).'" class="button__editar btn" ><i class="icon__color fas fa-pen"></i></a>',
                'excluir'=>' <button  class="btn button__excluir" data-bs-toggle="modal" data-bs-target="#deleteBoletimTabPrecoInside'.$id->id.'"><i class="icon__color fad fa-trash"></i></button>
                <section class="delete__tabela--boletim">
                    <div class="modal fade" id="deleteBoletimTabPrecoInside'.$id->id.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered col-8"> 
                            <div class="modal-content">
                                <form action="'.route('boletim.tabela.destroy',$id->id).'" id="" method="post">
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
                                                
                                                <p class="content--deletar2">Obs: Este trabalhador não irá fazer mais parte dos cálculos</p>
                                                
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
        ->rawColumns(['id.unitario','id.total','id.editar','id.excluir'])
        ->make(true);
    }
    public function ordem($quantidade,$boletim,$tomador,$id,$trabalhador,$data,$ordem)
    {
        // $quantidade = base64_decode($quantidade);
        // $boletim = base64_decode($boletim);
        // $tomador = base64_decode($tomador);
        $id = base64_decode($id);
        $trabalhador = base64_decode($trabalhador);
        
        // $data = base64_decode($data); 
        $search = request('search');
        $user = Auth::user(); 
        $lista = $this->lancamentorublica->listacadastro($search,$id,'M',$ordem);
        if ($trabalhador) {
            $lancamentorublicas = $this->lancamentorublica->buscaUnidadeRublica($trabalhador);
            return view('tabelaCadastro.edit',compact('lancamentorublicas','user','boletim','quantidade','tomador','id','lista','data','trabalhador'));
        }else{
            return view('tabelaCadastro.index',compact('user','boletim','quantidade','tomador','id','lista','data'));
        }
    }
    public function store(Validacao $request)
    {
        $dados = $request->all();
        $user = auth()->user();
        // dd($dados);
        // $novadata = explode('-',$dados['data']);

        
        // $quantidadeTrabalhador = $this->lancamentorublica->verificaTrabalhador($dados,$novadata);
        // $lancamentorublicas = $this->lancamentorublica->verifica($dados,$novadata);
        $trabalhador = $this->lancamentorublica->where([
            ['lancamentotabela_id',$dados['lancamento']],
            ['trabalhador_id',$dados['trabalhador']],
            ['licodigo',$dados['codigo']]
            // ['empresa_id', $user->empresa_id]
        ])
        ->whereDate('created_at',$dados['data'])
        ->count();
        $quantrabalhador = $this->lancamentorublica->where([
            ['lancamentotabela_id',$dados['lancamento']],
            // ['empresa_id', $user->empresa_id]
        ])
        ->whereDate('created_at', $dados['data'])
        ->count();
            if ($trabalhador) {
                return redirect()->back()->withErrors(['false'=>'Este trabalhador já foi lançado com esse código.']);
            }
          
          
            if ( $quantrabalhador == $dados['numtrabalhador']) {
                return redirect()->back()->withErrors(['false'=>'Os'.$dados['numtrabalhador'].' já foram lançados.']);
            }else{
                $this->lancamentorublica->cadastro($dados);
                return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
            }
            try {
       } catch (\Exception $e) {
            return redirect()->back()->withErrors(['false'=>'Não foi possível realizar o cadastro.']);
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
        $lancamentorublica = new Lancamentorublica;
        $lancamentorublicas = $lancamentorublica->listafirst($id);
        return response()->json($lancamentorublicas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($quantidade,$boletim,$tomador,$id,$trabalhador,$data)
    {
        
    //    $quantidade = base64_decode($quantidade);
    //    $boletim = base64_decode($boletim);
    //    $tomador = base64_decode($tomador);
       $id = base64_decode($id);
       $trabalhador = base64_decode($trabalhador);
    //    $data = base64_decode($data);
       $user = Auth::user();
       $lista = $this->lancamentorublica->where('lancamentotabela_id',$id)
       ->with('trabalhador')->paginate(10);
    //    $lista = $this->lancamentorublica->listacadastro(null,$id,'M','asc');
      
    
       $lancamentorublicas = $this->lancamentorublica->buscaUnidadeRublica($trabalhador);
       
       return view('tabelaCadastro.edit',compact('lancamentorublicas','user','boletim','quantidade','tomador','id','lista','data','trabalhador'));
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
            'nome__completo' => 'required',
            'matricula'=>'required|max:4',
            'rubrica'=>'required|max:60',
            'quantidade'=>'required'
        ]);
       
        
            $this->lancamentorublica->editar($dados,$id);
        
            return redirect()->back()->withSuccess('Atualizado com sucesso.');
            try {
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
        try {
            $lancamentorublicas = $this->lancamentorublica->deletar($id);
            return redirect()->back()->withSuccess('Registro deletado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['false'=>'Não foi possível deletar o registro.']);
        }
      
    }
}
