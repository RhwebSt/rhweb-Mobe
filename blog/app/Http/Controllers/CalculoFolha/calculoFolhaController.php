<?php

namespace App\Http\Controllers\CalculoFolha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class calculoFolhaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('calculofolha.index',compact('user'));
    }
    public function store(Request $request)
    {
        $dados = $request->all();
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
