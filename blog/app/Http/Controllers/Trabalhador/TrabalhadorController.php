<?php

namespace App\Http\Controllers\Trabalhador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Validacao;
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
use App\Empresa;
use App\Arquivo;
class TrabalhadorController extends Controller
{
    private $trabalhador,$endereco,$bancario,$nascimento,$categoria,$valorrublica,
    $documento,$dependente,$bolcartaoponto,$lancamentorublica,$comissionado,$basecalculo,
    $esocial,$empresa,$arquivo;
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
        $this->empresa = new Empresa;
        $this->arquivo = new Arquivo;
    }
    public function index()
    {
        $user = auth()->user();
        $search = request('search');
        $condicao = request('codicao');
        // $trabalhadors = $this->trabalhador->lista($search,'desc');
        $trabalhadors = $this->trabalhador->where(function($query) use ($search,$user){
                if ($search) {
                    $query->where([
                        ['tsnome','like','%'.$search.'%'],
                        ['empresa_id', $user->empresa_id]
                    ])
                    ->orWhere([
                        ['tscpf','like','%'.$search.'%'],
                        ['empresa_id', $user->empresa_id],
                    ])
                    ->orWhere([
                        ['tsmatricula','like','%'.$search.'%'],
                        ['empresa_id', $user->empresa_id],
                    ]);
                }else{
                    $query->where('empresa_id', $user->empresa_id);
                }
        }) 
        ->orderBy('tsnome', 'asc')
        ->paginate(20);
        $esocialtrabalhador = $this->esocial->notificacaoCadastroTrabalhador();
        if ($condicao) {
            $trabalhador = $this->trabalhador->where('id',$condicao)
            ->with(['documento','endereco','categoria','nascimento','bancario'])->first();
            return view('trabalhador.edit',compact('user','trabalhador','trabalhadors','esocialtrabalhador'));
        }else{
            $valorrublica_matricular = $this->empresa->where('id',$user->empresa_id)->with('valoresrublica')->first();
            
            return view('trabalhador.index',compact('user','valorrublica_matricular','trabalhadors','esocialtrabalhador'));
        }
    }

    public function ordem($ordem,$id = null,$search = null)
    {
        $user = Auth::user();
        // $trabalhadors = $this->trabalhador->lista($search,$ordem);
        $trabalhadors = $this->trabalhador->where(function($query) use ($search,$user){
            if ($search) {
                $query->where([
                    ['tsnome','like','%'.$search.'%'],
                    ['empresa_id', $user->empresa_id]
                ])
                ->orWhere([
                    ['tscpf','like','%'.$search.'%'],
                    ['empresa_id', $user->empresa_id],
                ])
                ->orWhere([
                    ['tsmatricula','like','%'.$search.'%'],
                    ['empresa_id', $user->empresa_id],
                ]);
            }else{
                $query->where('empresa_id', $user->empresa_id);
            }
    }) 
    ->orderBy('tsnome', $ordem) 
    ->paginate(20);
        $esocialtrabalhador = $this->esocial->notificacaoCadastroTrabalhador();
        if ($id) {
            $trabalhador = $this->trabalhador->buscaUnidadeTrabalhador($id);
            return view('trabalhador.edit',compact('user','trabalhador','trabalhadors','esocialtrabalhador'));
        }else{
            $valorrublica_matricular = $this->empresa->where('id',$user->empresa_id)->with('valoresrublica')->first();
            // $valorrublica_matricular = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
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
        $user = auth()->user();
        $search = request('search');
        $condicao = request('codicao');
        // $trabalhadors = $this->trabalhador->lista($search,'desc');
        $trabalhadors = $this->trabalhador->where(function($query) use ($search,$user){
                if ($search) {
                    $query->where([
                        ['tsnome','like','%'.$search.'%'],
                        ['empresa_id', $user->empresa_id]
                    ])
                    ->orWhere([
                        ['tscpf','like','%'.$search.'%'],
                        ['empresa_id', $user->empresa_id],
                    ])
                    ->orWhere([
                        ['tsmatricula','like','%'.$search.'%'],
                        ['empresa_id', $user->empresa_id],
                    ]);
                }else{
                    $query->where('empresa_id', $user->empresa_id);
                }
        }) 
        ->orderBy('tsnome', 'asc')
        ->paginate(20);
        $esocialtrabalhador = $this->esocial->notificacaoCadastroTrabalhador();
        if ($condicao) {
            $trabalhador = $this->trabalhador->where('id',$condicao)
            ->with(['documento','endereco','categoria','nascimento','bancario'])->first();
            return view('trabalhador.edit',compact('user','trabalhador','trabalhadors','esocialtrabalhador'));
        }else{
            $valorrublica_matricular = $this->empresa->where('id',$user->empresa_id)->with('valoresrublica')->first();
            return view('trabalhador.index',compact('user','valorrublica_matricular','trabalhadors','esocialtrabalhador'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */ 
    public function store(Validacao $request)
    {
        $dados = $request->all();
        $user = auth()->user();
       
        $documentos = $this->trabalhador->where([
            ['tscpf', $dados['cpf']],
            ['empresa_id',$user->empresa_id]
        ])
        ->with('documento.trabalhador')->first();
        if (isset($documentos->tscpf)) {
            return redirect()->back()->withInput()->withErrors(['cpf'=>'Este CPF já está cadastrado.']);
        }elseif (isset($documentos->documento[0]->dspis)) {
            return redirect()->back()->withInput()->withErrors(['pis'=>'Este PIS já está cadastrado.']);
        }elseif (isset($documentos->documento[0]->dsctps)) {
            return redirect()->back()->withInput()->withErrors(['ctps'=>'Este CTPS já está cadastrado.']);
        }
        if ($dados['banco']) {
            $request->validate(['banco'=>'regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9-.]*$/']);
        }
        if($dados['pix']){
            $request->validate(['pix'=>'regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9]*$/']);
        }
        if ($dados['nome__social']) {
            $request->validate(['nome__social'=>'regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ ]*$/']);
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
            $dados['trabalhador'] = $trabalhadors['id'];
            $enderecos = $this->endereco->cadastro($dados); 
            $bancarios = $this->bancario->cadastro($dados);
            $nascimentos = $this->nascimento->cadastro($dados);
            $categorias = $this->categoria->cadastro($dados);
            $documentos = $this->documento->cadastro($dados);
            $this->arquivo->cadastrorg($dados);

            // $this->valorrublica->editarMatricular($dados,$user->empresa_id); 
            $this->valorrublica->where('empresa_id', $user->empresa_id)
            ->chunkById(100, function ($valorrublica) use ($user) {
                foreach ($valorrublica as $valorrublicas) {
                    if ($valorrublicas->vimatricular >= 0) {
                        $numero = $valorrublicas->vimatricular += 1;
                        $this->valorrublica->where('empresa_id', $user->empresa_id)
                        ->update(['vimatricular'=>$numero]);
                    }
                }
            });
            return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
        } catch (\Throwable $th) {
            // $this->nascimento->deletar($dados['trabalhador']);
            // $this->categoria->deletar($dados['trabalhador']);
            // $this->documento->deletar($dados['trabalhador']);
            // $this->endereco->deletarTrabalhador($dados['trabalhador']);
            // $this->bancario->deletarTrabalhador($dados['trabalhador']);
            $this->valorrublica->where('id', $user->empresa_id)
            ->chunkById(100, function ($valorrublica) use ($user) {
                foreach ($valorrublica as $valorrublicas) {
                    if ($valorrublicas->vimatricular > 0) {
                        $numero = $valorrublicas->vimatricular -= 1;
                        $this->valorrublica->where('empresa_id', $user->empresa_id)
                        ->update(['vimatricular'=>$numero]);
                    }
                }
            });
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
        $trabalhador = $this->trabalhador->where('id',$id)
        ->with(['documento','endereco','categoria','nascimento','bancario','arquivo'])->first();
       
        $trabalhadors = $this->trabalhador->where(function($query) use ($search,$user){
            if ($search) {
                $query->where([
                    ['tsnome','like','%'.$search.'%'],
                    ['empresa_id', $user->empresa_id]
                ])
                ->orWhere([
                    ['tscpf','like','%'.$search.'%'],
                    ['empresa_id', $user->empresa_id],
                ])
                ->orWhere([
                    ['tsmatricula','like','%'.$search.'%'],
                    ['empresa_id', $user->empresa_id],
                ]);
            }else{
                $query->where('empresa_id', $user->empresa_id);
            }
        }) 
        ->orderBy('tsnome', 'asc')
        ->paginate(20);
        $esocialtrabalhador = $this->esocial->notificacaoCadastroTrabalhador();
        // $trabalhadors = $this->trabalhador->lista($search,'asc');
        // $trabalhador = $this->trabalhador->buscaUnidadeTrabalhador($id);

        return view('trabalhador.edit',compact('user','trabalhador','trabalhadors','esocialtrabalhador'));
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
        dd($dados);
        if ($dados['banco']) {
            $request->validate(['banco'=>'regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9-.]*$/']);
        }
        if($dados['pix']){
            $request->validate(['pix'=>'regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ 0-9]*$/']);
        }
        if ($dados['nome__social']) {
            $request->validate(['nome__social'=>'regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõóûùúüÿñæœ ]*$/']);
        }
        try {
            $trabalhadors = $this->trabalhador->editar($dados,$id);
            $enderecos = $this->endereco->editar($dados,$dados['endereco']); 
            $bancarios = $this->bancario->editar($dados,$dados['bancario']);
            $nascimentos = $this->nascimento->editar($dados,$id);
            $categorias = $this->categoria->editar($dados,$id);
            $documentos = $this->documento->editar($dados,$id);
            $this->arquivo->editarg($dados,$id);
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
        $user = auth()->user();
        $trabalhador = $this->basecalculo->where('trabalhador_id',$id)->count();
        // $trabalhador = $this->basecalculo->verificaTrabalhador($id);
        if ($trabalhador) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Este trabalhador não pode ser deletado.']);
        }
        $this->valorrublica->where('empresa_id', $user->empresa_id)
            ->chunkById(100, function ($valorrublica) use ($user) {
                foreach ($valorrublica as $valorrublicas) {
                    if ($valorrublicas->vimatricular > 0) {
                        $numero = $valorrublicas->vimatricular -= 1;
                        $this->valorrublica->where('empresa_id', $user->empresa_id)
                        ->update(['vimatricular'=>$numero]);
                    }
                }
            });
        $this->trabalhador->deletar($id);
        // $campoendereco = 'trabalhador';
        // $campobacario = 'trabalhador';
        // $user = auth()->user();
        // $dados = ['matricula'=>''];
        
            // $comissionados = $this->comissionado->deletaTrabalhador($id);
            // $bolcartaopontos = $this->bolcartaoponto->deletarTrabalador($id);
            // $lancamentorublicas = $this->lancamentorublica->deletarTrabalhador($id);
            // $dependentes = $this->dependente->deletarTrabalhador($id); 
            // $exenderecos = $this->endereco->deletarTrabalhador($id); 
    
            // $bancarios = $this->bancario->first($id,$campobacario);
            
            // $exbancarios = $this->bancario->deletar($bancarios->biid);
    
            // $nascimentos = $this->nascimento->deletar($id);
            // $categorias = $this->categoria->deletar($id);
            // $documentos = $this->documento->deletar($id);
            // $trabalhadors = $this->trabalhador->deletar($id);
            // $valorrublica_matricular = $this->valorrublica->buscaUnidadeEmpresa($user->empresa);
            // if (isset($valorrublica_matricular->vimatricular)) {
            //     $dados['matricula'] =  $valorrublica_matricular->vimatricular - 1;
            //     $this->valorrublica->editarMatricular($dados,$user->empresa);
            // }
            return redirect()->back()->withSuccess('Deletado com sucesso.');
            try {
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível deletar o registro.']);
        }
    }
}
