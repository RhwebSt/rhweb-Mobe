<?php

namespace App\Http\Controllers\Permissao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\User;
class PermissaoController extends Controller
{
    private $user;
    public function __construct()
    {
        $this->user = new User;
    }
    public function permissao($id,$permisao,$condicao)
    {
        $id = base64_decode($id);
        $permisao = base64_decode($permisao);
        $user = $this->user->where('id',$id)->first();
        
        if ($user->hasPermissionTo(Permission::find($permisao)->id)) {
            $permissao = $this->user->revokePermissionTo($id,$permisao);
            if ($permissao) {
                return response()->json('Permissão revogada com sucesso.');
            }else{
                return response()->json('Não foi possível conceder a permissão.');
            }
        }else{
            
            $permissao = $this->user->givePermissionTos($id,$permisao);
            if ($permissao) {
                return response()->json('Permissão concedida com sucesso.');
            }else{
                $user->givePermissionTo(Permission::find($permisao)->name);
                return response()->json('Não foi possível conceder a permissão.');
            }
        }
    }
}
