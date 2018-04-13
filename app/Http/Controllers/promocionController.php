<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promocion;
use App\Models\Usuario;
use App\Models\Categorium;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class promocionController extends Controller
{
  public function show(Promocion $promocion){
    //$usuario = App\Models\Usuario::all();
    $usuario = Usuario::all();

    return view('promocion.detalle', ['usuario' => $usuario,
                                      'promocion' => $promocion,
                                      ]);
  }

  public function save(Request $request){
    //$usuario = App\Models\Usuario::all();
    $usuario = Usuario::all();

    $promocion = Promocion::find($request->idpromocion);
    $promocion->promocion_nombre = $request->promocion_nombre;
    $promocion->save();

    $categoria = Categorium::pluck('categoria_nombre', 'idcategoria');
    $listCategoria = $categoria->toArray();

    return view('promocion.detalle', ['usuario' => $usuario,
                                      'promocion' => $promocion,
                                      'categoria' => $listCategoria,]);
  }

  public function new(Request $request){
    //$usuario = App\Models\Usuario::all();
    $usuario = Usuario::all();

    $promocion = new Promocion;
    $promocion->promocion_nombre = "";
    $promocion->promocion_descripcion = "";

    $categoria = Categorium::pluck('categoria_nombre', 'idcategoria');;
    $listCategoria = $categoria->toArray();

    return view('promocion.nuevo', ['usuario' => $usuario,
                                    'promocion' => $promocion,
                                    'categoria' => $listCategoria,]);
  }

  public function newSave(Request $request){
    //$usuario = App\Models\Usuario::all();
      $usuario = Usuario::all();

      $promocion = new Promocion;
      $dataPromocion = Promocion::orderBy('idpromocion', 'desc')->first();

      if (isset($dataPromocion)){
        $promocion->idpromocion = $dataPromocion->idpromocion+1;
      } else {
        $promocion->idpromocion = 1;
      }



      $promocion->promocion_nombre = $request->promocion_nombre;
      $promocion->categoria_idcategoria = $request->promocion_categoria;
      $promocion->promocion_descripcion = $request->promocion_descripcion;
      $promocion->promocion_precio = $request->promocion_precio;

      $promocion->save();

      $promocionsLista = Promocion::all();

      $categoria = Categorium::pluck('categoria_nombre', 'idcategoria');;
      $listCategoria = $categoria->toArray();


      return view('promocion.lista', ['usuario' => $usuario,
                                      'promocion' => $promocionsLista,
                                      'categoria' => $listCategoria,]);
  }

  public function list(Request $request){
    $usuario = Usuario::all();
    $promocion = Promocion::all();

    return view('promocion.lista', ['usuario' => $usuario,
                                      'promocion' => $promocion,]);
  }

  public function delete(Request $request){
    //$usuario = App\Models\Usuario::all();
      $usuario = Usuario::all();

      $promocion = Promocion::find($request->get('id'));
      $promocion->delete();

      $promocionsLista = Promocion::all();


      return view('promocion.lista', ['usuario' => $usuario,
                                      'promocion' => $promocionsLista,]);
  }
}
