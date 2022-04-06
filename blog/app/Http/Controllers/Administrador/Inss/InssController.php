<?php

namespace App\Http\Controllers\Administrador\Inss;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Inss;
class InssController extends Controller
{
    private $inss;
    public function __construct()
    {
        $this->inss = new Inss;
    }
    public function index()
    {
        $user = Auth::user();
        $inss = $this->inss->buscaListaInss(null);
        return view('administrador.inss.index',compact('inss')); 
    }
    public function ordem($ano = null)
    {
        $inss = $this->inss->buscaListaInss($ano);
        return view('administrador.inss.index',compact('inss'));
       
    }
    
    public function create()
    {
        return view('administrador.inss.criar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all();
        $request->validate([
            'isano'=>'required|max:5|unique:insses',
        ],[
            'isano.unique'=>'Este ano já está cadastrado.'
        ]);
        $contador = 1;
        $novodados = [
            'ano'=>'',
            'valor__inicial'=>'',
            'valor__final'=>'',
            'indice'=>'',
            'fator'=>'',
            'user'=>''
        ];
        $inss = new Inss;
        try {
        foreach ($dados as $key => $value) {
            if ($key === 'user') {
                $novodados['user'] = $value;
            }
            if ($key === 'isano') {
                $novodados['ano'] = $value;
            }
            
            if ($contador == 5) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 6) {
                $novodados['indice'] = $value;
            }elseif ($contador == 7) {
                $novodados['fator'] = $value;
                $inss->cadastro($novodados);
            }
            elseif ($contador == 8) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 9) {
                $novodados['indice'] = $value;
            }elseif ($contador == 10) {
                $novodados['fator'] = $value;
                $inss->cadastro($novodados);
            }
            elseif ($contador == 11) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 12) {
                $novodados['indice'] = $value;
            }elseif ($contador == 13) {
                $novodados['fator'] = $value;
                $inss->cadastro($novodados);
            }
            elseif ($contador == 14) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 15) {
                $novodados['indice'] = $value;
            }elseif ($contador == 16) {
                $novodados['fator'] = $value;
                $inss->cadastro($novodados);
               
            }
            elseif ($contador == 17) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 18) {
                $novodados['indice'] = $value;
            }elseif ($contador == 19) {
                $novodados['fator'] = $value;
                $inss->cadastro($novodados);
               
            }
            $contador++;
        }
        
            return redirect()->back()->withSuccess('Cadastro realizado com sucesso.'); 
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível cadastrar.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inss = new Inss;
        $in = $inss->buscaUnidadeInss($id);
        return response()->json($in);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inss = $this->inss->buscaUnidadeInss($id);
        return view('administrador.inss.editar',compact('inss','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dados = $request->all();
        // dd($dados);
        $request->validate([
            'isano'=>'required|max:5',
        ]);
        $contador = 0;
        $novodados = [
            'ano'=>'',
            'valor__inicial'=>'',
            'valor__final'=>'',
            'indice'=>'',
            'fator'=>'',
        ];
        $inss = new Inss;
        try {
        foreach ($dados as $key => $value) {
           
            if ($key === 'isano') {
                $novodados['ano'] = $value;
            }
           if ($contador == 3) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 4) {
                $novodados['indice'] = $value;
            }elseif ($contador == 5) {
                $novodados['fator'] = $value;
                $inss->edita($novodados,$dados['id01']);
            }
            elseif ($contador == 6) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 7) {
                $novodados['indice'] = $value;
            }elseif ($contador == 8) {
                $novodados['fator'] = $value;
                $inss->edita($novodados,$dados['id02']);
            }
            elseif ($contador == 9) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 10) {
                $novodados['indice'] = $value;
            }elseif ($contador == 11) {
                $novodados['fator'] = $value;
                $inss->edita($novodados,$dados['id03']);
            }
            elseif ($contador == 12) {
                $novodados['valor__final'] = $value;
            }elseif ($contador == 13) {
                $novodados['indice'] = $value;
            }elseif ($contador == 14) {
                $novodados['fator'] = $value;
                $inss->edita($novodados,$dados['id04']);
               
            }
            // elseif ($contador == 15) {
            //     $novodados['valor__final'] = $value;
            // }elseif ($contador == 16) {
            //     $novodados['indice'] = $value;
            // }elseif ($contador == 17) {
            //     $novodados['fator'] = $value;
            //     $inss->edita($novodados,$dados['id05']);
               
            // }
            $contador++;
            
        }
        
        return redirect()->back()->withSuccess('Atualizador com sucesso.'); 
       } catch (\Throwable $th) {
        return redirect()->back()->withInput()->withErrors(['false'=>'Não foi porssível realizar a atualização.']);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inss = new Inss;
        try {
            $inss->deletar($id);
            return redirect()->back()->withSuccess('Deletado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['false'=>'Não foi possível deletar o registro.']);
        }
    }
}
