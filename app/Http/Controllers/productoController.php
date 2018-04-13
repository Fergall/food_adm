<?php

namespace App\Http\Controllers;
use App\Models\Categorium;
use App\Models\Usuario;
use App\Models\Producto;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
  public function show(Producto $producto){
    //$usuario = App\Models\Usuario::all();
    $usuario = Usuario::all();

    $categoria = Categorium::pluck('categoria_nombre', 'idcategoria');
    $listCategoria = $categoria->toArray();

    return view('producto.detalle', ['usuario' => $usuario,
                                      'producto' => $producto,
                                      'categoria' => $listCategoria,]);
  }

  public function save(Request $request){
    //$usuario = App\Models\Usuario::all();
    $usuario = Usuario::all();

    $Producto = Producto::find($request->idproducto);
    $Producto->producto_nombre = $request->producto_nombre;
    $Producto->producto_precio = $request->producto_precio;
    $Producto->categoria_idcategoria = $request->producto_categoria;
    $Producto->save();

    $categoria = Categorium::pluck('categoria_nombre', 'idcategoria');;
    $listCategoria = $categoria->toArray();


    return view('producto.detalle', ['usuario' => $usuario,
                                      'producto' => $Producto,
                                      'categoria' => $listCategoria,]);
  }

  public function new(Request $request){
    //$usuario = App\Models\Usuario::all();
    $usuario = Usuario::all();

    $Producto = new Producto;
    $Producto->producto_nombre = "";
    $Producto->producto_descripcion = "";

    $categoria = Categorium::pluck('categoria_nombre', 'idcategoria');;
    $listCategoria = $categoria->toArray();


    return view('producto.nuevo', ['usuario' => $usuario,
                                      'producto' => $Producto,
                                      'categoria' => $listCategoria,]);
  }

  public function newSave(Request $request){
    //$usuario = App\Models\Usuario::all();
      $usuario = Usuario::all();

      $Producto = new Producto;
      $dataProducto = Producto::orderBy('idproducto', 'desc')->first();


      if (isset($dataProducto)){
        $Producto->idproducto = $dataProducto->idproducto+1;
      } else {
        $Producto->idproducto = 1;
      }

      $Producto->producto_nombre = $request->producto_nombre;
      $Producto->producto_precio = $request->producto_precio;
      $Producto->producto_descripcion = $request->producto_descripcion;
      $Producto->categoria_idcategoria = $request->producto_categoria;
      $Producto->save();

      $categoria = Categorium::pluck('categoria_nombre', 'idcategoria');;
      $listCategoria = $categoria->toArray();

      $ProductosLista = Producto::all();


      return view('producto.lista', ['usuario' => $usuario,
                                      'producto' => $ProductosLista,]);
  }

  public function list(Request $request){
    $usuario = Usuario::all();
    $Producto = Producto::all();

    return view('producto.lista', ['usuario' => $usuario,
                                      'producto' => $Producto,]);
  }

  public function delete(Request $request){
    //$usuario = App\Models\Usuario::all();
      $usuario = Usuario::all();

      $Producto = Producto::find($request->get('id'));
      $Producto->delete();

      $ProductosLista = Producto::all();


      return view('producto.lista', ['usuario' => $usuario,
                                      'producto' => $ProductosLista,]);
  }
}
