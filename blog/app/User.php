<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','usuario','cargo','empresa','remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function login($dados)
    {
        return User::where([
            ['name',$dados['user']],
            ['password',$dados['password']]
            ])
        // ->orWhere('email', $dados['email'])
        ->distinct()
        ->get();
    }
    public function cadastro($dados)
    {
        return User::create([
            'name'=>$dados['name'],
            'email'=>$dados['email'],
            // 'usuario'=>$dados['usuario'],
            'password'=> Hash::make($dados['senha']),
            'cargo'=>$dados['cargo'],
            'empresa'=>$dados['empresa'],
            // 'remember_token'=>$dados['_token'],
        ])->givePermissionTo('user');
    }
    public function buscaUnidadeUser($id)
    {
        return User::where('name', $id)->first();
    }
    public function buscaListaUser($id)
    {
        return User::where(function($query) use ($id){
            $user = auth()->user();
            if ($user->hasPermissionTo('admin')) {
                if ($id) {
                    $query->where('name',$id);
                }else{
                    $query->where('id','>',$id);
                }
            }
        })
        ->orderBy('name', 'asc')
        ->distinct()
        ->limit(100)
        ->get();
    }
    public function editar($dados,$id)
    {
        if ($dados['senha']) {
            return User::where('id', $id)
            ->update([
                'name'=>$dados['name'],
                'email'=>$dados['email'],
                // 'usuario'=>$dados['usuario'],
                'password'=>Hash::make($dados['senha']),
                'cargo'=>$dados['cargo'],
                'empresa'=>$dados['empresa'],
            ]);
        }else{
            return User::where('id', $id)
            ->update([
                'name'=>$dados['name'],
                'email'=>$dados['email'],
                // 'usuario'=>$dados['usuario'],
                'cargo'=>$dados['cargo'],
                'empresa'=>$dados['empresa'],
            ]);
        }
    }
    public function deletar($id)
    {
        return User::where('id', $id)->delete();
    }
    public function deleteempresa($id)
    {
        return User::where('empresa', $id)->delete();
    }

    public function editarSenhar($dados)
    {
        return User::where('id', $dados['id'])
        ->update(['password'=>Hash::make($dados['password1'])]);
    }
    
}
