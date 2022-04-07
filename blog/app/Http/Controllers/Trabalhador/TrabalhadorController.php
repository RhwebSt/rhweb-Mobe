<?php

namespace App\Http\Controllers\Trabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Trabalhador;
use App\Endereco;
use App\Bancario;
use App\Nascimento;
use App\Categoria;
use App\Documento;
use App\Dependente;
use App\Bolcartaoponto;
use App\Lancamentorublica;
use App\Comissionado;
use App\ValoresRublica;
use App\BaseCalculo;
use App\Esocial;
class TrabalhadorController extends Controller
{
    private $trabalhador,$endereco,$bancario,$nascimento,$categoria,$valorrublica,
    $documento,$dependente,$bolcartaoponto,$lancamentorublica,$comissionado,$basecalculo,
    $esocial;
    public function __construct()
    {
        $this->trabalhador = new Trabalhador;
        $this->endereco = new Endereco;
        $this->bancario = new Bancario;
        $this->nascimento = new Nascimento;
        $this->categoria = new Categoria;
        $this->valorrublica = new ValoresRublica;
        $this->documento = new Documento;
        $this->dependente = new Dependente;
        $this->bolcartaoponto = new Bolcartaoponto;
        $this->lancamentorublica = new Lancamentorublica; 
        $this->comissionado = new Comissionado;
        $this->basecalculo = new BaseCalculo;  
        $this->esocial = new Esocial; 
    }
    public function index()
    {
        
        $user = Auth::user(); 
        $search = request('search');
        $condicao = request('codicao');
        $trabalhadors = $this->trabalhador->lista($search,'asc');
        $esocialtrabalhador = $this->esocial->notificacaoCadastroTrabalhador();
        if ($condicao) {
            $trabalhador = $this->trabalhador->buscaUnidadeTrabalhador($condicao);
            return view('trabalhador.edit',compact('user','trabalhador','trabalhadors','esocialtrabalhador'));
        }else{
            $valorrublica_matricular = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
            return view('trabalhador.index',compact('user','valorrublica_matricular','trabalhadors','esocialtrabalhador'));
        }
    }

