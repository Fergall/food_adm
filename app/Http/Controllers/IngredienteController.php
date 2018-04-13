<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingrediente;
use App\Models\Usuario;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class IngredienteController extends Controller
{
  public function show(Ingrediente $ingrediente){
    //$usuario = App\Models\Usuario::all();
    $usuario = Usuario::all();

    return view('ingrediente.detalle', ['usuario' => $usuario,
                                      'ingrediente' => $ingrediente,]);
  }

  public function save(Request $request){
    //$usuario = App\Models\Usuario::all();
    $usuario = Usuario::all();

    $ingrediente = Ingrediente::find($request->idingrediente);
    $ingrediente->ingrediente_nombre = $request->ingrediente_nombre;
    $ingrediente->ingrediente_descripcion = $request->ingrediente_descripcion;
    $ingrediente->save();



    return view('ingrediente.detalle', ['usuario' => $usuario,
                                      'ingrediente' => $ingrediente,]);
  }

  public function new(Request $request){
    //$usuario = App\Models\Usuario::all();
    $usuario = Usuario::all();

    $ingrediente = new Ingrediente;
    $ingrediente->ingrediente_nombre = "";
    $ingrediente->ingrediente_descripcion = "";

    return view('ingrediente.nuevo', ['usuario' => $usuario,
                                      'ingrediente' => $ingrediente,]);
  }

  public function newSave(Request $request){
    //$usuario = App\Models\Usuario::all();
      $usuario = Usuario::all();

      $ingrediente = new Ingrediente;
      $dataIngrediente = Ingrediente::orderBy('idingrediente', 'desc')->first();

      if (isset($dataIngrediente)){
        $ingrediente->idingrediente = $dataIngrediente->idingrediente+1;
      } else {
        $ingrediente->idingrediente = 1;
      }

      $ingrediente->ingrediente_nombre = $request->ingrediente_nombre;
      $ingrediente->ingrediente_descripcion = $request->ingrediente_descripcion;
      $ingrediente->save();

      $ingredientesLista = Ingrediente::all();


      return view('ingrediente.lista', ['usuario' => $usuario,
                                      'ingrediente' => $ingredientesLista,]);
  }

  public function list(Request $request){
    $usuario = Usuario::all();
    $ingrediente = Ingrediente::all();

    return view('ingrediente.lista', ['usuario' => $usuario,
                                      'ingrediente' => $ingrediente,]);
  }

  public function delete(Request $request){
    //$usuario = App\Models\Usuario::all();
      $usuario = Usuario::all();

      $ingrediente = Ingrediente::find($request->get('id'));
      $ingrediente->delete();

      $ingredientesLista = Ingrediente::all();


      return view('ingrediente.lista', ['usuario' => $usuario,
                                      'ingrediente' => $ingredientesLista,]);
  }

}
