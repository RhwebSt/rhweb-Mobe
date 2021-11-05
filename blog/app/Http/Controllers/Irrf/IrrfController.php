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
        // dd($dados);
        $contador = 1;
        $novodados = [
            'ano'=>'',
            'valor__inicial'=>'',
            'valor__final'=>'',
            'indice'=>'',
            'user'=>''
        ];
        $irrf = new Irrf;
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
        $condicao = 'cadastratrue';
        return redirect()->route('irrf.index')->withInput()->withErrors([$condicao]);
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
        $in = $inss->getlist($id);
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
        $contador = 1;
        $novodados = [
            'ano'=>'',
            'valor__inicial'=>'',
            'valor__final'=>'',
            'indice'=>'',
            'fator'=>'',
        ];
        $inss = new Inss;
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
            }elseif ($contador == 8) {
                $novodados['fator'] = $value;
                $inss->edita($novodados,$dados['id01']);
            }
            elseif($contador == 9)
            $novodados['valor__inicial'] = $value;
            elseif ($contador == 10) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 11) {
                $novodados['indice'] = $value;
            }elseif ($contador == 12) {
                $novodados['fator'] = $value;
                $inss->edita($novodados,$dados['id02']);
            }
            elseif($contador == 13)
            $novodados['valor__inicial'] = $value;
            elseif ($contador == 14) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 15) {
                $novodados['indice'] = $value;
            }elseif ($contador == 16) {
                $novodados['fator'] = $value;
                $inss->edita($novodados,$dados['id03']);
            }
            elseif($contador == 17)
            $novodados['valor__inicial'] = $value;
            elseif ($contador == 18) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 19) {
                $novodados['indice'] = $value;
            }elseif ($contador == 20) {
                $novodados['fator'] = $value;
                $inss->edita($novodados,$dados['id04']);
               
            }
            elseif($contador == 21)
            $novodados['valor__inicial'] = $value;
            elseif ($contador == 22) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 23) {
                $novodados['indice'] = $value;
            }elseif ($contador == 24) {
                $novodados['fator'] = $value;
                $inss->edita($novodados,$dados['id05']);
               
            }
            $contador++;
            
        }
        $condicao = 'edittrue';
        
        return redirect()->route('inss.index')->withInput()->withErrors([$condicao]);
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
