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
class TrabalhadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $valorrublica = new ValoresRublica;
        $valorrublica_matricular = $valorrublica->buscaUnidadeEmpresa($user->empresa);
        return view('trabalhador.index',compact('user','valorrublica_matricular'));
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
        // dd($dados);
        $user = auth()->user();
        $trabalhador = new Trabalhador;
        $documento = new Documento;
        $valorrublica = new ValoresRublica;
        
        $trabalhadorscpf = $trabalhador->VerificarCadastroCpf($dados);
        $documentospis = $documento->VerificarCadastroPis($dados);
        $documentosctps = $documento->VerificarCadastroCtps($dados);
        
        
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
        if ($trabalhadorscpf) {
            return redirect()->back()->withInput()->withErrors(['cpf'=>'Este CPF já esta cadastrador.']);
        }elseif ($documentospis) {
            return redirect()->back()->withInput()->withErrors(['pis'=>'Este PIS já esta cadastrador.']);
        }elseif ($documentosctps) {
            return redirect()->back()->withInput()->withErrors(['ctps'=>'Este CTPS já esta cadastrador.']);
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
        $trabalhador = new Trabalhador;
        $endereco = new Endereco;
        $bancario = new Bancario;
        $nascimento = new Nascimento;
        $categoria = new Categoria;
        
        try {
        $trabalhadors = $trabalhador->cadastro($dados);
        if ($trabalhadors) {
            $dados['trabalhador'] = $trabalhadors['id'];
            $enderecos = $endereco->cadastro($dados); 
            $bancarios = $bancario->cadastro($dados);
            $nascimentos = $nascimento->cadastro($dados);
            $categorias = $categoria->cadastro($dados);
            $documentos = $documento->cadastro($dados);
            $valorrublica->editarMatricular($dados,$user->empresa);
            if ($enderecos &&  $bancarios && 
                $nascimentos && $categorias && $documentos) {   
                return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
            }
        }
        } catch (\Throwable $th) {
            $nascimento->deletar($dados['trabalhador']);
            $categoria->deletar($dados['trabalhador']);
            $documento->deletar($dados['trabalhador']);
            $endereco->deletarTrabalhador($dados['trabalhador']);
            $bancario->deletarTrabalhador($dados['trabalhador']);
            $trabalhador->deletar($dados['trabalhador']);
            return redirect()->route('trabalhador.index')->withInput()->withErrors(['false'=>'Não foi prossível cadastrar.']);
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
        $trabalhador = new Trabalhador;
        $trabalhadors = $trabalhador->buscaUnidadeTrabalhador($id);
        return response()->json($trabalhadors);
    }
    public function pesquisa($id = null)
    {
        $trabalhador = new Trabalhador;
        $trabalhadors = $trabalhador->buscaListaTrabalhador($id);
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
        $trabalhador = new Trabalhador;
        $endereco = new Endereco;
        $bancario = new Bancario;
        $nascimento = new Nascimento;
        $categoria = new Categoria;
        $documento = new Documento;
        try {
            $trabalhadors = $trabalhador->editar($dados,$id);
            $enderecos = $endereco->editar($dados,$dados['endereco']); 
            $bancarios = $bancario->editar($dados,$dados['bancario']);
            $nascimentos = $nascimento->editar($dados,$id);
            $categorias = $categoria->editar($dados,$id);
            $documentos = $documento->editar($dados,$id);
            if ($trabalhadors && $enderecos &&  $bancarios && 
            $nascimentos && $categorias && $documentos) {
                return redirect()->back()->withSuccess('Atualizador com sucesso.'); 
            }
        } catch (\Throwable $th) {
            return redirect()->route('trabalhador.index')->withInput()->withErrors(['false'=>'Não foi porssível realizar a atualização.']);
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
        $trabalhador = new Trabalhador;
        $endereco = new Endereco;
        $bancario = new Bancario;
        $nascimento = new Nascimento;
        $categoria = new Categoria;
        $documento = new Documento;
        $dependente = new Dependente;
        $bolcartaoponto = new Bolcartaoponto;
        $lancamentorublica = new Lancamentorublica; 
        $comissionado = new Comissionado;
        $valorrublica = new ValoresRublica;
        $campoendereco = 'trabalhador';
        $campobacario = 'trabalhador';
        $user = auth()->user();
        $dados = ['matricula'=>''];
        try {
            $comissionados = $comissionado->deletaTrabalhador($id);
            $bolcartaopontos = $bolcartaoponto->deletarTrabalador($id);
            $lancamentorublicas = $lancamentorublica->deletarTrabalhador($id);
            $dependentes = $dependente->deletarTrabalhador($id); 
            $enderecos = $endereco->first($id,$campoendereco); 
    
            $exenderecos = $endereco->deletar($enderecos->eiid); 
    
            $bancarios = $bancario->first($id,$campobacario);
            
            $exbancarios = $bancario->deletar($bancarios->biid);
    
            $nascimentos = $nascimento->deletar($id);
            $categorias = $categoria->deletar($id);
            $documentos = $documento->deletar($id);
            $trabalhadors = $trabalhador->deletar($id);
            $valorrublica_matricular = $valorrublica->buscaUnidadeEmpresa($user->empresa);
            if (isset($valorrublica_matricular->vimatricular)) {
                $dados['matricula'] =  $valorrublica_matricular->vimatricular - 1;
                $valorrublica->editarMatricular($dados,$user->empresa);
            }
            return redirect()->back()->withSuccess('Deletado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->route('trabalhador.index')->withInput()->withErrors(['false'=>'Não foi porssível deletar o registro.']);
        }
    }
}
