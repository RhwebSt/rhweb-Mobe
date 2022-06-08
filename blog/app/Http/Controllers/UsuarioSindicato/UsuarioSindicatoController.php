<?php

namespace App\Http\Controllers\UsuarioSindicato;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Empresa;
use App\Endereco;
use App\ValoresRublica;
use App\Pessoai;
use App\User;
class UsuarioSindicatoController extends Controller
{
   
    private $empresa,$endereco,$valoresrublica,$user,$pessoais;
    public function __construct()
    {
        $empresa = new Empresa;
        $endereco = new Endereco;
        $this->pessoais = new Pessoai;
        $valoresrublica = new ValoresRublica;
        $this->user = new User;
    }
    public function index()
    {
        $user = Auth::user();
        $empresas = $this->empresa->first($user->empresa);
        return view('usuarios.trabalhador.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.cadastroUsuario');
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
        try {
        $empresas = $this->empresa->cadastro($dados);
        if ($empresas) {
            // $dados['tomador'] = $empresas['id'];
            $dados['empresa'] = $empresas['id'];
            $enderecos = $this->endereco->cadastro($dados);
            $valoresrublicas = $this->valoresrublica->cadastro($dados);
        
            return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
        }
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível cadastrar.']);
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
        $user = $this->user->verificausuario($id);
        if($user){
            return redirect()->route('login.create');
        }
        return view('usuarios.cadastroUsuario',compact('id'));
        // $empresas = $this->empresa->first($id);
        // return response()->json($empresas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user();
        $pessoais = $this->pessoais->editar($id);
        if (!$pessoais) {
            $pessoais = $this->user->edit($id);
        }
       return view('usuarios.pessoais.index',compact('user','pessois'));
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
            'nome' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'cpf' => 'required|max:15|cpf|formato_cpf',
            'data__nascimento'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'email'=>'required|email|unique:users',
            'telefone'=>'required|max:16|celular_com_ddd',
            'cep'=>'required|max:16|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'logradouro'=>'required|max:50|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'numero'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'bairro'=>'required:max:40|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'localidade'=>'required|max:30|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'uf'=>'required|max:2|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
        ],
        [
            'nome__completo.required'=>'Este Este campo não pode esta vazio.',
            'nome__completo.max'=>'Este campo não conter mais de 40 caracteres.',
            'nome__completo.regex'=>'Este campo tem um formato inválido',
            
            'nome__social.required'=>'Este campo não pode esta vazio.',
            'nome__social.max'=>'Este campo não conter mais de 40 caracteres.',
            'nome__social.regex'=>'Este campo tem um formato inválido.',
            
            'cpf.required'=>'Este campo não pode esta vazio.',
            'cpf.max'=>'Este campo não conter mais de 15 caracteres.',
            'cpf.cpf'=>'Este CPF é inválido.',
            'cpf.formato_cpf'=>'Este CPF não tem um formato válido.',
            
            'pis.required'=>'Este campo não pode esta vazio.',
            'pis.max'=>'Este campo não conter mais de 20 caracteres.',
            'pis.pis'=>'Este PIS é inválido.',
            
            'data_nascimento.required'=>'Este campo não pode esta vazio.',
            'data_nascimento.max'=>'CEste campo não conter mais de 10 caracteres.',
            'data_nascimento.regex'=>'Este campo tem um formato inválido.',
            
            'pais__nascimento.required'=>'Este campo não pode esta vazio.',
            'pais__nascimento.max'=>'Este campo não conter mais de 40 caracteres.',
            'pais__nascimento.regex'=>'Este campo tem um formato inválido.',
            
            'pais__nacionalidade.required'=>'Este campo não pode esta vazio.',
            'pais__nacionalidade.max'=>'Este campo não conter mais de 40 caracteres.',
            'pais__nacionalidade.regex'=>'Este campo tem um formato inválido.',
            
            'nome__mae.required'=>'Este campo não pode esta vazio.',
            'nome__mae.max'=>'Este campo não conter mais de 40 caracteres.',
            'nome__mae.regex'=>'Este campo tem um formato inválido.',
            
            'telefone.required'=>'Este campo não pode esta vazio.',
            'telefone.max'=>'Este campo não conter mais de 16 caracteres.',
            'telefone.celular_com_ddd'=>'Este DDD não é válido.',
            
            'telefone.required'=>'Este campo não pode esta vazio.',
            'telefone.max'=>'Este campo não conter mais de 16 caracteres.',
            'telefone.celular_com_ddd'=>'Este DDD não é válido.',
            
            'cep.required'=>'Este campo não pode esta vazio.',
            'cep.max'=>'Este campo não conter mais de 16 caracteres.',
            'cep.regex'=>'Este campo tem um formato inválido.',
            
            'logradouro.required'=>'Este campo não pode esta vazio.',
            'logradouro.max'=>'Este campo não conter mais de 40 caracteres.',
            'logradouro.regex'=>'Este campo tem um formato inválido.',
            
            'numero.required'=>'Este campo não pode esta vazio.',
            'numero.max'=>'Este campo não conter mais de 10 caracteres.',
            'numero.regex'=>'Este campo tem um formato inválido.',
            
            'bairro.required'=>'Este campo não pode esta vazio.',
            'bairro.max'=>'Este campo não conter mais de 10 caracteres.',
            'bairro.regex'=>'Este campo tem um formato inválido.',
            
            'localidade.required'=>'Este campo não pode esta vazio.',
            'localidade.max'=>'Este campo não conter mais de 10 caracteres.',
            'localidade.regex'=>'Este campo tem um formato inválido.',
            
            'uf.required'=>'Este campo não pode esta vazio.',
            'uf.max'=>'Este campo não conter mais de 10 caracteres.',
            'uf.regex'=>'Este campo tem um formato inválido.',
            
            'data__admissao.required'=>'Este campo não pode esta vazio.',
            'data__admissao.max'=>'Este campo não conter mais de 10 caracteres.',
            'data__admissao.regex'=>'Este campo tem um formato inválido.',
            
            'categoria__contrato.required'=>'Este campo não pode esta vazio.',
            'categoria__contrato.max'=>'Este campo não conter mais de 40 caracteres.',
            'categoria__contrato.regex'=>'Este campo tem um formato inválido.',
            
            'cbo.required'=>'Este campo não pode esta vazio.',
            'cbo.max'=>'Este campo não conter mais de 40 caracteres.',
            'cbo.regex'=>'Este campo tem um formato inválido.',
            
            'ctps.required'=>'Este campo não pode esta vazio.',
            'ctps.max'=>'Este campo não conter mais de 20 caracteres.',
            
            'serie__ctps.required'=>'Este campo não pode esta vazio.',
            'serie__ctps.max'=>'Este campo não conter mais de 20 caracteres.',
            
            'uf__ctps.required'=>'Este campo não pode esta 2 caracteress.',
            'uf__ctps.regex'=>'Este campo tem um formato inválido.',
            
            'data__afastamento.max'=>'Este campo não conter mais de 10 caracteres.',
            'banco.max'=>'Este campo não conter mais de 40 caracteres.',
            'agencia.max'=>'Este campo não conter mais de 4 caracteres.',
            'operacao.max'=>'Este campo não conter mais de 3 caracteres.',
            'conta.max'=>'Este campo não conter mais de 10 caracteres.',
            'pix.max'=>'Este campo não conter mais de 255 caracteres.'
            
        ]
        );
        try {
        
        $this->user->AtualizarUsuario($dados,$id);
        $pessoais = $this->pessoais->editar($id);
        if (!$pessoais) {
            $pessoais = $this->pessoais->cadastra($dados);
            $dados['pessoal'] = $pessoais['id'];
            $this->endereco->cadastro($dados);
        }else {
            $dados['pessoal'] = $pessoais->id;
            $this->pessoais->Atualizar($dados,$id);
            $this->endereco->editarUsuario($dados,$id);
        }
            return redirect()->back()->withSuccess('Atualizado com sucesso.'); 
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
        $campo = 'empresa';
        try {
            $enderecos = $this->endereco->first($id,$campo); 
            $exenderecos = $this->endereco->deletar($enderecos->eiid); 
            $valoresrublicas = $this->valoresrublica->deletar($enderecos->empresa); 
            if ($exenderecos &&  $valoresrublicas) {
                $empresas = $this->empresa->deletar($enderecos->empresa);
            }
            return redirect()->back()->withSuccess('Deletado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível deletar o registro.']);
        } 
    }
}
