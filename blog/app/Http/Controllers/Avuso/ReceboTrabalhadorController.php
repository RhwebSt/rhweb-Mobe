<?php

namespace App\Http\Controllers\Avuso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Avuso;
use App\Http\Requests\Avuso\Recibo\Validacao;
use App\AvusoDescricao;
class ReceboTrabalhadorController extends Controller
{
    private $avuso,$descricao;
    public function __construct()
    {
        $this->avuso = new Avuso;
        $this->descricao = new AvusoDescricao; 
    }
    public function relatorio(Validacao $request)
    {
        $dados = $request->all();
        $cpf = explode('  ',$dados['search']);
        try {
        $avuso = $this->avuso->where([
            ['ascpf',$cpf[0]],
            ['asinicial','>=',$dados['ano_inicial1']],
            ['asfinal','<=',$dados['ano_final1']]
        ])->with(['empresa:id,esnome,escnpj,estelefone,esfoto','empresa.endereco','avusodescricao'])->get();
        
        // dd($avuso);
        // $request->validate([
        //     'trabalhador01' => 'required|max:100|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôõûùúüÿñæœ 0-9_\-().]*$/',
        //     'ano_inicial1'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
        //     'ano_final1'=>'required|max:10|regex:/^[A-ZÀÁÂÃÇÉÈÊËÎÍÏÔÓÕÛÙÚÜŸÑÆŒa-zàáâãçéèêëîíïôóõûùúüÿñæœ 0-9_\-().]*$/',
        // ],[
        //     'trabalhador01.required'=>'Campo não pode esta vazio.',
        //     'trabalhador01.max'=>'Campo não ter mais de 100 caracteres.',
        //     'trabalhador01.regex'=>'O campo nome social tem um formato inválido.',

        //     'ano_inicial1.required'=>'Campo não pode esta vazio.',
        //     'ano_inicial1.max'=>'Campo não ter mais de 10 caracteres.',
        //     'ano_inicial1.regex'=>'O campo nome social tem um formato inválido.',

        //     'ano_final1.required'=>'Campo não pode esta vazio.',
        //     'ano_final1.max'=>'Campo não ter mais de 10 caracteres.',
        //     'ano_final1.regex'=>'O campo nome social tem um formato inválido.',
        // ]);
        
            // $avusos = $this->avuso->buscaTrabalhador($dados['trabalhador01'],$dados['ano_inicial1'],$dados['ano_final1']);
            // $listaavuso = $this->avuso->buscaTrabalhadorRecibo($dados['trabalhador01'],$dados['ano_inicial1'],$dados['ano_final1']);
            // if (!$avusos && count($listaavuso) < 1) {
            //     return redirect()->back()->withInput()->withErrors(['false'=>'Não à registro cadastrado.']);
            // }
            $pdf = PDF::loadView('rolReciboAvulso',compact('avuso','dados'));
            return $pdf->setPaper('a4','potrait')->stream('Recibo Avulso.pdf');
            
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível gera o relatório.']);
        }
        
    }
}
