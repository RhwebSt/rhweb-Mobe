<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Permission\Models\Permission;
class TrabalhadorCadastro
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
        $permissions = Permission::where('name','like','%'.'mtrc'.'%')->first(); 
        // dd($permissions,$request);
        if ($request->hasPermissionTo($permissions->name) === false && $request->hasPermissionTo('admin') === false){
            return redirect()->back()->withInput()->withErrors(['permissaonegada'=>'true']);
        }
        return $next($request);
    }
}
