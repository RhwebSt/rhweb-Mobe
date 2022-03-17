<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Folhar extends Model
{
    protected $fillable = [
        'fscodigo','fsinicio','fsfinal','fscompetencia','empresa','created_at'
    ];
    public function cadastro($dados,$empresa){
        return Folhar::create([
            'fscodigo'=>$dados['codigo'],
            'fsinicio'=>$dados['inicio'],
            'fsfinal'=>$dados['final'],
            'fscompetencia'=>$dados['competencia'],
            'empresa'=>$empresa
        ]);
    }
    public function buscaUnidadeFolhar($id)
    {
        return Folhar::where('id',$id)->first();
    }
    public function buscaUltimaoRegistroFolhar($empresa)
    {
        return Folhar::orderBy('created_at', 'desc')->where('empresa',$empresa)->first();
    }
    public function verificaFolhar($datainicio,$datafinal)
    {
        $user = auth()->user();
        return Folhar::whereDate('fsinicio', $datainicio) 
        ->whereDate('fsfinal', $datafinal)
        ->where('empresa',$user->empresa)
        ->count();
    }

    public function Folhar($datainicio,$datafinal)
    {
        $user = auth()->user();
        return Folhar::whereDate('fsinicio', $datainicio) 
        ->whereDate('fsfinal', $datafinal)
        ->where('empresa',$user->empresa)
        ->first();
    }
    public function buscaListaFolhar($empresa)
    {
        return Folhar::where('empresa',$empresa)->get();
    }
    public function buscaListaOrdem($empresa,$condicao)
    {
        return Folhar::where('empresa',$empresa)
        ->orderBy('fscodigo', $condicao)
        ->orderBy('fsfinal', $condicao)
        ->get();
    }
    public function filtraListaTomador($dados,$empresa)
    {
        return DB::table('folhars')
        ->join('empresas', 'empresas.id', '=', 'folhars.empresa')
        ->join('tomadors', 'empresas.id', '=', 'tomadors.empresa')
        ->select('folhars.id','folhars.fscodigo','folhars.fsinicio','folhars.fsfinal')
        ->where([
            ['tomadors.tsnome','like','%'.$dados['pesquisa'].'%'],
            ['empresas.id',$empresa]
        ])
        ->whereBetween('folhars.fsfinal',[$dados['inicio'],$dados['final']])
        ->distinct()
        ->get();
    }

    public function filtraListaGeral($dados,$empresa)
    {
        return DB::table('folhars')
        ->join('empresas', 'empresas.id', '=', 'folhars.empresa')
        ->join('tomadors', 'empresas.id', '=', 'tomadors.empresa')
        ->select('folhars.id','folhars.fscodigo','folhars.fsinicio','folhars.fsfinal')
        ->where([
            ['folhars.fscodigo',$dados['pesquisa']],
            ['empresas.id',$empresa]
        ])
        ->whereBetween('folhars.fsfinal',[$dados['inicio'],$dados['final']])
        ->distinct()
        ->get();
    }
    public function buscaLista($id) 
    {
        return DB::table('folhars')
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar')
        ->join('empresas', 'empresas.id', '=', 'folhars.empresa')
        ->join('trabalhadors', 'trabalhadors.id', '=', 'base_calculos.trabalhador')
        ->join('documentos', 'trabalhadors.id', '=', 'documentos.trabalhador')
        ->join('bancarios', 'trabalhadors.id', '=', 'bancarios.trabalhador')
        ->join('categorias', 'trabalhadors.id', '=', 'categorias.trabalhador')
        ->select(
            'folhars.fsinicio',
            'folhars.fsfinal',
            'empresas.esnome',
            'empresas.escnpj',
            'trabalhadors.tsnome',
            'trabalhadors.tsmatricula',
            'trabalhadors.tscpf',
            'documentos.dspis',
            'categorias.cbo',
            'categorias.cscategoria',
            'bancarios.bsbanco',
            'bancarios.bsagencia',
            'bancarios.bsoperacao',
            'bancarios.bsconta',
            'base_calculos.id',
            'base_calculos.biservico',
            'base_calculos.biservicodsr',
            'base_calculos.biinss',
            'base_calculos.bifgts',
            'base_calculos.bifgtsmes',
            'base_calculos.biirrf',
            'base_calculos.bifaixairrf',
            'base_calculos.binumfilhos',
            'base_calculos.bitotaldiaria',
            'base_calculos.bivalorliquido',
            'base_calculos.bivalorvencimento',
            'base_calculos.bivalordesconto'   
        )
        ->where(function($query) use ($id){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where([
                    ['folhars.id',$id],
                    ['base_calculos.tomador',null],
                    ['base_calculos.bivalorliquido','>',0]
                ]);
            }else{
                $query->where([
                    ['folhars.id',$id],
                    ['base_calculos.tomador',null],
                    ['base_calculos.bivalorliquido','>',0],
                    ['trabalhadors.empresa', $user->empresa]
                ]);
            }
        })
        ->get();
    }

    public function buscaTrabalhadorUnidade($id,$trabalhador,$tomador = null)
    {
        return DB::table('folhars')
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar')
        ->join('empresas', 'empresas.id', '=', 'folhars.empresa')
        ->join('trabalhadors', 'trabalhadors.id', '=', 'base_calculos.trabalhador')
        ->join('documentos', 'trabalhadors.id', '=', 'documentos.trabalhador')
        ->join('bancarios', 'trabalhadors.id', '=', 'bancarios.trabalhador')
        ->join('categorias', 'trabalhadors.id', '=', 'categorias.trabalhador')
        ->select(
            'folhars.fsinicio', 
            'folhars.fsfinal',
            'empresas.esnome',
            'empresas.escnpj',
            'trabalhadors.tsnome',
            'trabalhadors.tsmatricula',
            'trabalhadors.tscpf',
            'documentos.dspis',
            'categorias.cbo',
            'categorias.cscategoria',
            'bancarios.bsbanco',
            'bancarios.bsagencia',
            'bancarios.bsoperacao',
            'bancarios.bsconta',
            'base_calculos.id',
            'base_calculos.biservico',
            'base_calculos.biservicodsr',
            'base_calculos.biinss',
            'base_calculos.bifgts',
            'base_calculos.bifgtsmes',
            'base_calculos.biirrf',
            'base_calculos.bifaixairrf',
            'base_calculos.binumfilhos',
            'base_calculos.bitotaldiaria',
            'base_calculos.bivalorliquido',
            'base_calculos.bivalorvencimento',
            'base_calculos.bivalordesconto'   
        )
        ->where(function($query) use ($id,$trabalhador,$tomador){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where([
                    ['folhars.id',$id],
                    ['trabalhadors.tsnome',$trabalhador],
                    // ['trabalhadors.empresa', $empresas],
                    ['base_calculos.tomador',$tomador]
                ]);
            }else{
                $query->where([
                    ['folhars.id',$id],
                    ['trabalhadors.tsnome',$trabalhador],
                    ['base_calculos.tomador',$tomador],
                    ['trabalhadors.empresa', $user->empresa]
                ]);
            }
        })
        ->first();
    }

    public function buscaTrabalhadorLista($id,$tomador)
    {
        return DB::table('folhars')
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar')
        ->join('empresas', 'empresas.id', '=', 'folhars.empresa')
        ->join('trabalhadors', 'trabalhadors.id', '=', 'base_calculos.trabalhador')
        ->join('documentos', 'trabalhadors.id', '=', 'documentos.trabalhador')
        ->join('bancarios', 'trabalhadors.id', '=', 'bancarios.trabalhador')
        ->join('categorias', 'trabalhadors.id', '=', 'categorias.trabalhador')
        ->join('nascimentos', 'trabalhadors.id', '=', 'nascimentos.trabalhador')
        ->select(
            'folhars.fsinicio', 
            'folhars.fsfinal',
            'empresas.esnome',
            'empresas.escnpj',
            'trabalhadors.tsnome',
            'trabalhadors.tsmatricula',
            'trabalhadors.tscpf',
            'categorias.cscategoria',
            'documentos.dspis',
            'documentos.dsctps',
            'documentos.dsserie',
            'nascimentos.nsnascimento',
            'categorias.cbo',
            'categorias.csadmissao',
            'categorias.csafastamento',
            'bancarios.bsbanco',
            'bancarios.bsagencia',
            'bancarios.bsoperacao',
            'bancarios.bsconta',
            'base_calculos.id',
            'base_calculos.biservico',
            'base_calculos.biservicodsr',
            'base_calculos.biinss',
            'base_calculos.bifgts',
            'base_calculos.bifgtsmes',
            'base_calculos.biirrf',
            'base_calculos.bifaixairrf',
            'base_calculos.binumfilhos',
            'base_calculos.bitotaldiaria',
            'base_calculos.bivalorliquido',
            'base_calculos.bivalorvencimento',
            'base_calculos.bivalordesconto'   
        )
        ->where(function($query) use ($id,$tomador){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where([
                    ['folhars.id',$id],
                    // ['trabalhadors.tsnome',$trabalhador],
                    // ['trabalhadors.empresa', $empresas],
                    ['base_calculos.tomador',$tomador]
                ]);
            }else{
                $query->where([
                    ['folhars.id',$id],
                    // ['trabalhadors.tsnome',$tomador],
                    ['base_calculos.tomador',$tomador],
                    ['trabalhadors.empresa', $user->empresa]
                ]);
            }
        })
        ->get();
    }
    public function buscaListaBancos($id,$banco,$empresas)
    {
        return DB::table('folhars')
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar')
        ->join('empresas', 'empresas.id', '=', 'folhars.empresa')
        ->join('trabalhadors', 'trabalhadors.id', '=', 'base_calculos.trabalhador')
        ->join('bancarios', 'trabalhadors.id', '=', 'bancarios.trabalhador')
        ->select(
            'folhars.fsinicio', 
            'folhars.fsfinal',
            'empresas.esnome',
            'empresas.escnpj',
            'trabalhadors.tsnome',
            'trabalhadors.tsmatricula',
            'trabalhadors.tscpf',
            'bancarios.bsbanco',
            'bancarios.bsagencia',
            'bancarios.bsoperacao',
            'bancarios.bsconta',
            DB::raw('SUM(base_calculos.bivalorliquido) as bivalorliquido')
        )
        ->groupBy(
            'folhars.fsinicio', 
            'folhars.fsfinal',
            'empresas.esnome',
            'empresas.escnpj',
            'trabalhadors.tsnome',
            'trabalhadors.tsmatricula',
            'trabalhadors.tscpf',
            'bancarios.bsbanco',
            'bancarios.bsagencia',
            'bancarios.bsoperacao',
            'bancarios.bsconta',
        )
        ->where(function($query) use ($id,$banco,$empresas){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where([
                    ['folhars.id',$id],
                    ['bancarios.bsbanco',$banco],
                    ['trabalhadors.empresa', $empresas]
                ]);
            }else{
                $query->where([
                    ['folhars.id',$id],
                    ['bancarios.bsbanco',$banco],
                    ['trabalhadors.empresa', $user->empresa]
                ]);
            }
        })
        ->get();
    }
    public function buscaListaRublica($dados)
    {
        return DB::table('folhars')
        ->join('base_calculos', 'folhars.id', '=', 'base_calculos.folhar')
        ->join('empresas', 'empresas.id', '=', 'folhars.empresa')
        ->join('trabalhadors', 'trabalhadors.id', '=', 'base_calculos.trabalhador')
        ->join('valor_calculos', 'base_calculos.id', '=', 'valor_calculos.basecalculo')
        ->select(
            'folhars.fscodigo',
            'folhars.fsinicio', 
            'folhars.fsfinal',
            'empresas.esnome',
            'empresas.escnpj',
            'trabalhadors.tsnome',
            'trabalhadors.tsmatricula',
            'trabalhadors.tscpf',
            'valor_calculos.vicodigo',
            'valor_calculos.vireferencia',
            'valor_calculos.vsdescricao',
            'valor_calculos.vivencimento'
        )
        ->where(function($query) use ($dados){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                $query->where([
                    ['folhars.id',$dados['folharublica']],
                    ['valor_calculos.vsdescricao',$dados['rublica']],
                    ['base_calculos.tomador',null]
                    // ['trabalhadors.empresa', $dados['empresarublica']]
                ])
                ->whereBetween('folhars.fsfinal',[$dados['inicio'],$dados['final']]);
            }else{
                $query->where([
                    ['folhars.id',$dados['folharublica']],
                    ['valor_calculos.vsdescricao',$dados['rublica']],
                    ['trabalhadors.empresa', $dados['empresarublica']],
                    ['base_calculos.tomador',null]
                ])
                ->whereBetween('folhars.fsfinal',[$dados['inicio'],$dados['final']]);
            }
        })
        ->get();
    }
    public function buscaFolhaAnalitica($id) 
    {
        return DB::table('empresas')
        ->join('folhars', 'empresas.id', '=', 'folhars.empresa')
        ->select('folhars.*','empresas.esnome')
        ->where('folhars.id',$id)
        ->first();
    }
    public function buscaFolhaAnaliticaTomador($id) 
    {
        return DB::table('tomadors')
        ->join('base_calculos', 'tomadors.id', '=', 'base_calculos.tomador')
        ->join('folhars', 'folhars.id', '=', 'base_calculos.folhar')
        ->select('folhars.*','tomadors.tsnome')
        ->where('folhars.id',$id)
        ->first();
    }
    public function deletar($id)
    {
        return Folhar::where('id', $id)->delete();
    }
}
