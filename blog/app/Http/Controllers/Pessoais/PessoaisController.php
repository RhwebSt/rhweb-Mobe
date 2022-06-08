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
        dd($dados);
        $usuario = $this->user->where('name',$dados['nome'])->count();
        if ($usuario) {
            return redirect()->back()->withInput()->withErrors(['nome'=>'Este usuário já está sendo utilizado.']);
        }
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
            'nome__completo.required'=>'Este campo não pode estar vázio.',
            'nome__completo.max'=>'Este campo não pode conter mais de 30 caracteres.',
            'nome__completo.regex'=>'Este campo tem um formato inválido.',
            
            'nome__social.required'=>'Este campo não pode estar vázio.',
            'nome__social.max'=>'Este campo não pode conter mais de 30 caracteres.',
            'nome__social.regex'=>'Este campo tem um formato inválido.',
            
            'cpf.required'=>'Este campo não pode estar vázio.',
            'cpf.max'=>'Este campo não pode conter mais de 15 caracteres.',
            'cpf.cpf'=>'Este CPF é inválido.',
            'cpf.formato_cpf'=>'Este CPF não possui um formato válido.',
            
            'pis.required'=>'Este campo não pode estar vázio.',
            'pis.max'=>'Este campo não pode conter mais de 20 caracteres.',
            'pis.pis'=>'Este PIS é inválido.',
            
            'data_nascimento.required'=>'Este campo não pode estar vázio.',
            'data_nascimento.max'=>'Este campo não pode conter mais de 10 caracteres.',
            'data_nascimento.regex'=>'Este campo tem um formato inválido.',
            
            'pais__nascimento.required'=>'Este campo não pode estar vázio.',
            'pais__nascimento.max'=>'Este campo não pode conter mais de 30 caracteres.',
            'pais__nascimento.regex'=>'Este campo tem um formato inválido.',
            
            'pais__nacionalidade.required'=>'Este campo não pode estar vázio.',
            'pais__nacionalidade.max'=>'Este campo não pode conter mais de 30 caracteres.',
            'pais__nacionalidade.regex'=>'Este campo tem um formato inválido.',
            
            'nome__mae.required'=>'Este campo não pode estar vázio.',
            'nome__mae.max'=>'Este campo não pode conter mais de 30 caracteres..',
            'nome__mae.regex'=>'Este campo tem um formato inválido.',
            
            'telefone.required'=>'Este campo não pode estar vázio.',
            'telefone.max'=>'Este campo não pode conter mais de 16 caracteres.',
            'telefone.celular_com_ddd'=>'Este DDD não é válido.',
            
            'telefone.required'=>'Este campo não pode estar vázio.',
            'telefone.max'=>'Este campo não pode conter mais de 16 caracteres.',
            'telefone.celular_com_ddd'=>'Este DDD não é válido.',
            
            'cep.required'=>'Este campo não pode estar vázio.',
            'cep.max'=>'Este campo não pode conter mais de 16 caracteres.',
            'cep.regex'=>'Este campo tem um formato inválido.',
            
            'logradouro.required'=>'Este campo não pode estar vázio.',
            'logradouro.max'=>'Este campo não pode conter mais de 40 caracteres.',
            'logradouro.regex'=>'Este campo tem um formato inválido.',
            
            'numero.required'=>'Este campo não pode estar vázio.',
            'numero.max'=>'Este campo não pode conter mais de 10 caracteres.',
            'numero.regex'=>'Este campo tem um formato inválido.',
            
            'bairro.required'=>'Este campo não pode estar vázio.',
            'bairro.max'=>'Este campo não pode conter mais de 30 caracteres.',
            'bairro.regex'=>'Este campo tem um formato inválido.',
            
            'localidade.required'=>'Este campo não pode estar vázio.',
            'localidade.max'=>'Este campo não pode conter mais de 30 caracteres..',
            'localidade.regex'=>'Este campo tem um formato inválido.',
            
            'uf.required'=>'Este campo não pode estar vázio.',
            'uf.max'=>'Este campo não pode conter mais de 2 caracteres..',
            'uf.regex'=>'Este campo tem um formato inválido.',
            
            'data__admissao.required'=>'Este campo não pode estar vázio.',
            'data__admissao.max'=>'Este campo não pode conter mais de 10 caracteres..',
            'data__admissao.regex'=>'Este campo tem um formato inválido.',
            
            'categoria__contrato.required'=>'Este campo não pode estar vázio.',
            'categoria__contrato.max'=>'Este campo não pode conter mais de 30 caracteres..',
            'categoria__contrato.regex'=>'Este campo tem um formato inválido.',
            
            'cbo.required'=>'Este campo não pode estar vázio.',
            'cbo.max'=>'Este campo não pode conter mais de 30 caracteres..',
            'cbo.regex'=>'Este campo tem um formato inválido.',
            
            'ctps.required'=>'Este campo não pode estar vázio.',
            'ctps.max'=>'Este campo não pode conter mais de 20 caracteres..',
            
            'serie__ctps.required'=>'Este campo não pode estar vázio.',
            'serie__ctps.max'=>'Este campo não pode conter mais de 10 caracteres..',
            
            'uf__ctps.required'=>'Este campo não pode estar vázio.',
            'uf__ctps.max'=>'Este campo não pode conter mais de 2 caracteres..',
            'uf__ctps.regex'=>'Este campo tem um formato inválido.',
            
            'data__afastamento.max'=>'Este campo não pode conter mais de 10 caracteres..',
            'banco.max'=>'Este campo não pode conter mais de 30 caracteres..',
            'agencia.max'=>'Este campo não pode conter mais de 4 caracteres..',
            'operacao.max'=>'Este campo não pode conter mais de 3 caracteres..',
            'conta.max'=>'Este campo não pode conter mais de 10 caracteres..',
            'pix.max'=>'Este campo não pode conter mais de 255 caracteres..'
            
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
