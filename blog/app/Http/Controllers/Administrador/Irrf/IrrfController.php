<?php

namespace App\Http\Controllers\Administrador\Irrf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Irrf;
class IrrfController extends Controller
{
    private $irrf;
    public function __construct()
    {
        $this->irrf = new Irrf;
    }
    public function index()
    {
        $irrf = $this->irrf->buscaListaIrrf(null);
        return view('administrador.irrf.index',compact('irrf'));
    }

    public function ordem($ano = null)
    {
        $irrf = $this->irrf->buscaListaIrrf($ano);
        return view('administrador.irrf.index',compact('irrf'));
       
    }
    public function create()
    {
        return view('administrador.irrf.criar');
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
            'irsano'=>'required|max:4|unique:irrves',
        ],[
            'irsano.unique'=>'Este ano já está cadastrado.'
        ]);
        $contador = 1;
        $novodados = [
            'ano'=>'',
            'ded__dependente'=>'',
            'valor__inicial'=>'',
            'valor__final'=>'',
            'indice'=>'',
            'user'=>''
        ];
        $irrf = new Irrf;
        try {
        foreach ($dados as $key => $value) {
            if ($key === 'user') {
                $novodados['user'] = $value;
            }
            if ($key === 'irsano') {
                $novodados['ano'] = $value;
            }
            if ($key === 'ded__dependente') {
                $novodados['ded__dependente'] = $value;
            }
           
            if ($contador == 6) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 7) {
                $novodados['indice'] = $value;
            }elseif ($contador == 8) {
                $novodados['fator'] = $value;
                $irrf->cadastro($novodados);
            }
            elseif ($contador == 9) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 10) {
                $novodados['indice'] = $value;
            }elseif ($contador == 11) {
                $novodados['fator'] = $value;
                $irrf->cadastro($novodados);
            }
            elseif ($contador == 12) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 13) {
                $novodados['indice'] = $value;
            }elseif ($contador == 14) {
                $novodados['fator'] = $value;
                $irrf->cadastro($novodados);
            }
            elseif ($contador == 15) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 16) {
                $novodados['indice'] = $value;
            }elseif ($contador == 17) {
                $novodados['fator'] = $value;
                $irrf->cadastro($novodados);
               
            }
            elseif ($contador == 18) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 19) {
                $novodados['indice'] = $value;
            }elseif ($contador == 20) {
                $novodados['fator'] = $value;
                $irrf->cadastro($novodados);
               
            }
            $contador++;
        }
        return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
        
        } catch (\Throwable $th) {
            return redirect()->route('irrf.index')->withInput()->withErrors(['false'=>'Não foi possível cadastrar.']);
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
        $inss = new Irrf;
        $in = $inss->buscaListaIrrf($id);
        return response()->json($in);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $irrf = $this->irrf->buscaUnidadeIrrf($id);
        return view('administrador.irrf.editar',compact('irrf','id'));
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
        // dd($dados);
        // $request->validate([
        //     'irsano'=>'required|max:4',
        // ]);
        $contador = 0;
        $novodados = [
            'ano'=>'',
            'ded__dependente'=>'',
            'valor__inicial'=>'',
            'valor__final'=>'',
            'indice'=>'',
            'fator'=>'',
        ];
        $irrf = new Irrf;
        
        foreach ($dados as $key => $value) {
           
            if ($key === 'irsano') {
                $novodados['ano'] = $value;
            }
            if ($key === 'ded__dependente') {
                $novodados['ded__dependente'] = $value;
            }
            if ($contador == 4) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 5) {
                $novodados['indice'] = $value;
            }elseif ($contador == 6) {
                $novodados['fator'] = $value;
                $irrf->edita($novodados,$dados['id01']);
            }
            elseif ($contador == 7) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 8) {
                $novodados['indice'] = $value;
            }elseif ($contador == 9) {
                $novodados['fator'] = $value;
                $irrf->edita($novodados,$dados['id02']);
            }
            elseif ($contador == 10) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 11) {
                $novodados['indice'] = $value;
            }elseif ($contador == 12) {
                $novodados['fator'] = $value;
                $irrf->edita($novodados,$dados['id03']);
            }
            elseif ($contador == 13) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 14) {
                $novodados['indice'] = $value;
            }elseif ($contador == 15) {
                $novodados['fator'] = $value;
                $irrf->edita($novodados,$dados['id04']);
               
            }
            // elseif ($contador == 16) {
            //     $novodados['valor__final'] = $value;
            // }elseif ($contador == 17) {
            //     $novodados['indice'] = $value;
            // }elseif ($contador == 18) {
            //     $novodados['fator'] = $value;
            //     $irrf->edita($novodados,$dados['id05']);
               
            // }
            $contador++;
        }
        try {
        return redirect()->back()->withSuccess('Atualizado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->route('irrf.index')->withInput()->withErrors(['false'=>'Não foi possível atualizar.']);
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
