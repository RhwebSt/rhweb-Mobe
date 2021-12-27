<?php

namespace App\Http\Controllers\Irrf;

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
            'irsano'=>'required|max:4|numeric|unique:irrves',
        ],[
            'irsano.unique'=>'Esta ano já esta cadastrado.'
        ]);
        $contador = 1;
        $novodados = [
            'ano'=>'',
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
            if ($key === 'ano') {
                $novodados['ano'] = $value;
            }
           
            if($contador == 5)
                $novodados['valor__inicial'] = $value;
            elseif ($contador == 6) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 7) {
                $novodados['indice'] = $value;
                $irrf->cadastro($novodados);
            }
            elseif($contador == 8)
            $novodados['valor__inicial'] = $value;
            elseif ($contador == 9) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 10) {
                $novodados['indice'] = $value;
                $irrf->cadastro($novodados);
            }
            elseif($contador == 11)
            $novodados['valor__inicial'] = $value;
            elseif ($contador == 12) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 13) {
                $novodados['indice'] = $value;
                $irrf->cadastro($novodados);
            }
            elseif($contador == 14)
            $novodados['valor__inicial'] = $value;
            elseif ($contador == 15) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 16) {
                $novodados['indice'] = $value;
                $irrf->cadastro($novodados);
            }
            elseif($contador == 17)
            $novodados['valor__inicial'] = $value;
            elseif ($contador == 18) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 19) {
                $novodados['indice'] = $value;
                $irrf->cadastro($novodados);
            }
            $contador++;
        }
        return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
        } catch (\Throwable $th) {
            return redirect()->route('irrf.index')->withInput()->withErrors(['false'=>'Não foi prossível cadastrar.']);
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
            'irsano'=>'required|max:4|numeric',
        ]);
        $contador = 1;
        $novodados = [
            'ano'=>'',
            'valor__inicial'=>'',
            'valor__final'=>'',
            'indice'=>'',
            'fator'=>'',
        ];
        $inss = new Irrf;
        try {
        foreach ($dados as $key => $value) {
           
            if ($key === 'ano') {
                $novodados['ano'] = $value;
            }
            if($contador == 5)
                $novodados['valor__inicial'] = $value;
            elseif ($contador == 6) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 7) {
                $novodados['indice'] = $value;
                $inss->edita($novodados,$dados['id01']);
            }
            elseif($contador == 8)
            $novodados['valor__inicial'] = $value;
            elseif ($contador == 9) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 10) {
                $novodados['indice'] = $value;
                $inss->edita($novodados,$dados['id02']);
            }
            elseif($contador == 11)
            $novodados['valor__inicial'] = $value;
            elseif ($contador == 12) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 13) {
                $novodados['indice'] = $value;
                $inss->edita($novodados,$dados['id03']);
            }
            elseif($contador == 14)
            $novodados['valor__inicial'] = $value;
            elseif ($contador == 15) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 16) {
                $novodados['indice'] = $value;
                $inss->edita($novodados,$dados['id04']);
            }
            elseif($contador == 17)
            $novodados['valor__inicial'] = $value;
            elseif ($contador == 18) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 19) {
                $novodados['indice'] = $value;
                $inss->edita($novodados,$dados['id05']);
            }
            $contador++;
        }
        return redirect()->back()->withSuccess('Atualizador com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->route('irrf.index')->withInput()->withErrors(['false'=>'Não foi porssível realizar a atualização.']);
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
