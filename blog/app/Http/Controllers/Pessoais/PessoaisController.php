<?php

namespace App\Http\Controllers\Pessoais;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Pessoai;
use App\Endereco;
class PessoaisController extends Controller
{
    private $user,$pessoais,$endereco;
    public function __construct()
    {
        $this->user = new User;
        $this->pessoais = new Pessoai;
        $this->endereco = new Endereco;
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
        $pessoais = $this->pessoais->editar($id);
        if (!$pessoais) {
            $pessoais = $this->user->edit($id);
            
        }
        return view('usuarios.pessoais.index',compact('user','pessoais'));
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
            'nome__completo.required'=>'Campo não pode esta vazio.',
            'nome__completo.max'=>'Campo não ter mais de 100 caracteres.',
            'nome__completo.regex'=>'O campo nome social tem um formato inválido.',
            
            'nome__social.required'=>'Campo não pode esta vazio.',
            'nome__social.max'=>'Campo não ter mais de 100 caracteres.',
            'nome__social.regex'=>'O campo nome social tem um formato inválido.',
            
            'cpf.required'=>'Campo não pode esta vazio.',
            'cpf.max'=>'Campo não ter mais de 15 caracteres.',
            'cpf.cpf'=>'Este CPF é invalido.',
            'cpf.formato_cpf'=>'Este CPF não tem um formato valido.',
            
            'pis.required'=>'Campo não pode esta vazio.',
            'pis.max'=>'Campo não ter mais de 20 caracteres.',
            'pis.pis'=>'Este CPF é invalido.',
            
            'data_nascimento.required'=>'Campo não pode esta vazio.',
            'data_nascimento.max'=>'Campo não ter mais de 10 caracteres.',
            'data_nascimento.regex'=>'O campo nome social tem um formato inválido.',
            
            'pais__nascimento.required'=>'Campo não pode esta vazio.',
            'pais__nascimento.max'=>'Campo não ter mais de 60 caracteres.',
            'pais__nascimento.regex'=>'O campo nome social tem um formato inválido.',
            
            'pais__nacionalidade.required'=>'Campo não pode esta vazio.',
            'pais__nacionalidade.max'=>'Campo não ter mais de 60 caracteres.',
            'pais__nacionalidade.regex'=>'O campo nome social tem um formato inválido.',
            
            'nome__mae.required'=>'Campo não pode esta vazio.',
            'nome__mae.max'=>'Campo não ter mais de 60 caracteres.',
            'nome__mae.regex'=>'O campo nome social tem um formato inválido.',
            
            'telefone.required'=>'Campo não pode esta vazio.',
            'telefone.max'=>'Campo não ter mais de 16 caracteres.',
            'telefone.celular_com_ddd'=>'Este DDD não e valido.',
            
            'telefone.required'=>'Campo não pode esta vazio.',
            'telefone.max'=>'Campo não ter mais de 16 caracteres.',
            'telefone.celular_com_ddd'=>'Este DDD não e valido.',
            
            'cep.required'=>'Campo não pode esta vazio.',
            'cep.max'=>'Campo não ter mais de 16 caracteres.',
            'cep.regex'=>'O campo nome social tem um formato inválido.',
            
            'logradouro.required'=>'Campo não pode esta vazio.',
            'logradouro.max'=>'Campo não ter mais de 50 caracteres.',
            'logradouro.regex'=>'O campo nome social tem um formato inválido.',
            
            'numero.required'=>'Campo não pode esta vazio.',
            'numero.max'=>'Campo não ter mais de 10 caracteres.',
            'numero.regex'=>'O campo nome social tem um formato inválido.',
            
            'bairro.required'=>'Campo não pode esta vazio.',
            'bairro.max'=>'Campo não ter mais de 10 caracteres.',
            'bairro.regex'=>'O campo nome social tem um formato inválido.',
            
            'localidade.required'=>'Campo não pode esta vazio.',
            'localidade.max'=>'Campo não ter mais de 10 caracteres.',
            'localidade.regex'=>'O campo nome social tem um formato inválido.',
            
            'uf.required'=>'Campo não pode esta vazio.',
            'uf.max'=>'Campo não ter mais de 10 caracteres.',
            'uf.regex'=>'O campo nome social tem um formato inválido.',
            
            'data__admissao.required'=>'Campo não pode esta vazio.',
            'data__admissao.max'=>'Campo não ter mais de 10 caracteres.',
            'data__admissao.regex'=>'O campo nome social tem um formato inválido.',
            
            'categoria__contrato.required'=>'Campo não pode esta vazio.',
            'categoria__contrato.max'=>'Campo não ter mais de 255 caracteres.',
            'categoria__contrato.regex'=>'O campo nome social tem um formato inválido.',
            
            'cbo.required'=>'Campo não pode esta vazio.',
            'cbo.max'=>'Campo não ter mais de 225 caracteres.',
            'cbo.regex'=>'O campo nome social tem um formato inválido.',
            
            'ctps.required'=>'Campo não pode esta vazio.',
            'ctps.max'=>'Campo não ter mais de 20 caracteres.',
            
            'serie__ctps.required'=>'Campo não pode esta vazio.',
            'serie__ctps.max'=>'Campo não ter mais de 20 caracteres.',
            
            'uf__ctps.required'=>'Campo não pode esta vazio.',
            'uf__ctps.max'=>'Campo não ter mais de 255 caracteres.',
            'uf__ctps.regex'=>'O campo nome social tem um formato inválido.',
            
            'data__afastamento.max'=>'Campo não ter mais de 10 caracteres.',
            'banco.max'=>'Campo não ter mais de 100 caracteres.',
            'agencia.max'=>'Campo não ter mais de 4 caracteres.',
            'operacao.max'=>'Campo não ter mais de 3 caracteres.',
            'conta.max'=>'Campo não ter mais de 10 caracteres.',
            'pix.max'=>'Campo não ter mais de 225 caracteres.'
            
        ]
        );
        try {
            //code...
        
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
            return redirect()->back()->withSuccess('Atualizador com sucesso.'); 
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssivél realizar a atualização.']);
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
