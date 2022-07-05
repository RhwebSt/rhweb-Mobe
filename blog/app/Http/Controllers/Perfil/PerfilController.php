<?php

namespace App\Http\Controllers\Perfil;

use App\Empresa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Usuario\Perfil\Validacao;
use App\User;
use App\Pessoai;
use App\Endereco;
class PerfilController extends Controller
{
    private $user,$pessoais,$endereco,$empresa;
    public function __construct()
    {
        $this->user = new User;
        $this->pessoais = new Pessoai;
        $this->endereco = new Endereco;
        $this->empresa = new Empresa;
    }
    public function index()
    {
        // 
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
        $user = auth()->user();
        $empresa = $this->empresa->where('id',$user->empresa_id)->first();
        try {
            $pessoais = $this->pessoais->editar($id);
            return view('usuarios.pessoais.index',compact('user','pessoais','empresa'));
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Erro.']);
        }
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
        
        $usuario = $this->user->where('name',$dados['nome'])->count();
        if ($usuario) {
            return redirect()->back()->withInput()->withErrors(['nome'=>'Este usuário já está sendo utilizado.']);
        }
        $request->validate([
            'nome' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'cpf' => 'required|max:15|cpf|formato_cpf',
            'data__nascimento'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'email'=>'required|email',
            'telefone'=>'required|max:16|celular_com_ddd',
            'cep'=>'required|max:16|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'logradouro'=>'required|max:50|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'numero'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'bairro'=>'required:max:40|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'localidade'=>'required|max:30|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'uf'=>'required|max:2|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
        ],
        [
            'nome__completo.required'=>'Este campo não pode estar vazio.',
            'nome__completo.max'=>'Este campo não pode conter mais de 100 caracteres.',
            'nome__completo.regex'=>'Este campo tem um formato inválido.',
            
            'nome__social.required'=>'Este campo não pode estar vazio.',
            'nome__social.max'=>'Este campo não pode conter mais de 100 caracteress.',
            'nome__social.regex'=>'Este campo tem um formato inválido.',
            
            'cpf.required'=>'Este campo não pode estar vazio.',
            'cpf.max'=>'Este campo não pode conter mais de 15 caracteres.',
            'cpf.cpf'=>'Este CPF é invalido.',
            'cpf.formato_cpf'=>'Este CPF não tem um formato válido.',
            
            'pis.required'=>'Este campo não pode estar vazio.',
            'pis.max'=>'Este campo não pode conter mais de 20 caracteres.',
            'pis.pis'=>'Este PIS é inválido.',
            
            'data_nascimento.required'=>'Este campo não pode estar vazio.',
            'data_nascimento.max'=>'Este campo não pode conter mais de 10 caracteres.',
            'data_nascimento.regex'=>'Este campo tem um formato inválido.',
            
            'pais__nascimento.required'=>'Este campo não pode estar vazio.',
            'pais__nascimento.max'=>'Este campo não pode conter mais de 40 caracteres.',
            'pais__nascimento.regex'=>'Este campo tem um formato inválido.',
            
            'pais__nacionalidade.required'=>'Este campo não pode estar vazio.',
            'pais__nacionalidade.max'=>'Este campo não pode conter mais de 40 caracteres.',
            'pais__nacionalidade.regex'=>'Este campo tem um formato inválido.',
            
            'nome__mae.required'=>'Este campo não pode estar vazio.',
            'nome__mae.max'=>'Este campo não pode conter mais de 30 caracteres.',
            'nome__mae.regex'=>'Este campo tem um formato inválido.',
            
            'telefone.required'=>'Este campo não pode estar vazio.',
            'telefone.max'=>'Este campo não pode conter mais de 16 caracteres.',
            'telefone.celular_com_ddd'=>'Este DDD não é válido.',
            
            'telefone.required'=>'Este campo não pode estar vazio.',
            'telefone.max'=>'Este campo não pode conter mais de 16 caracteres',
            'telefone.celular_com_ddd'=>'Este DDD não á válido.',
            
            'cep.required'=>'Este campo não pode estar vazio.',
            'cep.max'=>'Este campo não pode conter mais de 16 caracteres.',
            'cep.regex'=>'Este campo tem um formato inválido.',
            
            'logradouro.required'=>'Este campo não pode estar vazio.',
            'logradouro.max'=>'Este campo não pode conter mais de 40 caracteres.',
            'logradouro.regex'=>'Este campo tem um formato inválido.',
            
            'numero.required'=>'Este campo não pode estar vazio.',
            'numero.max'=>'Este campo não pode conter mais de 10 caracteres.',
            'numero.regex'=>'Este campo tem um formato inválido.',
            
            'bairro.required'=>'Este campo não pode estar vazio.',
            'bairro.max'=>'Este campo não pode conter mais de 30 caracteres.',
            'bairro.regex'=>'Este campo tem um formato inválido.',
            
            'localidade.required'=>'Este campo não pode estar vazio.',
            'localidade.max'=>'Este campo não pode conter mais de 10 caracteres.',
            'localidade.regex'=>'Este campo tem um formato inválido.',
            
            'uf.required'=>'Este campo não pode estar vazio.',
            'uf.max'=>'Este campo não pode conter mais de 2 caracteres.',
            'uf.regex'=>'Este campo tem um formato inválido.',
            
            'data__admissao.required'=>'Este campo não pode estar vazio.',
            'data__admissao.max'=>'Este campo não pode conter mais de 10 caracteres.',
            'data__admissao.regex'=>'Este campo tem um formato inválido.',
            
            'categoria__contrato.required'=>'Este campo não pode estar vazio.',
            'categoria__contrato.max'=>'Este campo não pode conter mais de 40 caracteres.',
            'categoria__contrato.regex'=>'Este campo tem um formato inválido.',
            
            'cbo.required'=>'Este campo não pode estar vazio.',
            'cbo.max'=>'Este campo não pode conter mais de 10 caracteres.',
            'cbo.regex'=>'Este campo tem um formato inválido.',
            
            'ctps.required'=>'Este campo não pode estar vazio.',
            'ctps.max'=>'Este campo não pode conter mais de 20 caracteres.',
            
            'serie__ctps.required'=>'Este campo não pode estar vazio.',
            'serie__ctps.max'=>'Este campo não pode conter mais de 20 caracteres.',
            
            'uf__ctps.required'=>'Este campo não pode estar vazio.',
            'uf__ctps.max'=>'Este campo não pode conter mais de 2 caracteres.',
            'uf__ctps.regex'=>'Este campo tem um formato inválido.',
            
            'data__afastamento.max'=>'Este campo não pode conter mais de 10 caracteres.',
            'banco.max'=>'Este campo não pode conter mais de 30 caracteres.',
            'agencia.max'=>'Este campo não pode conter mais de 4 caracteres.',
            'operacao.max'=>'Este campo não pode conter mais de 3 caracteres.',
            'conta.max'=>'Este campo não pode conter mais de 10 caracteres.',
            'pix.max'=>'Este campo não pode conter mais de 255 caracteres.'
            
        ]
        );
        try { 
            $this->user->AtualizarUsuario($dados,$id);
            $this->pessoais->atualizar($dados,$id);
            $pessoais = $this->pessoais->buscaUnidadePessoais($id);
            $dados['pessoal'] = $pessoais->id;
            $this->endereco->editarUsuario($dados);
            
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
        //
    }
}
