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
class TrabalhadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trabalhador = new Trabalhador;
        $trabalhadors = $trabalhador->lista();
        $user = Auth::user();
        return view('trabalhador.index',compact('trabalhadors','user'));
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
                    $condicao = 'cadastratrue';
                }else{
                    $condicao = 'cadastrafalse';
                }
                return redirect()->route('trabalhador.index')->withInput()->withErrors([$condicao]);  
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
        $trabalhadors = $trabalhador->first($id);
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
        $trabalhador = new Trabalhador;
        $trabalhadors = $trabalhador->first($id);
        dd($trabalhadors);
        // return redirect()->route('trabalhador.edit');
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
        // dd($trabalhadors, $enderecos,  $bancarios , 
        // $nascimentos ,$categorias, $documentos);
        if ($trabalhadors && $enderecos &&  $bancarios && 
        $nascimentos && $categorias && $documentos) {
            $condicao = 'edittrue';
        }else{
            $condicao = 'editfalse';
        }
            return redirect()->route('trabalhador.index')->withInput()->withErrors([$condicao]); 
        
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
        $campoendereco = 'trabalhador';
        $campobacario = 'trabalhador';
        $dependentes = $dependente->deletar($id); 
        $enderecos = $endereco->first($id,$campoendereco); 
        // dd($enderecos);
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
            $condicao = 'deletatrue';
        }else{
            $condicao = 'deletafalse';
        }
            return redirect()->route('trabalhador.index')->withInput()->withErrors([$condicao]); 
        
    }
}
