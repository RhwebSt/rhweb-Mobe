<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Lancamentorublica extends Model
{
    protected $fillable = [
        'lshistorico','lfvalor','lftomador','lsquantidade','licodigo','trabalhador','lancamento'
    ];
    public function cadastro($dados)
    {
        // dd($dados);
       return Lancamentorublica::create([
            'lshistorico'=>$dados['rubrica'],
            'lsquantidade'=>$dados['quantidade'],
            'licodigo'=>$dados['codigo'],
            'trabalhador'=>$dados['trabalhador'],
            'lancamento'=>$dados['lancamento'],
            'lfvalor'=>str_replace(",",".",$dados['valor']),
            'lftomador'=>str_replace(",",".",$dados['lftomador'])
        ]);
    }
    public function listacadastro($id)
    {
        return DB::table('trabalhadors')
        ->join('lancamentorublicas', 'trabalhadors.id', '=', 'lancamentorublicas.trabalhador')
        ->join('lancamentotabelas', 'lancamentotabelas.id', '=', 'lancamentorublicas.lancamento')
        ->select(
            'trabalhadors.tsnome', 
            'lancamentorublicas.*', 
            )
        ->where('lancamentotabelas.id', $id)
        ->get();
    }
    public function listafirst($id)
    {
        return DB::table('trabalhadors')
        ->join('lancamentorublicas', 'trabalhadors.id', '=', 'lancamentorublicas.trabalhador')
        ->join('lancamentotabelas', 'lancamentotabelas.id', '=', 'lancamentorublicas.lancamento')
        ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador')
        ->select(
            'trabalhadors.*', 
            'lancamentorublicas.*', 
            )
        ->where(function($query) use ($id){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                // $query->where('trabalhadors.tsnome', 'like', '%'.$id.'%');
                $query->where('lancamentorublicas.licodigo',$id)
                ->orWhere('lancamentorublicas.id',$id);
            }else{
                $query->where([
                    ['lancamentorublicas.licodigo',$id],
                    ['trabalhadors.empresa', $user->empresa]
                ])->orWhere([
                    ['lancamentorublicas.id',$id],
                    ['trabalhadors.empresa', $user->empresa]
                ]);
            }
        })
        ->first();
    }
    public function verifica($dados)
    {
        return Lancamentorublica::where([
            ['licodigo', '=', $dados['codigo']],
            ['licodigo', '=', $dados['trabalhador']],
        ])->count();
    }

    public function editar($dados,$id)
    {
        return Lancamentorublica::where('id', $id)
        ->update([
            'lshistorico'=>$dados['rubrica'],
            'lsquantidade'=>$dados['quantidade'],
            'licodigo'=>$dados['codigo'],
            'trabalhador'=>$dados['trabalhador'],
            'lancamento'=>$dados['lancamento'],
            'lfvalor'=>str_replace(",",".",$dados['valor']),
            'lftomador'=>str_replace(",",".",$dados['lftomador'])
        ]);
    }
    public function deletar($id)
    {
      return Lancamentorublica::where('id', $id)->orWhere('lancamento', $id)->delete();
    }
}
