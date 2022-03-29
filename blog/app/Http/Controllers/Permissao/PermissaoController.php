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
        switch ($condicao) {
            case 'D':
                $this->user->givePermissionTos($id,$permisao);
                break;
            case 'R':
                $this->user->revokePermissionTo($id,$permisao);
                break;
            default:
                # code...
                break;
        }
       
    }
}
