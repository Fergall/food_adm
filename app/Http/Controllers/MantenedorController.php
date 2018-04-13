<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MantenedorController extends Controller
{
    //
    public function show(){
      $usuario = App\Models\Usuario::all();
      $ingrediente = App\Models\Ingrediente::all();


      return view('ingrediente/lista', ['usuario' => $usuario,
                                        'ingrediente' => $ingrediente,]);
    }
}
