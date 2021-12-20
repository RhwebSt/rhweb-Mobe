<?php

namespace App\Http\Controllers\Sevidor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErrosSevidorController extends Controller
{
    public function index($id)
    {
        return view('error',compact('id'));
    }
}
