<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Session;

class IdiomaController extends Controller
{
    public function trocaIdioma($idioma){
        App::setLocale($idioma);
        Session::put('idioma', $idioma);
        return view("welcome");
    }
}
