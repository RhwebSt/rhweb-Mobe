<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Empresa;
use App\Endereco;
use App\ValoresRublica;
use App\User;
use App\ValorCalculo;

class EmpresaController extends Controller
{
    private $empresa,$endereco,$valoresrublica,$user;
    public function __construct()
    {
        $this->empresa = new Empresa;
        $this->endereco = new Endereco;
        $this->valoresrublica = new ValoresRublica;
        $this->user = new User;
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
        $user = Auth::user();
        $search = request('search');
        $codicao = request('codicao');
        $empresas = $this->empresa->buscaListaEmpresaPaginate($search,'asc');
        $valorrublica_matricular = $this->empresa->where('id',$user->empresa_id)->with('valoresrublica')->first();
        if($codicao){
            $empresa = $this->empresa->buscaUnidadeEmpresa($codicao);
            return view('usuarios.empresa.editar',compact('user','empresas','empresa'));
        }else{
            return view('usuarios.empresa.index',compact('user','empresas','valorrublica_matricular'));
        }
    }
    public function ordem($ordem,$id = null,$search = null)
    {
        $user = Auth::user();
        $empresas = $this->empresa->buscaListaEmpresaPaginate($search,$ordem);
        if($id){
            $empresa = $this->empresa->buscaUnidadeEmpresa($id);
            return view('usuarios.empresa.editar',compact('user','empresas','empresa'));
        }else{
            return view('usuarios.empresa.index',compact('user','empresas'));
        }
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
        $request->validate([
            'esnome'=>'required|max:100|unique:empresas',
            'escnpj'=>'required|max:100|unique:empresas|cnpj',
            'cpf' => 'required|max:15|cpf|formato_cpf',
            'dataregistro'=>'required|max:30',
            'responsave'=>'required|max:30',
            'email'=>'required|max:100|email',
            'cnae__codigo'=>'required|max:10',
            'contribuicao__sindicato'=>'required|max:30',
            'telefone'=>'required|max:20',
            'cod__municipio'=>'required|max:10',
            'cep'=>'required|max:16',
            'logradouro'=>'required|max:50',
            'numero'=>'required|max:10',
            'bairro'=>'required:max:40',
            'localidade'=>'required|max:30',
            'uf'=>'required|max:2|uf',
            'vt__trabalhador'=>'max:15',
            'va__trabalhador'=>'max:15',
            'nro__fatura'=>'max:15',
            'nro__reciboavulso'=>'max:15',
            'matric__trabalhador'=>'max:15',
            'nro__requisicao'=>'max:15',
            'nro__boletins'=>'max:15',
            'nro__folha'=>'max:15',
            'nro__cartaoponto'=>'max:15',
            'seq__esocial'=>'max:15',
            'cbo'=>'max:15'
        ],[
            'esnome.unique'=>'Esta empresa j?? est?? cadastrada!',
            'escnpj.unique'=>'Este CNPJ j?? est?? cadastrado!'
        ]);
        
            $empresas = $this->empresa->cadastro($dados);
            if ($empresas) {
                $dados['empresa'] = $empresas['id'];
                $enderecos = $this->endereco->cadastro($dados);
                $valoresrublicas = $this->valoresrublica->cadastro($dados);
                $this->user->editusuarioprecadastro($dados['usuario'],$empresas['id']);
                return redirect()->back()->withSuccess('Cadastro realizado com sucesso.');
            }
            try {  
        } catch (\Throwable $th) {
            // $exenderecos = $this->endereco->deletarEmpresa($empresas['id']);
            // $valoresrublicas = $this->valoresrublica->deletar($empresas['id']); 
            $this->empresa->deletar($empresas['id']);
            return redirect()->back()->withInput()->withErrors(['false'=>'N??o foi poss??vel efetuar o cadastro.']);
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
        $empresas = $this->empresa->buscaUnidadeEmpresa($id); 
        return response()->json($empresas);
    }
    public function pesquisa($id)
    {
        $empresas = $this->empresa->select('id', 'esnome', 'escnpj', 'esresponsavel', 'estelefone')->get();
        return response()->json($empresas);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $search = request('search');
        $valorrublica_matricular = $this->empresa->where('id',$user->empresa_id)->with('valoresrublica')->first();
        $empresas = $this->empresa->buscaListaEmpresaPaginate($search,'asc');
        $empresa = $this->empresa->buscaUnidadeEmpresa($id);
        return view('usuarios.empresa.editar',compact('user','empresas','empresa','valorrublica_matricular'));
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
            'esnome'=>'required|max:100',
            'escnpj'=>'required|max:100',
            'dataregistro'=>'required|max:30',
            'cpf' => 'required|max:15|cpf|formato_cpf',
            'responsave'=>'required|max:30',
            'email'=>'required|max:100|email',
            'cnae__codigo'=>'required|max:10',
            'contribuicao__sindicato'=>'required|max:30',
            'telefone'=>'required|max:20|celular_com_ddd',
            'cod__municipio'=>'required|max:10',
            'cep'=>'required|max:16',
            'logradouro'=>'required|max:50',
            'numero'=>'required|max:10',
            'bairro'=>'required:max:40',
            'localidade'=>'required|max:30',
            'uf'=>'required|max:2|uf',
            'vt__trabalhador'=>'max:15',
            'va__trabalhador'=>'max:15',
            'nro__fatura'=>'max:15',
            'nro__reciboavulso'=>'max:15',
            'matric__trabalhador'=>'max:15',
            'nro__requisicao'=>'max:15',
            'nro__boletins'=>'max:15',
            'nro__folha'=>'max:15',
            'nro__cartaoponto'=>'max:15',
            'seq__esocial'=>'max:15',
            'cbo'=>'max:15'
        ]);
        
        
        $empresas = $this->empresa->editar($dados,$id);
        $enderecos = $this->endereco->editar($dados,$dados['endereco']); 
        $valoresrublicas = $this->valoresrublica->editar($dados,$id);
        return redirect()->back()->withSuccess('Atualizado com sucesso.');
        try {
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'N??o foi poss??vel atualizar.']);
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
        // $users = $this->user->deleteempresa($id);
        // $enderecos = $this->endereco->first($id,$campo);
        // $exenderecos = $this->endereco->deletar($enderecos->eiid);
        // $valoresrublicas = $this->valoresrublica->deletar($enderecos->empresa); 
        $empresas = $this->empresa->deletar($id);
        return redirect()->back()->withSuccess('Deletado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'N??o foi poss??vel deletar o registro.']);
        }
    }
}
