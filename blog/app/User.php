<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','usuario','cargo','remember_token'
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
            'name'=>$dados['nome'],
            'email'=>$dados['email'],
            'usuario'=>$dados['usuario'],
            'password'=> Hash::make($dados['senha']),
            'cargo'=>$dados['cargo'],
            'remember_token'=>$dados['_token'],
        ]);
    }
}
