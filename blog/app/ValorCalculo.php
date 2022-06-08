<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ValorCalculo extends Model
{
    protected $fillable = [
        'vicodigo','vsdescricao','vireferencia','vivencimento','videscinto','base_calculo_id','trabalhador_id','created_at'
    ];
    public function basecalculos()
    {
        return $this->belongsTo(BaseCalculo::class);
    }
    public function trabalhador()
    {
        return $this->belongsTo(Trabalhador::class);
    }
    public function cadastroHorasnormais($dados)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['horanormal']['codigos'],
            'vsdescricao'=>$dados['horanormal']['descricao'],
            'vireferencia'=>$dados['horanormal']['quantidade'],
            'vivencimento'=>$dados['horanormal']['valor'],
            'base_calculo_id'=>$dados['basecalculo'],
            'trabalhador_id'=>$dados['trabalhador'],
        ]);
    }
    public function cadastroHoras50($dados)
    {
        return ValorCalculo::create([
            'vicodigo'=> $dados['hora50']['codigos'],
            'vsdescricao'=>$dados['hora50']['descricao'],
            'vireferencia'=>$dados['hora50']['quantidade'],
            'vivencimento'=>$dados['hora50']['valor'],
            'base_calculo_id'=>$dados['basecalculo'],
            'trabalhador_id'=>$dados['trabalhador'],
        ]);
    }
    public function cadastroHoras100($dados)
    {
        return ValorCalculo::create([
            'vicodigo'=> $dados['hora100']['codigos'],
            'vsdescricao'=>$dados['hora100']['descricao'],
            'vireferencia'=>$dados['hora100']['quantidade'],
            'vivencimento'=>$dados['hora100']['valor'],
            'base_calculo_id'=>$dados['basecalculo'],
            'trabalhador_id'=>$dados['trabalhador'],
        ]);
    }
    public function cadastroNoturno($dados)
    {
        return ValorCalculo::create([
            'vicodigo'=> $dados['noturno']['codigos'],
            'vsdescricao'=>$dados['noturno']['descricao'],
            'vireferencia'=>$dados['noturno']['quantidade'],
            'vivencimento'=>$dados['noturno']['valor'],
            'base_calculo_id'=>$dados['basecalculo'],
            'trabalhador_id'=>$dados['trabalhador'],
        ]);
    }
    public function cadastroProducao($dados)
    {
        return ValorCalculo::create([
            'vicodigo'=> $dados['producao']['codigos'],
            'vsdescricao'=>$dados['producao']['descricao'],
            'vireferencia'=>$dados['producao']['quantidade'],
            'vivencimento'=>$dados['producao']['valor'],
            'base_calculo_id'=>$dados['basecalculo'],
            'trabalhador_id'=>$dados['trabalhador'],
        ]);
    }

    public function cadastroGratificacao($dados)
    {
        return ValorCalculo::create([
            'vicodigo'=> $dados['gratificacao']['codigos'],
            'vsdescricao'=>$dados['gratificacao']['descricao'],
            'vireferencia'=>$dados['gratificacao']['quantidade'],
            'vivencimento'=>$dados['gratificacao']['valor'],
            'base_calculo_id'=>$dados['basecalculo'],
            'trabalhador_id'=>$dados['trabalhador'],
        ]);
    }
    public function cadastroDiarianormal($dados)
    {
        return ValorCalculo::create([
            'vicodigo'=> $dados['diarianormal']['codigos'],
            'vsdescricao'=>$dados['diarianormal']['descricao'],
            'vireferencia'=>$dados['diarianormal']['quantidade'],
            'vivencimento'=>$dados['diarianormal']['valor'],
            'base_calculo_id'=>$dados['basecalculo'],
            'trabalhador_id'=>$dados['trabalhador'],
        ]);
    }
    public function cadastroVa($dados)
    {
        return ValorCalculo::create([
            'vicodigo'=> $dados['va']['codigos'],
            'vsdescricao'=>$dados['va']['descricao'],
            'vireferencia'=>$dados['va']['quantidade'],
            'vivencimento'=>$dados['va']['valor'],
            'base_calculo_id'=>$dados['basecalculo'],
            'trabalhador_id'=>$dados['trabalhador'],
        ]);
    }
    public function cadastroVt($dados)
    {
        return ValorCalculo::create([
            'vicodigo'=> $dados['vt']['codigos'],
            'vsdescricao'=>$dados['vt']['descricao'],
            'vireferencia'=>$dados['vt']['quantidade'],
            'vivencimento'=>$dados['vt']['valor'],
            'base_calculo_id'=>$dados['basecalculo'],
            'trabalhador_id'=>$dados['trabalhador'],
        ]);
    }
    public function cadastrodsr($dados)
    {
        return ValorCalculo::create([
            'vicodigo'=> $dados['dsr1818']['codigos'],
            'vsdescricao'=>$dados['dsr1818']['rublicas'],
            'vireferencia'=>$dados['dsr1818']['quantidade'],
            'vivencimento'=>$dados['dsr1818']['valor'],
            'base_calculo_id'=>$dados['basecalculo'],
            'trabalhador_id'=>$dados['trabalhador'],
        ]);
    }
    public function cadastrodecimo_ter($dados)
    {
        return ValorCalculo::create([
            'vicodigo'=> $dados['decimo_ter']['codigos'],
            'vsdescricao'=>$dados['decimo_ter']['rublicas'],
            'vireferencia'=>$dados['decimo_ter']['quantidade'],
            'vivencimento'=>$dados['decimo_ter']['valor'],
            'base_calculo_id'=>$dados['basecalculo'],
            'trabalhador_id'=>$dados['trabalhador'],
        ]);
    }
    public function cadastroferias_decimoter($dados)
    {
        return ValorCalculo::create([
            'vicodigo'=> $dados['ferias_decimoter']['codigos'],
            'vsdescricao'=>$dados['ferias_decimoter']['rublicas'],
            'vireferencia'=>$dados['ferias_decimoter']['quantidade'],
            'vivencimento'=>$dados['ferias_decimoter']['valor'],
            'base_calculo_id'=>$dados['basecalculo'],
            'trabalhador_id'=>$dados['trabalhador'],
        ]);
    }
    public function cadastroinss_decimoter($dados)
    {
        return ValorCalculo::create([
            'vicodigo'=> $dados['inss_sobre_ter']['codigos'],
            'vsdescricao'=>$dados['inss_sobre_ter']['rublicas'],
            'vireferencia'=>$dados['inss_sobre_ter']['quantidade'],
            'videscinto'=>$dados['inss_sobre_ter']['valor'],
            'base_calculo_id'=>$dados['basecalculo'],
            'trabalhador_id'=>$dados['trabalhador'],
        ]);
    }
    public function cadastroinss($dados)
    {
        return ValorCalculo::create([
            'vicodigo'=> $dados['inss']['codigos'],
            'vsdescricao'=>$dados['inss']['rublicas'],
            'vireferencia'=>$dados['inss']['quantidade'],
            'videscinto'=>$dados['inss']['valor'],
            'base_calculo_id'=>$dados['basecalculo'],
            'trabalhador_id'=>$dados['trabalhador'],
        ]);
    }
    public function cadastroirrf($dados)
    {
        return ValorCalculo::create([
            'vicodigo'=> $dados['irrf']['codigos'],
            'vsdescricao'=>$dados['irrf']['rublicas'],
            'vireferencia'=>$dados['irrf']['quantidade'],
            'videscinto'=>$dados['irrf']['valor'],
            'base_calculo_id'=>$dados['basecalculo'],
            'trabalhador_id'=>$dados['trabalhador'],
        ]);
    }
    public function cadastrocomissionador($dados)
    {
        return ValorCalculo::create([
            'vicodigo'=> $dados['comissionador']['codigos'],
            'vsdescricao'=>$dados['comissionador']['rublicas'],
            'vireferencia'=>$dados['comissionador']['quantidade'],
            'vivencimento'=>$dados['comissionador']['valor_comissionado'],
            'videscinto'=>$dados['comissionador']['valor'],
            'base_calculo_id'=>$dados['basecalculo'],
            'trabalhador_id'=>$dados['trabalhador'],
        ]);
    }
    public function cadastroadiantamento($dados)
    {
        return ValorCalculo::create([
            'vicodigo'=> $dados['adiantamento']['codigos'],
            'vsdescricao'=>$dados['adiantamento']['rublicas'],
            'vireferencia'=>$dados['adiantamento']['quantidade'],
            'videscinto'=>$dados['adiantamento']['valor'],
            'base_calculo_id'=>$dados['basecalculo'],
            'trabalhador_id'=>$dados['trabalhador'],
        ]);
    }
    public function cadastrofamilia($dados)
    {
        return ValorCalculo::create([
            'vicodigo'=> $dados['familia']['codigos'],
            'vsdescricao'=>$dados['familia']['rublicas'],
            'vireferencia'=>$dados['familia']['quantidade'],
            'vivencimento'=>$dados['familia']['valor'],
            'base_calculo_id'=>$dados['basecalculo'],
            'trabalhador_id'=>$dados['trabalhador'],
        ]);
    }
    public function cadastroadesconto($dados)
    {
        return ValorCalculo::create([
            'vicodigo'=> $dados['descontos']['codigos'],
            'vsdescricao'=>$dados['descontos']['rublicas'],
            'vireferencia'=>$dados['descontos']['quantidade'],
            'videscinto'=>$dados['descontos']['valor'],
            'base_calculo_id'=>$dados['basecalculo'],
            'trabalhador_id'=>$dados['trabalhador'],
        ]);
    }
    public function cadastroaseguro($dados)
    {
        return ValorCalculo::create([
            'vicodigo'=> $dados['seguro']['codigos'],
            'vsdescricao'=>$dados['seguro']['rublicas'],
            'vireferencia'=>$dados['seguro']['quantidade'],
            'videscinto'=>$dados['seguro']['valor'],
            'base_calculo_id'=>$dados['basecalculo'],
            'trabalhador_id'=>$dados['trabalhador'],
        ]);
    }
    public function cadastroasindicator($dados)
    {
        return ValorCalculo::create([
            'vicodigo'=> $dados['sindicator']['codigos'],
            'vsdescricao'=>$dados['sindicator']['rublicas'],
            'vireferencia'=>$dados['sindicator']['quantidade'],
            'videscinto'=>$dados['sindicator']['valor'],
            'base_calculo_id'=>$dados['basecalculo'],
            'trabalhador_id'=>$dados['trabalhador'],
        ]);
    }
    public function listaGeral($folhar,$trabalhador,$codigos)
    {
        return DB::table('base_calculos') 
            ->join('valor_calculos', 'base_calculos.id', '=', 'valor_calculos.base_calculo_id')
            ->selectRaw(
                'SUM(valor_calculos.vivencimento) as vencimento,
                SUM(valor_calculos.videscinto) as desconto,
                SUM(valor_calculos.vireferencia) as referencia,
                valor_calculos.trabalhador_id,
                valor_calculos.vicodigo,
                valor_calculos.vsdescricao'
            )
            ->groupBy('valor_calculos.trabalhador_id','valor_calculos.vicodigo','valor_calculos.vsdescricao')
            ->where('base_calculos.folhar_id',$folhar)
            ->where('base_calculos.tomador_id','!=',null)
            ->where('base_calculos.trabalhador_id',$trabalhador)
            ->whereIn('valor_calculos.vicodigo',$codigos)
            ->get();
    }
    public function listaIntegral($folhar,$trabalhador,$codigos)
    {
        return DB::table('base_calculos') 
            ->join('valor_calculos', 'base_calculos.id', '=', 'valor_calculos.base_calculo_id')
            ->selectRaw(
                'SUM(valor_calculos.vivencimento) as vencimento,
                SUM(valor_calculos.videscinto) as desconto,
                SUM(valor_calculos.vireferencia) as referencia,
                valor_calculos.trabalhador_id,
                valor_calculos.vicodigo,
                valor_calculos.vsdescricao'
            )
            ->groupBy('valor_calculos.trabalhador_id','valor_calculos.vicodigo','valor_calculos.vsdescricao')
            ->where('base_calculos.folhar_id',$folhar)
            ->where('base_calculos.tomador_id','!=',null)
            ->where('base_calculos.trabalhador_id',$trabalhador)
            ->whereIn('valor_calculos.vicodigo',$codigos)
            ->get();
    }
    // public function cadastroHorasnormais($dados,$basecalculo,$trabalahdor,$i,$data)
    // {
    //     return ValorCalculo::create([
    //         'vicodigo'=> (int)$dados['horasNormais']['codigos'][$i],
    //         'vsdescricao'=>$dados['horasNormais']['rublicas'][$i],
    //         'vireferencia'=>$dados['horasNormais']['quantidade'][$i],
    //         'vivencimento'=>$dados['horasNormais']['valor'][$i],
    //         'base_calculo_id'=>$basecalculo,
    //         'trabalhador_id'=>$trabalahdor,
    //         'created_at'=>$data
    //     ]);
    // }
   

   
    public function cadastrodiariaNormais($dados,$basecalculo,$trabalahdor,$i,$data)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['diariaNormais']['codigos'][$i],
            'vsdescricao'=>$dados['diariaNormais']['rublicas'][$i],
            'vireferencia'=>$dados['diariaNormais']['quantidade'][$i],
            'vivencimento'=>$dados['diariaNormais']['valor'][$i],
            'basecalculo_id'=>$basecalculo,
            'trabalhador_id'=>$trabalahdor,
            'created_at'=>$data
        ]);
    }

    public function cadastroadicionalNoturno($dados,$basecalculo,$trabalahdor,$i,$data)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['adicional noturno']['codigos'][$i],
            'vsdescricao'=>$dados['adicional noturno']['rublicas'][$i],
            'vireferencia'=>$dados['adicional noturno']['quantidade'][$i],
            'vivencimento'=>$dados['adicional noturno']['valor'][$i],
            'basecalculo_id'=>$basecalculo,
            'trabalhador_id'=>$trabalahdor,
            'created_at'=>$data
        ]);
    }
   
    public function cadastroHorasEx50($dados,$basecalculo,$trabalahdor,$i,$data)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['hora extra 50%']['codigos'][$i],
            'vsdescricao'=>$dados['hora extra 50%']['rublicas'][$i],
            'vireferencia'=>$dados['hora extra 50%']['quantidade'][$i],
            'vivencimento'=>$dados['hora extra 50%']['valor'][$i],
            'basecalculo_id'=>$basecalculo,
            'trabalhador_id'=>$trabalahdor,
            'created_at'=>$data
        ]);
    }

    
    public function cadastroHorasEx100($dados,$basecalculo,$trabalahdor,$i,$data)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['hora extra 100%']['codigos'][$i],
            'vsdescricao'=>$dados['hora extra 100%']['rublicas'][$i],
            'vireferencia'=>$dados['hora extra 100%']['quantidade'][$i],
            'vivencimento'=>$dados['hora extra 100%']['valor'][$i],
            'basecalculo_id'=>$basecalculo,
            'trabalhador_id'=>$trabalahdor,
            'created_at'=>$data
        ]);
    }
    // public function cadastroGratificacao($dados,$basecalculo,$trabalahdor,$i,$data)
    // {
    //     return ValorCalculo::create([
    //         'vicodigo'=> (int)$dados['gratificação']['codigos'][$i],
    //         'vsdescricao'=>$dados['gratificação']['rublicas'][$i],
    //         'vireferencia'=>$dados['gratificação']['quantidade'][$i],
    //         'vivencimento'=>$dados['gratificação']['valor'][$i],
    //         'basecalculo_id'=>$basecalculo,
    //         'trabalhador_id'=>$trabalahdor,
    //         'created_at'=>$data
    //     ]);
    // }
    public function cadastraAdiantamento($dados,$basecalculo,$trabalahdor,$data)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['adiantamento']['codigos'],
            'vsdescricao'=>$dados['adiantamento']['rublicas'],
            'vireferencia'=>$dados['adiantamento']['quantidade'],
            'videscinto'=>$dados['adiantamento']['valor'],
            'basecalculo_id'=>$basecalculo,
            'trabalhador_id'=>$trabalahdor,
            'created_at'=>$data
        ]);
    }
    public function cadastraIrrf($dados,$basecalculo,$trabalahdor,$data)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['irrf']['codigos'],
            'vsdescricao'=>$dados['irrf']['rublicas'],
            'vireferencia'=>$dados['irrf']['quantidade'],
            'videscinto'=>$dados['irrf']['valor'],
            'basecalculo_id'=>$basecalculo,
            'trabalhador_id'=>$trabalahdor,
            'created_at'=>$data
        ]);
    }
    public function cadastraDesconto($dados,$basecalculo,$trabalahdor,$data)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['descontos']['codigos'],
            'vsdescricao'=>$dados['descontos']['rublicas'],
            'vireferencia'=>$dados['descontos']['quantidade'],
            'videscinto'=>$dados['descontos']['valor'],
            'basecalculo_id'=>$basecalculo,
            'trabalhador_id'=>$trabalahdor,
            'created_at'=>$data
        ]);
    }
    // public function cadastroProducao($dados,$basecalculo,$trabalahdor,$i,$data)
    // {
    //     return ValorCalculo::create([
    //         'vicodigo'=> (int)$dados['producao']['codigos'][$i],
    //         'vsdescricao'=>$dados['producao']['rublicas'][$i],
    //         'vireferencia'=>$dados['producao']['quantidade'][$i],
    //         'vivencimento'=>$dados['producao']['valor'][$i],
    //         'basecalculo_id'=>$basecalculo,
    //         'trabalhador_id'=>$trabalahdor,
    //         'created_at'=>$data
    //     ]);
    // }
    public function cadastrodsr1818($dados,$basecalculo,$trabalahdor,$i,$data)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['dsr1818']['codigos'][$i],
            'vsdescricao'=>$dados['dsr1818']['rublicas'][$i],
            'vireferencia'=>$dados['dsr1818']['quantidade'][$i],
            'vivencimento'=>$dados['dsr1818']['valor'][$i],
            'basecalculo_id'=>$basecalculo,
            'trabalhador_id'=>$trabalahdor,
            'created_at'=>$data
        ]);
    }
    public function buscaUnidaderdsr1818($trabalhador,$codigo,$data)
    {
        return ValorCalculo::selectRaw(
            'SUM(vivencimento) as vencimento,
            SUM(videscinto) as desconto,
            vireferencia as referencia,
            trabalhador_id,
            vicodigo,
            vsdescricao,
            created_at'
        )
        ->groupBy('trabalhador_id','vicodigo','vsdescricao','referencia','created_at')
        ->where('vicodigo',$codigo)
        ->where('trabalhador_id',$trabalhador)
        ->whereDate('created_at', $data)
        ->first();
    }
    public function cadastraFeriasDecimoter($dados,$basecalculo,$trabalahdor,$i,$data)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['ferias_decimoter']['codigos'][$i],
            'vsdescricao'=>$dados['ferias_decimoter']['rublicas'][$i],
            'vireferencia'=>$dados['ferias_decimoter']['quantidade'][$i],
            'vivencimento'=>$dados['ferias_decimoter']['valor'][$i],
            'basecalculo_id'=>$basecalculo,
            'trabalhador_id'=>$trabalahdor,
            'created_at'=>$data
        ]);
    }
    public function buscaUnidaderFeriasDecimoter($trabalhador,$codigo,$data)
    {
        return ValorCalculo::selectRaw(
            'SUM(vivencimento) as vencimento,
            SUM(videscinto) as desconto,
            vireferencia as referencia,
            trabalhador_id,
            vicodigo,
            vsdescricao,
            created_at'
        )
        ->groupBy('trabalhador_id','vicodigo','vsdescricao','referencia','created_at')
        ->where('vicodigo',$codigo)
        ->where('trabalhador_id',$trabalhador)
        ->whereDate('created_at', $data)
        ->first();
    }
    public function buscaUnidaderInss($trabalhador,$codigo,$descricao,$data)
    {
        return ValorCalculo::selectRaw(
            'SUM(vivencimento) as vencimento,
            SUM(videscinto) as desconto,
            trabalhador_id,
            vicodigo,
            vsdescricao,
            created_at'
        )
        ->groupBy('trabalhador_id','vicodigo','vsdescricao','created_at')
        ->where('vicodigo',$codigo)
        ->where('vsdescricao','like','%'.$descricao."%")
        ->where('trabalhador_id',$trabalhador)
        ->whereDate('created_at', $data)
        ->first();
    }
    public function cadastraDecimoTer($dados,$basecalculo,$trabalahdor,$i,$data)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['decimo_ter']['codigos'][$i],
            'vsdescricao'=>$dados['decimo_ter']['rublicas'][$i],
            'vireferencia'=>$dados['decimo_ter']['quantidade'][$i],
            'vivencimento'=>$dados['decimo_ter']['valor'][$i],
            'basecalculo_id'=>$basecalculo,
            'trabalhador_id'=>$trabalahdor,
            'created_at'=>$data
        ]);
    }
    public function cadastrainssSobreTer($dados,$basecalculo,$trabalahdor,$i,$data)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['inss_sobre_ter']['codigos'][$i],
            'vsdescricao'=>$dados['inss_sobre_ter']['rublicas'][$i],
            'vireferencia'=>$dados['inss_sobre_ter']['quantidade'][$i],
            'videscinto'=>$dados['inss_sobre_ter']['valor'][$i],
            'basecalculo_id'=>$basecalculo,
            'trabalhador_id'=>$trabalahdor,
            'created_at'=>$data
        ]);
    }
    public function cadastraInssTomador($dados,$basecalculo,$trabalahdor,$i,$data)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['inss']['codigos'][$i],
            'vsdescricao'=>$dados['inss']['rublicas'][$i],
            'vireferencia'=>$dados['inss']['quantidade'][$i],
            'videscinto'=>$dados['inss']['valor'][$i],
            'basecalculo_id'=>$basecalculo,
            'trabalhador_id'=>$trabalahdor,
            'created_at'=>$data
        ]);
    }
    public function cadastraInss($dados,$basecalculo,$trabalahdor,$data)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['inss']['codigos'],
            'vsdescricao'=>$dados['inss']['rublicas'],
            'vireferencia'=>$dados['inss']['quantidade'],
            'videscinto'=>$dados['inss']['valor'],
            'basecalculo_id'=>$basecalculo,
            'trabalhador_id'=>$trabalahdor,
            'created_at'=>$data
        ]);
    }
    public function cadastroSindicator($dados,$basecalculo,$trabalahdor,$data)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['sindicator']['codigos'],
            'vsdescricao'=>$dados['sindicator']['rublicas'],
            'vireferencia'=>$dados['sindicator']['quantidade'],
            'videscinto'=>$dados['sindicator']['valor'],
            'basecalculo_id'=>$basecalculo,
            'trabalhador_id'=>$trabalahdor,
            'created_at'=>$data
        ]);
    }
    public function cadastroSeguro($dados,$basecalculo,$trabalahdor,$data)
    {
        return ValorCalculo::create([
            'vicodigo'=> (int)$dados['seguro']['codigos'],
            'vsdescricao'=>$dados['seguro']['rublicas'],
            'vireferencia'=>$dados['seguro']['quantidade'],
            'videscinto'=>$dados['seguro']['valor'],
            'basecalculo_id'=>$basecalculo,
            'trabalhador_id'=>$trabalahdor,
            'created_at'=>$data
        ]);
    }
    // public function cadastroVT($dados,$basecalculo,$trabalhador,$i,$data)
    // {
    //     return ValorCalculo::create([
    //         'vicodigo'=> (int)$dados['vt']['codigos'][$i],
    //         'vsdescricao'=>$dados['vt']['rublicas'][$i],
    //         'vireferencia'=>$dados['vt']['quantidade'][$i],
    //         'vivencimento'=>$dados['vt']['valor'][$i],
    //         'basecalculo_id'=>$basecalculo,
    //         'trabalhador_id'=>$trabalhador,
    //         'created_at'=>$data
    //     ]);
    // }
    // public function cadastroVA($dados,$basecalculo,$trabalhador,$i,$data)
    // {
    //     return ValorCalculo::create([
    //         'vicodigo'=> (int)$dados['va']['codigos'][$i],
    //         'vsdescricao'=>$dados['va']['rublicas'][$i],
    //         'vireferencia'=>$dados['va']['quantidade'][$i],
    //         'vivencimento'=>$dados['va']['valor'][$i],
    //         'basecalculo_id'=>$basecalculo,
    //         'trabalhador_id'=>$trabalhador,
    //         'created_at'=>$data
    //     ]);
    // }
    // public function listaGeral($trabalhador,$data,$codigo)
    // {
    //     if ($codigo === '1002' || $codigo === '1003' || $codigo === '1005'||
    //     $codigo === '1000' || $codigo === '1006' || $codigo === '1004' || 
    //     $codigo === '1007' || $codigo === '1012' || $codigo === '1013') {
    //         return ValorCalculo::selectRaw(
    //             'SUM(vivencimento) as vencimento,
    //             SUM(videscinto) as desconto,
    //             SUM(vireferencia) as referencia,
    //             trabalhador_id,
    //             vicodigo,
    //             vsdescricao,
    //             created_at'
    //         )
    //         ->groupBy('trabalhador_id','vicodigo','vsdescricao','created_at')
    //         ->whereIn('trabalhador_id',$trabalhador)
    //         ->where('vicodigo',$codigo)
    //         ->whereDate('created_at', $data)
    //         ->get();
    //     }else{
    //         return ValorCalculo::selectRaw(
    //             'SUM(vivencimento) as vencimento,
    //             SUM(videscinto) as desconto,
    //             vireferencia as referencia,
    //             trabalhador_id,
    //             vicodigo,
    //             vsdescricao,
    //             created_at'
    //         )
    //         ->groupBy('trabalhador_id','vicodigo','referencia','vsdescricao','created_at')
    //         ->whereIn('trabalhador_id',$trabalhador)
    //         ->where('vicodigo',$codigo)
    //         ->whereDate('created_at', $data)
    //         ->get();
    //     }
    // }
    public function cadastraGeral($dados,$basecalculo)
    {
        return ValorCalculo::create([
            'vicodigo'=> $dados['vicodigo'],
            'vsdescricao'=>$dados['vsdescricao'],
            'vireferencia'=>$dados['referencia'],
            'vivencimento'=>$dados['vencimento'],
            'basecalculo_id'=>$basecalculo,
            'videscinto'=> $dados['desconto'],
            'trabalhador_id'=>$dados['trabalhador'],
            'created_at'=>$dados['created_at']
        ]);
    }
    public function buscaImprimir($id)
    {
        return ValorCalculo::select('vicodigo','vsdescricao','vireferencia','vivencimento','videscinto','base_calculo_id')
        ->whereIn('base_calculo_id',$id)
        ->orderBy('vicodigo', 'asc')
        ->get();
    }
    public function buscaImprimirTrabalhador($id)
    {
        return ValorCalculo::select('vicodigo','vsdescricao','vireferencia','vivencimento','videscinto','base_calculo_id')
        ->where('base_calculo_id',$id)
        ->orderBy('vicodigo', 'asc')
        ->get();
    }
    public function buscaImprimirTomador($id,$incide,$naoincide)
    {
        $variavel = DB::table('base_calculos') 
                    ->join('valor_calculos', 'base_calculos.id', '=', 'valor_calculos.base_calculo_id')
                    ->selectRaw(
                        'SUM(valor_calculos.vivencimento) as vivencimento,
                        SUM(valor_calculos.videscinto) as videscinto,
                        SUM(valor_calculos.vireferencia) as vireferencia,
                        valor_calculos.vicodigo,
                        valor_calculos.vsdescricao,
                        valor_calculos.base_calculo_id,
                        base_calculos.id'
                        
                    )
                   ->whereIn('valor_calculos.base_calculo_id',$id)
                   ->orderBy('vicodigo', 'asc')
                   ->whereIn('valor_calculos.vicodigo',$incide)
                   ->groupBy('valor_calculos.vicodigo','valor_calculos.base_calculo_id','base_calculos.id','valor_calculos.vsdescricao')
                   ->get();
            $fixio = DB::table('base_calculos')
                   ->join('valor_calculos', 'base_calculos.id', '=', 'valor_calculos.base_calculo_id')
                   ->selectRaw(
                       'SUM(valor_calculos.vivencimento) as vivencimento,
                       SUM(valor_calculos.videscinto) as videscinto,
                       vireferencia,
                       valor_calculos.vicodigo,
                       valor_calculos.vsdescricao,
                       valor_calculos.base_calculo_id,
                       base_calculos.id'
                       
                   )
                  ->whereIn('valor_calculos.base_calculo_id',$id)
                  ->orderBy('vicodigo', 'asc')
                  ->whereIn('valor_calculos.vicodigo',$naoincide)
                  ->groupBy('valor_calculos.vicodigo','valor_calculos.base_calculo_id','valor_calculos.vireferencia','base_calculos.id','valor_calculos.vsdescricao')
                  ->get();
        return[$variavel,$fixio];
    }
    public function sefipInss($basecalculo,$codigo)
    {
        return ValorCalculo::where([
            ['base_calculo_id',$basecalculo],
            ['vicodigo',$codigo],
        ])
        ->first();
    }
    public function deletar($id)
    {
        return ValorCalculo::whereIn('basecalculo_id',$id)->delete();
    }

    public function calculoFolhaAnaliticaProducao($id,$codigo,$tomador)
    {
        return DB::table('folhars')
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar_id')
        ->join('trabalhadors', 'trabalhadors.id', '=', 'base_calculos.trabalhador_id')
        ->join('valor_calculos', 'base_calculos.id', '=', 'valor_calculos.base_calculo_id')
        ->selectRaw('SUM(vivencimento) as vencimento,base_calculos.bivalorliquido,base_calculos.bivalorvencimento,base_calculos.trabalhador_id,trabalhadors.tsmatricula,trabalhadors.tsnome')
        ->groupBy('base_calculos.bivalorliquido','base_calculos.bivalorvencimento','base_calculos.trabalhador_id','trabalhadors.tsnome','trabalhadors.tsmatricula')
        ->where('folhars.id',$id)
        ->where([
            ['base_calculos.tomador_id',$tomador],
            ['valor_calculos.vsdescricao','!=','Vale transporte'],
            ['valor_calculos.vsdescricao','!=','Vale alimentação'],
            ])
        ->whereIn('valor_calculos.vicodigo',$codigo)
        ->get();
    }
    public function calculoFolhaAnaliticaDsr($id,$codigo,$tomador)
    {
        return DB::table('folhars')
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar_id')
        ->join('valor_calculos', 'base_calculos.id', '=', 'valor_calculos.base_calculo_id')
        ->selectRaw('SUM(vivencimento) as vencimento,base_calculos.trabalhador_id')
        ->groupBy('base_calculos.trabalhador_id')
        ->where('folhars.id',$id)
        ->where('base_calculos.tomador_id',$tomador)
        ->whereIn('valor_calculos.vicodigo',$codigo)
        ->where('valor_calculos.vsdescricao','DSR 18,18%')
        ->get();
    }
    public function calculoFolhaAnaliticaFerias($id,$codigo,$tomador)
    {
        return DB::table('folhars')
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar_id')
        ->join('valor_calculos', 'base_calculos.id', '=', 'valor_calculos.base_calculo_id')
        ->selectRaw('SUM(vivencimento) as vencimento,base_calculos.trabalhador_id')
        ->groupBy('base_calculos.trabalhador_id')
        ->where('folhars.id',$id)
        ->where('base_calculos.tomador_id',$tomador)
        ->whereIn('valor_calculos.vicodigo',$codigo)
        ->where('valor_calculos.vsdescricao','Ferias + 1/3')
        ->get();
    }
    public function calculoFolhaAnaliticaVT($id,$codigo,$tomador)
    {
        return DB::table('folhars')
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar_id')
        ->join('valor_calculos', 'base_calculos.id', '=', 'valor_calculos.base_calculo_id')
        ->selectRaw('SUM(vivencimento) as vencimento,base_calculos.trabalhador_id')
        ->groupBy('base_calculos.trabalhador_id')
        ->where('folhars.id',$id)
        ->where('base_calculos.tomador_id',$tomador)
        ->whereIn('valor_calculos.vicodigo',$codigo)
        ->where('valor_calculos.vsdescricao','Vale transporte')
        ->get();
    }
    public function calculoFolhaAnaliticaVA($id,$codigo,$tomador)
    {
        return DB::table('folhars')
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar_id')
        ->join('valor_calculos', 'base_calculos.id', '=', 'valor_calculos.base_calculo_id')
        ->selectRaw('SUM(vivencimento) as vencimento,base_calculos.trabalhador_id')
        ->groupBy('base_calculos.trabalhador_id')
        ->where('folhars.id',$id)
        ->where('base_calculos.tomador_id',$tomador)
        ->whereIn('valor_calculos.vicodigo',$codigo)
        ->where('valor_calculos.vsdescricao','Vale alimentação')
        ->get();
    }
    public function calculoFolhaAnalitica13Salario($id,$codigo,$tomador)
    {
        return DB::table('folhars')
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar_id')
        ->join('valor_calculos', 'base_calculos.id', '=', 'valor_calculos.base_calculo_id')
        ->selectRaw('SUM(vivencimento) as vencimento,base_calculos.trabalhador_id')
        ->groupBy('base_calculos.trabalhador_id')
        ->where('folhars.id',$id)
        ->where('base_calculos.tomador_id',$tomador)
        ->whereIn('valor_calculos.vicodigo',$codigo)
        ->where('valor_calculos.vsdescricao','13º Salário')
        ->get();
    }
    public function calculoFolhaAnaliticaSeguro($id,$codigo,$tomador)
    {
        return DB::table('folhars')
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar_id')
        ->join('valor_calculos', 'base_calculos.id', '=', 'valor_calculos.base_calculo_id')
        ->selectRaw('SUM(videscinto) as desconto,base_calculos.trabalhador_id')
        ->groupBy('base_calculos.trabalhador_id')
        ->where('folhars.id',$id)
        ->where('base_calculos.tomador_id',$tomador)
        ->whereIn('valor_calculos.vicodigo',$codigo)
        ->where('valor_calculos.vsdescricao','Seguro')
        ->get();
    }
    public function calculoFolhaAnaliticaSindicator($id,$codigo,$tomador)
    {
        return DB::table('folhars')
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar_id')
        ->join('valor_calculos', 'base_calculos.id', '=', 'valor_calculos.base_calculo_id')
        ->selectRaw('SUM(videscinto) as desconto,base_calculos.trabalhador_id')
        ->groupBy('base_calculos.trabalhador_id')
        ->where('folhars.id',$id)
        ->where('base_calculos.tomador_id',$tomador)
        ->whereIn('valor_calculos.vicodigo',$codigo)
        ->where('valor_calculos.vsdescricao','Sindicator')
        ->get();
    }
    public function calculoFolhaAnaliticaAdiantamento($id,$codigo,$tomador)
    {
        return DB::table('folhars')
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar_id')
        ->join('valor_calculos', 'base_calculos.id', '=', 'valor_calculos.base_calculo_id')
        ->selectRaw('SUM(videscinto) as desconto,base_calculos.trabalhador_id')
        ->groupBy('base_calculos.trabalhador_id')
        ->where('folhars.id',$id)
        ->where('base_calculos.tomador_id',$tomador)
        ->whereIn('valor_calculos.vicodigo',$codigo)
        ->where('valor_calculos.vsdescricao','Vale alimentação')
        ->get();
    }
    public function calculoFolhaAnaliticaIrrf($id,$codigo,$tomador)
    {
        return DB::table('folhars')
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar_id')
        ->join('valor_calculos', 'base_calculos.id', '=', 'valor_calculos.base_calculo_id')
        ->selectRaw('SUM(videscinto) as desconto,base_calculos.trabalhador_id')
        ->groupBy('base_calculos.trabalhador_id')
        ->where('folhars.id',$id)
        ->where('base_calculos.tomador_id',$tomador)
        ->whereIn('valor_calculos.vicodigo',$codigo)
        ->where('valor_calculos.vsdescricao','IRRF')
        ->get();
    }
    public function calculoFolhaAnaliticaInss($id,$codigo,$tomador)
    {
        return DB::table('folhars')
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar_id')
        ->join('valor_calculos', 'base_calculos.id', '=', 'valor_calculos.base_calculo_id')
        ->selectRaw('SUM(videscinto) as desconto,base_calculos.trabalhador_id')
        ->groupBy('base_calculos.trabalhador_id')
        ->where('folhars.id',$id)
        ->where('base_calculos.tomador_id',$tomador)
        ->whereIn('valor_calculos.vicodigo',$codigo)
        ->where('valor_calculos.vsdescricao','INSS')
        ->get();
    }
    public function calculoFolhaAnaliticaInssSobre13($id,$codigo,$tomador)
    {
        return DB::table('folhars')
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar_id')
        ->join('valor_calculos', 'base_calculos.id', '=', 'valor_calculos.base_calculo_id')
        ->selectRaw('SUM(videscinto) as desconto,base_calculos.trabalhador_id')
        ->groupBy('base_calculos.trabalhador_id')
        ->where('folhars.id',$id)
        ->where('base_calculos.tomador_id',$tomador)
        ->whereIn('valor_calculos.vicodigo',$codigo)
        ->where('valor_calculos.vsdescricao','INSS Sobre 13º Salário')
        ->get();
    }
    public function calculoFolhaAnaliticaDesconto($id,$codigo,$tomador)
    {
        return DB::table('folhars')
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar_id')
        ->join('valor_calculos', 'base_calculos.id', '=', 'valor_calculos.base_calculo_id')
        ->selectRaw('SUM(videscinto) as desconto,base_calculos.trabalhador_id')
        ->groupBy('base_calculos.trabalhador_id')
        ->where('folhars.id',$id)
        ->where('base_calculos.tomador_id',null)
        ->whereIn('valor_calculos.vicodigo',$codigo)
        ->get();
    }
    public function buscaInss($trabalhador,$data)
    {
        return DB::table('base_calculos')
        ->join('valor_calculos', 'base_calculos.id', '=', 'valor_calculos.base_calculo_id')
        ->selectRaw('SUM(videscinto) as desconto,base_calculos.trabalhador_id')
        ->groupBy('base_calculos.trabalhador_id')
        ->whereIn('base_calculos.trabalhador_id',$trabalhador)
        ->whereDate('base_calculos.created_at', $data)
        ->where('vicodigo',2001)
        ->get();
    }
    public function buscaInss13($trabalhador,$data)
    {
        return DB::table('base_calculos')
        ->join('valor_calculos', 'base_calculos.id', '=', 'valor_calculos.base_calculo_id')
        ->selectRaw('SUM(videscinto) as desconto,base_calculos.trabalhador_id')
        ->groupBy('base_calculos.trabalhador_id')
        ->whereIn('base_calculos.trabalhador_id',$trabalhador)
        ->whereDate('base_calculos.created_at', $data)
        ->where('vicodigo',2002)
        ->get();
    }

    public function producaoFatura($dados,$codigo)  
    {
        return DB::table('folhars')
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar_id')
        ->join('valor_calculos', 'base_calculos.id', '=', 'valor_calculos.base_calculo_id')
        ->selectRaw(
            'SUM(valor_calculos.vivencimento) as vencimento,
            SUM(valor_calculos.videscinto) as desconto,
            valor_calculos.vireferencia,
            
            
            valor_calculos.vicodigo,
            valor_calculos.vsdescricao'
        )
        ->groupBy('valor_calculos.vireferencia','valor_calculos.vicodigo','valor_calculos.vsdescricao')
        ->where('base_calculos.tomador_id',$dados['tomador'])
        ->whereIn('valor_calculos.vicodigo',$codigo)
        ->orderBy('valor_calculos.vicodigo','asc')
        ->whereBetween('folhars.fsfinal',[$dados['ano_inicial'],$dados['ano_final']])
        ->get();
    }
    public function producaoFaturaIn($dados,$codigo)
    {
        return DB::table('folhars')
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar_id')
        ->join('valor_calculos', 'base_calculos.id', '=', 'valor_calculos.base_calculo_id')
        ->selectRaw(
            'SUM(valor_calculos.vireferencia) as referencia,
            SUM(valor_calculos.vivencimento) as valor,
            folhars.fscodigo,
            valor_calculos.vicodigo,valor_calculos.vsdescricao'
        )
        ->groupBy('valor_calculos.vicodigo','folhars.fscodigo','valor_calculos.vsdescricao')
        ->where('base_calculos.tomador_id',$dados['tomador'])
        ->whereIn('valor_calculos.vicodigo',$codigo)
        ->whereBetween('folhars.fsfinal',[$dados['ano_inicial'],$dados['ano_final']])
        ->get();
    }

    public function quantrabalhador($dados)
    {
        return DB::table('folhars')
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar_id')
        ->selectRaw(
            'count(base_calculos.trabalhador_id) as trabalhador'
        )
        ->where('base_calculos.tomador_id',$dados['tomador'])
        ->whereBetween('folhars.fsfinal',[$dados['ano_inicial'],$dados['ano_final']])
        ->get();
    }
    public function rublicasFatura($dados)
    {
        return DB::table('folhars')
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar_id')
        ->join('valor_calculos', 'base_calculos.id', '=', 'valor_calculos.base_calculo_id')
        ->selectRaw(
            'SUM(valor_calculos.vivencimento) as vencimento,
            SUM(valor_calculos.videscinto) as desconto,
            valor_calculos.vireferencia,
            valor_calculos.vicodigo,
            valor_calculos.vsdescricao'
        ) 
        ->groupBy('valor_calculos.vireferencia','valor_calculos.vicodigo','valor_calculos.vsdescricao')
        ->where('base_calculos.tomador_id',$dados['tomador'])
        ->whereBetween('valor_calculos.vicodigo',[1008,2003])
        ->whereBetween('base_calculos.created_at',[$dados['ano_inicial'],$dados['ano_final']])
        ->orderBy('vicodigo','asc')
        ->get();
    }
    public function rublicasFaturaInss($dados)
    {
        return DB::table('folhars')
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar_id')
        ->join('valor_calculos', 'base_calculos.id', '=', 'valor_calculos.base_calculo_id')
        ->selectRaw(
            'SUM(valor_calculos.vivencimento) as vencimento,
            SUM(valor_calculos.videscinto) as desconto,
            valor_calculos.vicodigo,
            valor_calculos.vsdescricao'
        )
        ->groupBy('valor_calculos.vicodigo','valor_calculos.vsdescricao')
        ->where('base_calculos.tomador_id',$dados['tomador'])
        ->whereBetween('valor_calculos.vicodigo',[1008,2003])
        // ->whereDate('base_calculos.created_at', $dados['ano_final'])
        ->whereBetween('base_calculos.created_at',[$dados['ano_inicial'],$dados['ano_final']])
        ->orderBy('vicodigo','asc')
        ->get();
    }
}
