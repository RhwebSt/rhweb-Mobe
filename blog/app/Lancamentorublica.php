<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Lancamentorublica extends Model
{
    protected $fillable = [
        'lshistorico','lsquantidade','licodigo','trabalhador','lancamento'
    ];
    public function cadastro($dados)
    {
       return Lancamentorublica::create([
            'lshistorico'=>$dados['rubrica'],
            'lsquantidade'=>$dados['quantidade'],
            'licodigo'=>$dados['licodigo'],
            'trabalhador'=>$dados['trabalhador'],
            'lancamento'=>$dados['lancamento'],
        ]);
    }
    public function listacadastro($id)
    {
        return DB::table('trabalhadors')
        ->join('lancamentorublicas', 'trabalhadors.id', '=', 'lancamentorublicas.trabalhador')
        ->join('lancamentotabelas', 'lancamentotabelas.id', '=', 'lancamentorublicas.lancamento')
        ->select(
            'trabalhadors.*', 
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
        // ->join('tomadors', 'tomadors.id', '=', 'lancamentotabelas.tomador')
        ->select(
            'trabalhadors.*', 
            'lancamentorublicas.*', 
            )
            ->where(function($query) use ($id){
                $user = auth()->user();
                if ($user->hasPermissionTo('admin')) {
                    $query->where('trabalhadors.tsnome', 'like', '%'.$id.'%') 
                    ->orWhere('lancamentorublicas.licodigo', 'like', '%'.$id.'%');
                   
                }else{
                    $query->where([
                        ['trabalhadors.tsnome',$id],
                        ['trabalhadors.empresa', $user->empresa]
                    ])
                    ->orWhere([
                        ['lancamentorublicas.licodigo',$id],
                        ['trabalhadors.empresa', $user->empresa],
                    ]);
                }
               
            })
        ->first();
    }
    public function editar($dados,$id)
    {
        return Lancamentorublica::where('id', $id)
        ->update([
            'lshistorico'=>$dados['rubrica'],
            'lsquantidade'=>$dados['quantidade'],
            'licodigo'=>$dados['licodigo'],
            'trabalhador'=>$dados['trabalhador'],
            'lancamento'=>$dados['lancamento'],
        ]);
    }
    public function deletar($id)
    {
      return Lancamentorublica::where('lancamento', $id)->delete();
    }
}
