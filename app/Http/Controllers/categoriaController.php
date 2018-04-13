<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorium;
use App\Models\Usuario;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
  public function show(Categorium $categoria){
    //$usuario = App\Models\Usuario::all();
    $usuario = Usuario::all();

    return view('categoria.detalle', ['usuario' => $usuario,
                                      'categoria' => $categoria,]);
  }

  public function save(Request $request){
    //$usuario = App\Models\Usuario::all();
    $usuario = Usuario::all();

    $categorium = Categorium::find($request->idcategoria);
    $categorium->categoria_nombre = $request->categoria_nombre;
    $categorium->save();



    return view('categoria.detalle', ['usuario' => $usuario,
                                      'categoria' => $categorium,]);
  }

  public function new(Request $request){
    //$usuario = App\Models\Usuario::all();
    $usuario = Usuario::all();

    $categorium = new Categorium;
    $categorium->categoria_nombre = "";
    $categorium->categoria_descripcion = "";

    return view('categoria.nuevo', ['usuario' => $usuario,
                                      'categoria' => $categorium,]);
  }

  public function newSave(Request $request){
    //$usuario = App\Models\Usuario::all();
      $usuario = Usuario::all();

      $categorium = new Categorium;
      $datacategorium = Categorium::orderBy('idcategoria', 'desc')->first();

      if (isset($datacategorium)){
        $categorium->idcategoria = $datacategorium->idcategoria+1;
      } else {
        $categorium->idcategoria = 1;
      }

      $categorium->categoria_nombre = $request->categoria_nombre;
      $categorium->save();

      $categoriumsLista = Categorium::all();


      return view('categoria.lista', ['usuario' => $usuario,
                                      'categoria' => $categoriumsLista,]);
  }

  public function list(Request $request){
    $usuario = Usuario::all();
    $categorium = Categorium::all();

    return view('categoria.lista', ['usuario' => $usuario,
                                      'categoria' => $categorium,]);
  }

  public function delete(Request $request){
    //$usuario = App\Models\Usuario::all();
      $usuario = Usuario::all();

      $categorium = Categorium::find($request->get('id'));
      $categorium->delete();

      $categoriumsLista = Categorium::all();


      return view('categoria.lista', ['usuario' => $usuario,
                                      'categoria' => $categoriumsLista,]);
  }
}