    public function ordem($ordem,$id = null,$search = null)
    {
        $user = Auth::user();
        $trabalhadors = $this->trabalhador->lista($search,$ordem);
        $esocialtrabalhador = $this->esocial->notificacaoCadastroTrabalhador();
        if ($id) {
            $trabalhador = $this->trabalhador->buscaUnidadeTrabalhador($id);
            return view('trabalhador.edit',compact('user','trabalhador','trabalhadors','esocialtrabalhador'));
        }else{
            $valorrublica_matricular = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
            return view('trabalhador.index',compact('user','valorrublica_matricular','trabalhadors','esocialtrabalhador'));
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('trabalhador.create',compact('user'));
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
        $user = auth()->user();
       
        
        $trabalhadorscpf = $this->trabalhador->VerificarCadastroCpf($dados);
        $documentospis = $this->documento->VerificarCadastroPis($dados);
        $documentosctps = $this->documento->VerificarCadastroCtps($dados);
        
        
        $request->validate([
            'nome__completo' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'nome__social' => 'max:100',
            'cpf' => 'required|max:15|cpf|formato_cpf',
            'pis'=>'required|max:20|pis',
            'data_nascimento'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'pais__nascimento'=>'required|max:60|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'pais__nacionalidade'=>'required|max:60|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'nome__mae'=>'required|max:50|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'telefone'=>'required|max:16',
            'cep'=>'required|max:16|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'logradouro'=>'required|max:50|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'numero'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'bairro'=>'required:max:40|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'localidade'=>'required|max:30|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'uf'=>'required|max:2|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'data__admissao'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'categoria__contrato'=>'required|max:255|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'cbo'=>'required|max:255|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'ctps'=>'required|max:20',
            'serie__ctps'=>'required|max:20',
            'uf__ctps'=>'required|max:2|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'data__afastamento'=>'max:10',
            'banco'=>'max:100',
            'agencia'=>'max:4',
            'operacao'=>'max:3',
            'conta'=>'max:10',
            'pix'=>'max:255'
        ],
        [
            'nome__completo.required'=>'O campo não pode estar vazio.',
            'nome__completo.max'=>'O campo não pode conter mais de 100 caracteres.',
            'nome__completo.regex'=>'O campo nome social tem um formato inválido.',
            
            'nome__social.required'=>'O campo não pode estar vazio.',
            'nome__social.max'=>'O campo não pode conter mais de 100 caracteres.',
            'nome__social.regex'=>'O campo nome social tem um formato inválido.',
            
            'cpf.required'=>'O campo não pode estar vazio.',
            'cpf.max'=>'O campo não pode conter mais de 15 caracteres.',
            'cpf.cpf'=>'Este CPF é invalido.',
            'cpf.formato_cpf'=>'Este CPF não possui um formato valido.',
            
            'pis.required'=>'O campo não pode estar vazio.',
            'pis.max'=>'O campo não pode conter mais de 20 caracteres.',
            'pis.pis'=>'Este CPF é invalido.',
            
            'data_nascimento.required'=>'O campo não pode estar vazio.',
            'data_nascimento.max'=>'O campo não pode conter mais de 10 caracteres.',
            'data_nascimento.regex'=>'O campo nome social possui um formato inválido.',
            
            'pais__nascimento.required'=>'O campo não pode estar vazio.',
            'pais__nascimento.max'=>'O campo não pode conter mais de 60 caracteres.',
            'pais__nascimento.regex'=>'O campo nome social possui um formato inválido.',
            
            'pais__nacionalidade.required'=>'O campo não pode estar vazio.',
            'pais__nacionalidade.max'=>'O campo não pode conter mais de 60 caracteres.',
            'pais__nacionalidade.regex'=>'O campo nome social possui um formato inválido.',
            
            'nome__mae.required'=>'O campo não pode estar vazio.',
            'nome__mae.max'=>'O campo não pode conter mais de 60 caracteres.',
            'nome__mae.regex'=>'O campo nome social tem um formato inválido.',
            
            'telefone.required'=>'O campo não pode estar vazio.',
            'telefone.max'=>'O campo não pode conter mais de 16 caracteres.',
            'telefone.celular_com_ddd'=>'Este DDD não é valido.',
            
            'telefone.required'=>'O campo não pode estar vazio.',
            'telefone.max'=>'O campo não pode conter mais de 16 caracteres.',
            'telefone.celular_com_ddd'=>'Este DDD não é valido.',
            
            'cep.required'=>'O campo não pode estar vazio.',
            'cep.max'=>'O campo não pode conter mais de 16 caracteres.',
            'cep.regex'=>'O campo nome social possui um formato inválido.',
            
            'logradouro.required'=>'O campo não pode estar vazio.',
            'logradouro.max'=>'O campo não pode conter mais de 50 caracteres.',
            'logradouro.regex'=>'O campo nome social possui um formato inválido.',
            
            'numero.required'=>'O campo não pode estar vazio.',
            'numero.max'=>'O campo não pode conter mais de 10 caracteres.',
            'numero.regex'=>'O campo nome social possui um formato inválido.',
            
            'bairro.required'=>'O campo não pode estar vazio.',
            'bairro.max'=>'O campo não pode conter mais de 10 caracteres.',
            'bairro.regex'=>'O campo nome social possui um formato inválido.',
            
            'localidade.required'=>'O campo não pode estar vazio.',
            'localidade.max'=>'O campo não pode conter mais de 10 caracteres.',
            'localidade.regex'=>'O campo nome social possui um formato inválido.',
            
            'uf.required'=>'O campo não pode estar vazio.',
            'uf.max'=>'O campo não pode conter mais de 10 caracteres.',
            'uf.regex'=>'O campo nome social possui um formato inválido.',
            
            'data__admissao.required'=>'O campo não pode estar vazio.',
            'data__admissao.max'=>'O campo não pode conter mais de 10 caracteres.',
            'data__admissao.regex'=>'O campo nome social possui um formato inválido.',
            
            'categoria__contrato.required'=>'O campo não pode estar vazio.',
            'categoria__contrato.max'=>'O campo não pode conter mais de 255 caracteres.',
            'categoria__contrato.regex'=>'O campo nome social possui um formato inválido.',
            
            'cbo.required'=>'O campo não pode estar vazio.',
            'cbo.max'=>'O campo não pode conter mais de 225 caracteres.',
            'cbo.regex'=>'O campo nome social possui um formato inválido.',
            
            'ctps.required'=>'O campo não pode estar vazio.',
            'ctps.max'=>'O campo não pode conter mais de 20 caracteres.',
            
            'serie__ctps.required'=>'O campo não pode estar vazio.',
            'serie__ctps.max'=>'O campo não pode conter mais de 20 caracteres.',
            
            'uf__ctps.required'=>'O campo não pode estar vazio.',
            'uf__ctps.max'=>'O campo não ter mais de 255 caracteres.',
            'uf__ctps.regex'=>'O campo nome social possui um formato inválido.',
            
            'data__afastamento.max'=>'O campo não pode conter mais de 10 caracteres.',
            'banco.max'=>'O campo não pode conter mais de 100 caracteres.',
            'agencia.max'=>'O campo não pode conter mais de 4 caracteres.',
            'operacao.max'=>'O campo não pode conter mais de 3 caracteres.',
            'conta.max'=>'O campo não pode conter mais de 10 caracteres.',
            'pix.max'=>'O campo não pode conter mais de 225 caracteres.'
        ]
        );
        if ($trabalhadorscpf) {
            return redirect()->back()->withInput()->withErrors(['cpf'=>'Este CPF já está cadastrado.']);
        }elseif ($documentospis) {
            return redirect()->back()->withInput()->withErrors(['pis'=>'Este PIS já está cadastrado.']);
        }elseif ($documentosctps) {
            return redirect()->back()->withInput()->withErrors(['ctps'=>'Este CTPS já está cadastrado.']);
        }
        // if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
        //     $novafoto = $request->foto;
        //     $extension = $novafoto->getClientOriginalExtension();
        //     $name = md5($novafoto->getClientOriginalName().strtotime('now')).'.'.$extension;
        //     $novafoto->move(storage_path('app/imagem'), $name);
        // }
        // $file_path = public_path('imagem/'.$name);
        // return response()->download(public_path().'/imagem/'.$name);
        // $file = base_path().
        // "/storage/app/imagem/3dbc802c397ae2f987773df44e7cc3a6.zip";
        // return response()->download($file, "3dbc802c397ae2f987773df44e7cc3a6.zip");
     
        
        try {
        $trabalhadors = $this->trabalhador->cadastro($dados);
        if ($trabalhadors) {
            $dados['trabalhador'] = $trabalhadors['id'];
            $enderecos = $this->endereco->cadastro($dados); 
            $bancarios = $this->bancario->cadastro($dados);
            $nascimentos = $this->nascimento->cadastro($dados);
            $categorias = $this->categoria->cadastro($dados);
            $documentos = $this->documento->cadastro($dados);
            $this->valorrublica->editarMatricular($dados,$user->empresa);
            if ($enderecos &&  $bancarios && 
                $nascimentos && $categorias && $documentos) {   
                return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
            }
        }
        } catch (\Throwable $th) {
            $this->nascimento->deletar($dados['trabalhador']);
            $this->categoria->deletar($dados['trabalhador']);
            $this->documento->deletar($dados['trabalhador']);
            $this->endereco->deletarTrabalhador($dados['trabalhador']);
            $this->bancario->deletarTrabalhador($dados['trabalhador']);
            $this->trabalhador->deletar($dados['trabalhador']);
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível realizar o cadastro.']);
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
        $trabalhadors = $this->trabalhador->buscaUnidadeTrabalhador($id);
        return response()->json($trabalhadors);
    }
    public function pesquisa($id = null)
    {
        $trabalhadors = $this->trabalhador->buscaListaTrabalhador($id);
        return response()->json($trabalhadors);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $user = Auth::user();
        $search = request('search');
        $esocialtrabalhador = $this->esocial->notificacaoCadastroTrabalhador();
        $trabalhadors = $this->trabalhador->lista($search,'asc');
        $trabalhador = $this->trabalhador->buscaUnidadeTrabalhador($id);
        return view('trabalhador.edit',compact('user','trabalhador','trabalhadors','esocialtrabalhador'));
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
            'nome__completo' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'nome__social' => 'max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'cpf' => 'required|max:15|cpf|formato_cpf',
            'matricula'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'pis'=>'required|max:20|pis',
            'data_nascimento'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'pais__nascimento'=>'required|max:60|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'pais__nacionalidade'=>'required|max:60|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'nome__mae'=>'required|max:50|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'telefone'=>'required|max:16|celular_com_ddd',
            'cep'=>'required|max:16|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'logradouro'=>'required|max:50|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'numero'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'bairro'=>'required:max:40|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'localidade'=>'required|max:30|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'uf'=>'required|max:2|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'data__admissao'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'categoria__contrato'=>'required|max:255|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'cbo'=>'required|max:255|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            
            'ctps'=>'required|max:20',
            'serie__ctps'=>'required|max:20',
            'uf__ctps'=>'required|max:2|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
            'data__afastamento'=>'max:10',
            'banco'=>'max:100',
            'agencia'=>'max:4',
            'operacao'=>'max:3',
            'conta'=>'max:10',
            'pix'=>'max:255'
        ],
        [
            'nome__completo.required'=>'O campo não pode estar vazio.',
            'nome__completo.max'=>'Campo não pode conter mais de 100 caracteres.',
            'nome__completo.regex'=>'O campo nome social possui um formato inválido.',
            
            'nome__social.required'=>'O campo não pode estar vazio.',
            'nome__social.max'=>'O campo não pode conter mais de 100 caracteres.',
            'nome__social.regex'=>'O campo nome social possui um formato inválido.',
            
            'cpf.required'=>'O campo não pode estar vazio.',
            'cpf.max'=>'O campo não pode conter mais de 15 caracteres.',
            'cpf.cpf'=>'Este CPF é invalido.',
            'cpf.formato_cpf'=>'Este CPF não possui um formato valido.',
            
            'pis.required'=>'O campo não pode estar vazio.',
            'pis.max'=>'O campo não pode conter mais de 20 caracteres.',
            'pis.pis'=>'Este CPF é invalido.',
            
            'data_nascimento.required'=>'O campo não pode estar vazio.',
            'data_nascimento.max'=>'O campo não pode conter mais de 10 caracteres.',
            'data_nascimento.regex'=>'O campo nome social possui um formato inválido.',
            
            'pais__nascimento.required'=>'O campo não pode estar vazio.',
            'pais__nascimento.max'=>'O campo não pode conter mais de 60 caracteres.',
            'pais__nascimento.regex'=>'O campo nome social possui um formato inválido.',
            
            'pais__nacionalidade.required'=>'O campo não pode estar vazio.',
            'pais__nacionalidade.max'=>'O campo não pode conter mais de 60 caracteres.',
            'pais__nacionalidade.regex'=>'O campo nome social possui um formato inválido.',
            
            'nome__mae.required'=>'O campo não pode estar vazio.',
            'nome__mae.max'=>'O campo não pode conter mais de 60 caracteres.',
            'nome__mae.regex'=>'O campo nome social possui um formato inválido.',
            
            'telefone.required'=>'O campo não pode estar vazio.',
            'telefone.max'=>'O campo não pode conter mais de 16 caracteres.',
            'telefone.celular_com_ddd'=>'Este DDD não é valido.',
            
            'telefone.required'=>'O campo não pode estar vazio.',
            'telefone.max'=>'O campo não pode conter mais de 16 caracteres.',
            'telefone.celular_com_ddd'=>'Este DDD não é valido.',
            
            'cep.required'=>'O campo não pode estar vazio.',
            'cep.max'=>'O campo não pode conter mais de 16 caracteres.',
            'cep.regex'=>'O campo nome social possui um formato inválido.',
            
            'logradouro.required'=>'O campo não pode estar vazio.',
            'logradouro.max'=>'O campo não pode conter mais de 50 caracteres.',
            'logradouro.regex'=>'O campo nome social possui um formato inválido.',
            
            'numero.required'=>'O campo não pode estar vazio.',
            'numero.max'=>'O campo não pode conter mais de 10 caracteres.',
            'numero.regex'=>'O campo nome social possui um formato inválido.',
            
            'bairro.required'=>'O campo não pode estar vazio.',
            'bairro.max'=>'O campo não pode conter mais de 10 caracteres.',
            'bairro.regex'=>'O campo nome social possui um formato inválido.',
            
            'localidade.required'=>'O campo não pode estar vazio.',
            'localidade.max'=>'O campo não pode conter mais de 10 caracteres.',
            'localidade.regex'=>'O campo nome social possui um formato inválido.',
            
            'uf.required'=>'O campo não pode estar vazio.',
            'uf.max'=>'O campo não pode conter mais de 10 caracteres.',
            'uf.regex'=>'O campo nome social possui um formato inválido.',
            
            'data__admissao.required'=>'O campo não pode estar vazio.',
            'data__admissao.max'=>'O campo não pode conter mais de 10 caracteres.',
            'data__admissao.regex'=>'O campo nome social possui um formato inválido.',
            
            'categoria__contrato.required'=>'O campo não pode estar vazio.',
            'categoria__contrato.max'=>'O campo não pode conter mais de 255 caracteres.',
            'categoria__contrato.regex'=>'O campo nome social possui um formato inválido.',
            
            'cbo.required'=>'O campo não pode estar vazio.',
            'cbo.max'=>'O campo não pode conter mais de 225 caracteres.',
            'cbo.regex'=>'O campo nome social possui um formato inválido.',
            
            'ctps.required'=>'O campo não pode estar vazio.',
            'ctps.max'=>'O campo não pode conter mais de 20 caracteres.',
            
            'serie__ctps.required'=>'O campo não pode estar vazio.',
            'serie__ctps.max'=>'O campo não pode conter mais de 20 caracteres.',
            
            'uf__ctps.required'=>'O campo não pode estar vazio.',
            'uf__ctps.max'=>'O campo não pode conter mais de 255 caracteres.',
            'uf__ctps.regex'=>'O campo nome social possui um formato inválido.',
            
            'data__afastamento.max'=>'O campo não pode conter mais de 10 caracteres.',
            'banco.max'=>'O campo não pode conter mais de 100 caracteres.',
            'agencia.max'=>'O campo não pode conter mais de 4 caracteres.',
            'operacao.max'=>'O campo não pode conter mais de 3 caracteres.',
            'conta.max'=>'O campo não pode conter mais de 10 caracteres.',
            'pix.max'=>'O campo não pode conter mais de 225 caracteres.'
            
        ]
        );
       
        
            $trabalhadors = $this->trabalhador->editar($dados,$id);
            $enderecos = $this->endereco->editar($dados,$dados['endereco']); 
            $bancarios = $this->bancario->editar($dados,$dados['bancario']);
            $nascimentos = $this->nascimento->editar($dados,$id);
            $categorias = $this->categoria->editar($dados,$id);
            $documentos = $this->documento->editar($dados,$id);
            if ($trabalhadors && $enderecos &&  $bancarios && 
            $nascimentos && $categorias && $documentos) {
                return redirect()->back()->withSuccess('Atualizado com sucesso.'); 
            }
            try {
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível realizar a atualização.']);
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
        
        $trabalhador = $this->basecalculo->verificaTrabalhador($id);
        if ($trabalhador) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Este trabalhador não pode ser deletador.']);
        }
        $campoendereco = 'trabalhador';
        $campobacario = 'trabalhador';
        $user = auth()->user();
        $dados = ['matricula'=>''];
        try {
            $comissionados = $this->comissionado->deletaTrabalhador($id);
            $bolcartaopontos = $this->bolcartaoponto->deletarTrabalador($id);
            $lancamentorublicas = $this->lancamentorublica->deletarTrabalhador($id);
            $dependentes = $this->dependente->deletarTrabalhador($id); 
            $exenderecos = $this->endereco->deletarTrabalhador($id); 
    
            $bancarios = $this->bancario->first($id,$campobacario);
            
            $exbancarios = $this->bancario->deletar($bancarios->biid);
    
            $nascimentos = $this->nascimento->deletar($id);
            $categorias = $this->categoria->deletar($id);
            $documentos = $this->documento->deletar($id);
            $trabalhadors = $this->trabalhador->deletar($id);
            $valorrublica_matricular = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
            if (isset($valorrublica_matricular->vimatricular)) {
                $dados['matricula'] =  $valorrublica_matricular->vimatricular - 1;
                $this->valorrublica->editarMatricular($dados,$user->empresa);
            }
            return redirect()->back()->withSuccess('Deletado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível deletar o registro.']);
        }
    }
}
