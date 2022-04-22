<?php

namespace App\Http\Controllers\Permissao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        
        switch ($condicao) {
            case 'D':
                    $permissao = $this->user->givePermissionTos($id,$permisao);
                    if ($permissao) {
                        return redirect()->back()->withSuccess('Permissão consedida com sucesso.');
                    }else{
                        return redirect()->back()->withSuccess('Não foi porssivél consedida permissão.');
                    }
                break;
            case 'R':
                    $permissao = $this->user->revokePermissionTo($id,$permisao);
                    if ($permissao) {
                        return redirect()->back()->withSuccess('Permissão revogada com sucesso.');
                    }else{
                        return redirect()->back()->withSuccess('Não foi porssivél revogada permissão.');
                    }
                break;
            default:
                # code...
                break;
        }
       
    }
}
