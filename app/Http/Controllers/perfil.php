<?php

namespace App\Http\Controllers;

use App\Models\perfil as ModelsPerfil;
use Illuminate\Http\Request;

class perfil extends Controller
{
    public function index()
    {
        $perfils = ModelsPerfil::get();

        return compact('perfils');
    }
}
