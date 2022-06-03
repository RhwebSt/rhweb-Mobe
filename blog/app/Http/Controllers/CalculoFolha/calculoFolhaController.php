<?php

namespace App\Http\Controllers\CalculoFolha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use App\Folhar;
use App\BaseCalculo;
class calculoFolhaController extends Controller
{
    private $folhar,$basecalculo;
    public function __construct()
    {
        $this->folhar = new Folhar;
        $this->basecalculo = new BaseCalculo;
    }
    public function index()
    {
        $user = Auth::user();
        $idfolhas = [];
        $folhas = $this->folhar->buscaListaFolhar($user->empresa_id);
        foreach ($folhas as $key => $folha) {
            array_push($idfolhas,$folha->id);
        }
        $trabalhadores = $this->basecalculo->listaTrabalhador($idfolhas);
        $tomadores = $this->basecalculo->listaTomador($idfolhas,'asc');
        // dd($tomadores,$trabalhadores);
        return view('calculofolha.index',compact('user','folhas','trabalhadores','tomadores'));
    }
    public function store(Request $request)
    {
        $dados = $request->all();
        $user = auth()->user();
        $permissions = Permission::where('name','like','%'.'mcfc'.'%')->first(); 
        if ($user->hasPermissionTo($permissions->name) === false && $user->hasPermissionTo('admin') === false){
            return redirect()->back()->withInput()->withErrors(['permissaonegada'=>'true']);
        }
        $request->validate([
            'ano_inicial'=>'required|max:10',
            'ano_final'=>'required|max:10',
            'competencia'=>'required|max:10'
        ]);
        $dados = $request->only('ano_inicial','ano_final','competencia');
        return redirect()->route('calculo.folha.geral',$dados);
    }
    public function filtroPesquisaTomador(Request $request)
    {
        $user = Auth::user();
        $idfolhas = [];
        $dados = $request->all();
        $dados['inicio'] = $dados['competencia'].'-01';
        $dados['final'] = $dados['competencia'].'-31';
        $folhas = $this->folhar->filtraListaTomador($dados,$user->empresa_id);
        foreach ($folhas as $key => $folha) {
            array_push($idfolhas,$folha->id);
        }
        $trabalhadores = $this->basecalculo->listaTrabalhador($idfolhas);
        $tomadores = $this->basecalculo->listaTomador($idfolhas,'asc');
        return view('calculofolha.index',compact('user','folhas','trabalhadores','tomadores'));
        
    }
    public function filtroPesquisaGeral(Request $request)
    {
        $user = Auth::user();
        $idfolhas = [];
        $dados = $request->all();
        $dados['inicio'] = $dados['competencia'].'-01';
        $dados['final'] = $dados['competencia'].'-31';
        $folhas = $this->folhar->filtraListaGeral($dados,$user->empresa_id);
        
        foreach ($folhas as $key => $folha) {
            array_push($idfolhas,$folha->id);
        }
        $trabalhadores = $this->basecalculo->listaTrabalhador($idfolhas);
        $tomadores = $this->basecalculo->listaTomador($idfolhas,'asc');
        return view('calculofolha.index',compact('user','folhas','trabalhadores','tomadores'));
        
    }
    

    public function filtroPesquisaOrdem($condicao)
    {
        $user = Auth::user();
        $idfolhas = [];
        $folhas = $this->folhar->buscaListaOrdem($user->empresa_id,$condicao);
        
        foreach ($folhas as $key => $folha) {
            array_push($idfolhas,$folha->id);
        }
        $trabalhadores = $this->basecalculo->listaTrabalhador($idfolhas);
        $tomadores = $this->basecalculo->listaTomador($idfolhas,$condicao);
        return view('calculofolha.index',compact('user','folhas','trabalhadores','tomadores'));
    }
}
