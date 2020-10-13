<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class IdiomaController extends Controller
{
    public function trocaIdioma($idioma){
        App::setLocale($idioma);
        return view("welcome");
    }
}
