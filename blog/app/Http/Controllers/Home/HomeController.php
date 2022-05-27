<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Esocial;
use App\Trabalhador;
class HomeController extends Controller
{
    private $esocial,$trabalhador;
    public function __construct()
    {
        $this->esocial = new Esocial;
        $this->trabalhador = new Trabalhador;
    }
    public function index()
    {
        // dd(Hash::make('mbcpc15555738'),Hash::make('mbcpd15555738'),Hash::make('mbcpe15555738'),Hash::make('mbcpl15555738'),Hash::make('mbcpr15555738'));
       
        if (auth()->check()){
            $user = Auth::user();   
            if ($user->hasPermissionTo('Super Admin')) {
                return redirect()->route('administrador');
            }else{
                $esocialtrabalhador = $this->trabalhador->with('esocial.trabalhador')->get();
                return view('login.home',compact('user','esocialtrabalhador')); 
            }
        }
        return view('index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
