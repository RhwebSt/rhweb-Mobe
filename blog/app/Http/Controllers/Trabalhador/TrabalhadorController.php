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
use App\Lancamentotabela;
use App\Comissionado;
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
        return view('trabalhador.index',compact('user'));
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
        $request->validate([
            'nome__completo' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'nome__social' => 'max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'cpf' => 'required|max:15|cpf|formato_cpf',
            'matricula'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'pis'=>'required|max:20|pis',
            'data_nascimento'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'pais__nascimento'=>'required|max:60|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'pais__nacionalidade'=>'required|max:60|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'nome__mae'=>'required|max:50|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'telefone'=>'required|max:16|celular_com_ddd',
            'cep'=>'required|max:16|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'logradouro'=>'required|max:50|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'numero'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'bairro'=>'required:max:40|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'localidade'=>'required|max:30|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'uf'=>'required|max:2|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'data__admissao'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'categoria__contrato'=>'required|max:255|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'cbo'=>'required|max:255|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'irrf'=>'required|max:18',
            'sf'=>'required|max:18',
            'ctps'=>'required|max:20',
            'serie__ctps'=>'required|max:20',
            'uf__ctps'=>'required|max:2|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'data__afastamento'=>'max:10',
            'banco'=>'max:100',
            'agencia'=>'max:4',
            'operacao'=>'max:3',
            'conta'=>'max:10',
            'pix'=>'max:255'
        ],
        // [
        //     'nome__completo.required'=>'Campo não pode esta vazio!',
        //     'matricula.required'=>'Campo não pode esta vazio!',
        //     'matricula.max'=>'A matricula não pode ter mais de 4 caracteris!',
        //     'num__trabalhador.required'=>'Campo não pode esta vazio!',
        //     'num__trabalhador.numeric'=>'O campo naõ pode conter letras',
        //     'liboletim.required'=>'Campo não pode esta vazio!',
        //     'liboletim.numeric'=>'O campo naõ pode conter letras',
        //     'data.required'=>'O campo não pode esta vazio!'
            
        // ]
        );
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
        $documento = new Documento;
        $trabalhadors = $trabalhador->cadastro($dados);
        if ($trabalhadors) {
            $dados['trabalhador'] = $trabalhadors['id'];
            $enderecos = $endereco->cadastro($dados); 
            $bancarios = $bancario->cadastro($dados);
            $nascimentos = $nascimento->cadastro($dados);
            $categorias = $categoria->cadastro($dados);
            $documentos = $documento->cadastro($dados);
            if ($enderecos &&  $bancarios && 
                $nascimentos && $categorias && $documentos) {   
                return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
            }
        }
        try {

        } catch (\Throwable $th) {
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
            'nome__completo' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'nome__social' => 'max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'cpf' => 'required|max:15|cpf|formato_cpf',
            'matricula'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'pis'=>'required|max:20|pis',
            'data_nascimento'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'pais__nascimento'=>'required|max:60|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'pais__nacionalidade'=>'required|max:60|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'nome__mae'=>'required|max:50|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'telefone'=>'required|max:16|celular_com_ddd',
            'cep'=>'required|max:16|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'logradouro'=>'required|max:50|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'numero'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'bairro'=>'required:max:40|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'localidade'=>'required|max:30|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'uf'=>'required|max:2|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'data__admissao'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'categoria__contrato'=>'required|max:255|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'cbo'=>'required|max:255|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'irrf'=>'required|max:18',
            'sf'=>'required|max:18',
            'ctps'=>'required|max:20',
            'serie__ctps'=>'required|max:20',
            'uf__ctps'=>'required|max:2|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÏÍÔÕÛÙÜŸÑÆŒa-zàáâãçéèêëîíïôõûùüÿñæœ 0-9_\-()]*$/',
            'data__afastamento'=>'max:10',
            'banco'=>'max:100',
            'agencia'=>'max:4',
            'operacao'=>'max:3',
            'conta'=>'max:10',
            'pix'=>'max:255'
        ],
        // [
        //     'nome__completo.required'=>'Campo não pode esta vazio!',
        //     'matricula.required'=>'Campo não pode esta vazio!',
        //     'matricula.max'=>'A matricula não pode ter mais de 4 caracteris!',
        //     'num__trabalhador.required'=>'Campo não pode esta vazio!',
        //     'num__trabalhador.numeric'=>'O campo naõ pode conter letras',
        //     'liboletim.required'=>'Campo não pode esta vazio!',
        //     'liboletim.numeric'=>'O campo naõ pode conter letras',
        //     'data.required'=>'O campo não pode esta vazio!'
            
        // ]
        );
        $trabalhador = new Trabalhador;
        $endereco = new Endereco;
        $bancario = new Bancario;
        $nascimento = new Nascimento;
        $categoria = new Categoria;
        $documento = new Documento;
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
        try {

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
        $campoendereco = 'trabalhador';
        $campobacario = 'trabalhador';
      
        try {
            $comissionados = $comissionado->deletaTrabalhador($id);
            $bolcartaopontos = $bolcartaoponto->deletarTrabalador($id);
            $lancamentorublicas = $lancamentorublica->deletarTrabalhador($id);
            $dependentes = $dependente->deletar($id); 
            $enderecos = $endereco->first($id,$campoendereco); 
    
            $exenderecos = $endereco->deletar($enderecos->eiid); 
    
            $bancarios = $bancario->first($id,$campobacario);
            
            $exbancarios = $bancario->deletar($bancarios->biid);
    
            $nascimentos = $nascimento->deletar($id);
            $categorias = $categoria->deletar($id);
            $documentos = $documento->deletar($id);
            // dd($exbancarios,$exenderecos,$nascimentos,$categorias,$documentos);
            if ($exenderecos &&  $exbancarios  &&
            $nascimentos && $categorias && $documentos) {
                $trabalhadors = $trabalhador->deletar($id);
                return redirect()->back()->withSuccess('Deletado com sucesso.'); 
            }
        } catch (\Throwable $th) {
            return redirect()->route('trabalhador.index')->withInput()->withErrors(['false'=>'Não foi porssível deletar o registro.']);
        }
    }
}
