<?php

namespace App\Http\Controllers\CalculoFolha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Folhar;
class calculoFolhaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $folhar = new Folhar;
        $folhas = $folhar->buscaListaFolhar($user->empresa);
        return view('calculofolha.index',compact('user','folhas'));
    }
    public function store(Request $request)
    {
        $dados = $request->all();
        $request->validate([
            'ano_inicial'=>'required|max:10',
            'ano_final'=>'required|max:10'
        ]);
        $dados = $request->only('ano_inicial','ano_final');
        return redirect()->route('calculo.folha.geral',$dados);
        // dd($dados);
        // if (isset($dados['todostrabalhador']) && isset($dados['umtomador'])) {
        //     $dados = $request->only('trabalhador','tomador','ano_inicial','ano_final');
        //     return redirect()->route('calculo.folha.tomador',$dados);
        // }
        // if (isset($dados['umtrabalhador']) && isset($dados['todostomador'])) {
        //     $dados = $request->only('trabalhador','tomador','ano_inicial','ano_final');
        //     return redirect()->route('calculo.folha.trabalhador',$dados);
        // }
    }
    
}
