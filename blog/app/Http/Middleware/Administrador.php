<?php

namespace App\Http\Middleware;

use Closure;

class Administrador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $user = auth()->user();
        // $cargo = [
        //     'admin',
        // ];
        if ( !auth()->check() ){
            return redirect()->route('login.index');
        }
        // if (!in_array($user->cargo,$cargo)) {
        //     return redirect()->route('login.index');
        // }
        return $next($request);
    }
}
