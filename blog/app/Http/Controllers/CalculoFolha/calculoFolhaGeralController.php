<?php
namespace App\Http\Controllers\CalculoFolha;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lancamentotabela;
use App\Bolcartaoponto;
use App\Tomador;
use App\Trabalhador;
class calculoFolhaGeralController extends Controller
{
    private $lancamentotabela,$tomador,$trabalhador,$bolcartaoponto;
    public function __construct()
    {
        $this->lancamentotabela = new Lancamentotabela;
        $this->tomador = new Tomador;
        $this->trabalhador = new Trabalhador;
        $this->bolcartaoponto = new Bolcartaoponto;
    }
    public function calculoFolhaGeral($datainicio,$datafinal,$competencia)
    {
        $user = auth()->user();
       
        $tomador = $this->tomador->where('empresa_id',$user->empresa_id)
        ->with('tabelapreco')->get();
        $trabalhador = $this->trabalhador->where('empresa_id',$user->empresa_id)->get();
        foreach ($trabalhador as $key => $trabalhadores) {
            $salario = 0;
            $boletim = [
                'horanormal'=>[
                    'id'=>[],
                    'dia' => '',
                    'valor' =>0,
                    'quantidade' => 0,
                    'descricao' => ''
                ]
            ];
           
            $bolcartaoponto = $this->bolcartaoponto->where('trabalhador_id',$trabalhadores->id)
            ->whereBetween('created_at',[$datainicio,$datafinal])
            ->with('lancamentotabela.tomador.tabelapreco')->get();
            foreach ($bolcartaoponto as $key => $bolcartaopontos) {
            
                foreach ($bolcartaopontos->lancamentotabela->tomador->tabelapreco as $key => $tabelapreco) {
                   
                    if ($tabelapreco->tsdescricao == 'hora normal') {
                        $salario += self::calculardia($bolcartaopontos->horas_normais,$tabelapreco->tsvalor);
                        // $boletim['horanormal']['valor'] +=  self::calculardia($bolcartaopontos->horas_normais,$tabelapreco->tsvalor);
                        // $boletim['horanormal']['quantidade'] += self::calcularhoras($bolcartaopontos->horas_normais);
                        // $boletim['horanormal']['dia'] = date('d',strtotime($bolcartaopontos->created_at));
                        // $boletim['horanormal']['descricao'] = $tabelapreco->tsdescricao;
                    }else if ($tabelapreco->tsdescricao == 'hora extra 50%') {
                        $salario += self::calculardia($bolcartaopontos->bshoraex,$tabelapreco->tsvalor);
                    }else if ($tabelapreco->tsdescricao == 'hora extra 100%') {
                        $salario += self::calculardia($bolcartaopontos->bshoraexcem,$tabelapreco->tsvalor);
                    }elseif ($tabelapreco->tsdescricao == 'adicional noturno') {
                        $salario += self::calculardia($bolcartaopontos->bsadinortuno,$tabelapreco->tsvalor);
                    }
                }
               
            }
         
            echo($salario);
        }
       
        
       
        
        // foreach ($tomador as $key => $tomador) {
        //     $boletim = [
        //         'horanormal'=>[
        //             'id'=>[],
        //             'dia' => [],
        //             'valor' => [],
        //             'quantidade' => [],
        //             'descricao' => []
        //         ]
        //     ];
            
        //     $lancamentotabela = $this->lancamentotabela
        //     ->with(['lacamentorublica','bolcartaoponto'])
        //     ->whereBetween('lsdata',[$datainicio,$datafinal])
        //     ->where('tomador_id',$tomador->id)
        //     ->get();
        //     foreach ($tomador->tabelapreco as $key => $tabelapreco) {
        //         foreach ($lancamentotabela as $key => $lancamentotabelas) {
        //             if ($lancamentotabelas->bolcartaoponto->count()) {
        //                 foreach ($lancamentotabelas->bolcartaoponto as $key => $bolcartaoponto) {
        //                     dd($bolcartaoponto->bshoraex);
        //                     if (!in_array($bolcartaoponto->trabalhador_id, $boletim['horanormal']['id']) && $tabelapreco->tsdescricao == 'hora normal' && $bolcartaoponto->horas_normais) {
        //                         array_push($boletim['horanormal']['id'],$bolcartaoponto->trabalhador_id);
        //                         array_push($boletim['horanormal']['descricao'],$tabelapreco->tsdescricao);
        //                         array_push($boletim['horanormal']['dia'], date('d',strtotime($bolcartaoponto->created_at)));
        //                     }
        //                 }
                        
        //             }
                    
        //         }
        //         dd($boletim);
        //     }
           
            
        // }
       
        // $lancamentotabela = $this->lancamentotabela
        // // ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador_id')
        // ->whereBetween('lsdata',[$datainicio,$datafinal])
        // ->where('empresa_id',$user->empresa_id)
        // ->with(['lacamentorublica','bolcartaoponto'])
        // ->get();
        // dd($lancamentotabela);
    }
    public function calculardia($horas,$valores)
    {
        list($horas,$minitos) = explode(':',$horas);
        $horasex = $horas * 3600 + $minitos * 60;
        $horasex = $horasex/60;
        if ($valores != null) {
            $horasex = $valores * ($horasex/60);
        }else{
            $horasex = ($horasex/60);
        }
        return $horasex;
    }
    public function calcularhoras($horas)
    {
        if(strpos($horas,':')){
            list($horas,$minitos) = explode(':',$horas);
            $horasex = $horas * 3600 + $minitos * 60;
            $horasex = $horasex/60;
            $horasex = ($horasex/60);
        }else{
            $horasex = $horas;
        }
        return $horasex; 
    }
    public function calculoPocentagem($valor,$porcentagem)
    {
        $resultado = $valor * ($porcentagem / 100);
        return $resultado;
    }
}
?>