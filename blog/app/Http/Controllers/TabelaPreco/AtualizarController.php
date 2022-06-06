<?php

namespace App\Http\Controllers\TabelaPreco;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tomador;
use App\TabelaPreco;
use Carbon\Carbon;
class AtualizarController extends Controller
{
    private $tomador,$tabelapreco;
    public function __construct()
    {
        $this->tomador = new Tomador;
        $this->tabelapreco = new TabelaPreco;
        $today = Carbon::today();
        $this->dt = Carbon::create($today);
    }
    public function index(Request $request)
    {
        $dados = $request->all();
        switch ($dados['condicao']) {
            case 'option1':
                try {
                    $this->tomador->where('empresa_id', $dados['empresa'])
                    ->chunkById(100, function ($tomadores) {
                        foreach ($tomadores as $tomador) {
                            $this->tabelapreco
                            ->where('tomador_id', $tomador->id)
                            ->chunkById(100, function ($tabelaprecos) {
                                foreach ($tabelaprecos as $key => $tabelapreco) {
                                    $this->tabelapreco->create([
                                        'tsano'=>$this->dt->year + 1,
                                        'tsrubrica'=>$tabelapreco->tsrubrica,
                                        'tsdescricao'=>$tabelapreco->tsdescricao,
                                        'tsstatus'=>$tabelapreco->tsstatus,
                                        'tsvalor'=>$tabelapreco->tsvalor,
                                        'tstomvalor'=>$tabelapreco->tstomvalor,
                                        'empresa_id'=>$tabelapreco->empresa_id,
                                        'tomador_id'=>$tabelapreco->tomador_id
                                    ]);
                                }
                            });
                        }
                    });
                    return response()->json(['result' => true], 200);
                } catch (\Throwable $th) {
                    $this->tomador->where('empresa_id', $dados['empresa'])
                    ->chunkById(100, function ($tomadores) {
                        foreach ($tomadores as $tomador) {
                            $this->tabelapreco
                            ->where([
                                ['tomador_id', $tomador->id],
                                ['tsano',$this->dt->year + 1]
                            ])->delete();
                            
                        }
                    });
                    return response()->json(['result' => true], 500);
                }
               
                break;
            
            default:
            try {
                $this->tomador->where('empresa_id', $dados['empresa'])
                ->chunkById(100, function ($tomadores) {
                    foreach ($tomadores as $tomador) {
                        $this->tabelapreco
                        ->where('tomador_id', $tomador->id)
                        ->chunkById(100, function ($tabelaprecos) {
                            foreach ($tabelaprecos as $key => $tabelapreco) {
                                $this->tabelapreco->create([
                                    'tsano'=>$this->dt->year + 1,
                                    'tsrubrica'=>$tabelapreco->tsrubrica,
                                    'tsdescricao'=>$tabelapreco->tsdescricao,
                                    'tsstatus'=>$tabelapreco->tsstatus,
                                    'tsvalor'=>0.00,
                                    'tstomvalor'=>0.00,
                                    'empresa_id'=>$tabelapreco->empresa_id,
                                    'tomador_id'=>$tabelapreco->tomador_id
                                ]);
                            }
                        });
                    }
                });
                return response()->json(['result' => true], 200);
            } catch (\Throwable $th) {
                $this->tomador->where('empresa_id', $dados['empresa'])
                ->chunkById(100, function ($tomadores) {
                    foreach ($tomadores as $tomador) {
                        $this->tabelapreco
                        ->where([
                            ['tomador_id', $tomador->id],
                            ['tsano',$this->dt->year + 1]
                        ])->delete();
                        
                    }
                });
                return response()->json(['result' => true], 500);
            }
           
                break;
        }
    }
}
