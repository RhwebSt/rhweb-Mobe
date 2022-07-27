<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Empresa\Validacao;
use App\Empresa;
use App\Endereco;
use App\ValoresRublica;
class PerfilController extends Controller
{
    private $endereco,$empresa,$valoresrublica;
    public function __construct()
    {
        $this->endereco = new Endereco;
        $this->empresa = new Empresa;
        $this->valoresrublica = new ValoresRublica;
    }
    public function index()
    {
        $user = Auth::user();
        // $empresa = new Empresa;
        // $empresas = $empresa->first($user->empresa);
        $empresa = $this->empresa->where('id',$user->empresa_id)->first();
        return view('usuarios.empresa.perfil',compact('user','empresa'));
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
        //
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
        $user = Auth::user();
        // $empresas = $this->empresa->buscaUnidadeEmpresa($id);
        $empresa = $this->empresa->where('id',$user->empresa_id)->first();
        $empresas = $this->empresa->where('id',$id)->with(['valoresrublica','endereco'])->first();
        return view('usuarios.empresa.perfil',compact('user','empresas','empresa'));
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
        $request->validate([
            'inivalid' => 'required|max:10',
        ],[
            'inivalid.required'=>'O campo não pode estar vazio!',
            'inivalid.max'=>'O campo não pode conter mas de 20 caracteres!',
        ]);
            $empresas = $this->empresa->editar($dados,$id);
            $endereco = $this->endereco->editarEmpresa($dados,$id);
            $this->valoresrublica->editar($dados,$id);
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
        //
    }
   
    public function editFoto(Request $request)
    {
        $dados = $request->all();
        $empresas = $this->empresa->editarFoto($dados);
        return response()->json($empresas);
    }
}
