<?php

namespace App\Http\Controllers\Administrador\Irrf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Irrf;
class IrrfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('irrf.index',compact('user'));
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
        //
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
            'irsano'=>'required|max:4',
        ]);
        $contador = 1;
        $novodados = [
            'ano'=>'',
            'ded__dependente'=>'',
            'valor__inicial'=>'',
            'valor__final'=>'',
            'indice'=>'',
            'fator'=>'',
        ];
        $irrf = new Irrf;
        try {
        foreach ($dados as $key => $value) {
           
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
                $irrf->edita($novodados,$dados['id01']);
            }
            elseif ($contador == 9) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 10) {
                $novodados['indice'] = $value;
            }elseif ($contador == 11) {
                $novodados['fator'] = $value;
                $irrf->edita($novodados,$dados['id02']);
            }
            elseif ($contador == 12) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 13) {
                $novodados['indice'] = $value;
            }elseif ($contador == 14) {
                $novodados['fator'] = $value;
                $irrf->edita($novodados,$dados['id03']);
            }
            elseif ($contador == 15) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 16) {
                $novodados['indice'] = $value;
            }elseif ($contador == 17) {
                $novodados['fator'] = $value;
                $irrf->edita($novodados,$dados['id04']);
               
            }
            elseif ($contador == 18) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 19) {
                $novodados['indice'] = $value;
            }elseif ($contador == 20) {
                $novodados['fator'] = $value;
                $irrf->edita($novodados,$dados['id05']);
               
            }
            $contador++;
        }
        return redirect()->back()->withSuccess('Atualizado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->route('irrf.index')->withInput()->withErrors(['false'=>'Não foi possível realizar a atualização.']);
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
