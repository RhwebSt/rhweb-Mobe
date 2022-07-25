<?php

namespace App\Http\Controllers\Certificado;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Certificado;
use Carbon\Carbon;
class CertificadoController extends Controller
{
    private $certificado,$today;
    public function __construct()
    {
        $this->certificado = new Certificado;
        $this->today = Carbon::today();
    }
    public function index()
    {
        $user = auth()->user();
        $certificado = $this->certificado
        ->where('empresa_id',$user->empresa_id)
        ->first();
        if ($certificado) {
            if (strtotime($certificado->dtvencimento) > strtotime($this->today) ) {
                return response()->json(true);
            }else{
                return response()->json(false);
            }
        }else{
            return response()->json(true);
        }
    }

    
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
        $user = auth()->user();
        $dados = $request->all();
        $dados['empresa'] = $user->empresa_id;
        $this->certificado->cadastro($dados);
        return response()->json([
            'message'=>'Cadastro realizado com sucesso.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $certificado = $this->certificado
        ->where('empresa_id',$id)
        ->first();
        if ($certificado) {
            $data = strtotime($certificado->dtvencimento) - strtotime($this->today);
            $dias = floor($data / (60 * 60 * 24));
            if ($dias <= 5) {
                return response()->json([
                    'status'=>false,
                    'mensagem'=>'Seu certificado digital expira em '.$dias.' dias'
                ]);
            }else{
                return response()->json([
                    'status'=>true,
                    'mensagem'=>'Seu certificado digital expira em '. date('d/m/Y',strtotime($certificado->dtvencimento))
                ]);
            }
        }else{
            return response()->json([
                'status'=>false,
                'mensagem'=>'Não a certificado cadastrado'
            ]);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->certificado->deletar($id);
        return response()->json('Deletado com sucesso.'); 
    }
}
