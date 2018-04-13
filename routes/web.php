<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;



Route::get('/', function () {
  $usuario = App\Models\Usuario::all();

  return view('welcome', ['usuario' => $usuario]);
});

//Rutas de ingredientes

Route::get('/listaIngrediente', 'IngredienteController@list');

Route::get('/ingrediente/{ingrediente}', 'IngredienteController@show');

Route::post('/ingrediente/{ingrediente}', 'IngredienteController@save');

Route::get('/ingredienteNew', 'IngredienteController@new');

Route::post('/ingredienteNew', 'IngredienteController@newSave');

Route::post('/ingredienteDelete',
    [ 'as' => 'ingredienteDelete',
      'uses' => 'IngredienteController@delete'
    ]);

//Rutas de Categorias

Route::get('/listaCategoria', 'categoriaController@list');

Route::get('/categoria/{categoria}', 'categoriaController@show');

Route::post('/categoria/{categoria}', 'categoriaController@save');

Route::get('/categoriaNew', 'categoriaController@new');

Route::post('/categoriaNew', 'categoriaController@newSave');

Route::post('/categoriaDelete',
    [ 'as' => 'categoriaDelete',
      'uses' => 'categoriaController@delete'
    ]);

//Rutas de Productos
Route::get('/listaProducto', 'productoController@list');

Route::get('/producto/{producto}', 'productoController@show');

Route::post('/producto/{producto}', 'productoController@save');

Route::get('/productoNew', 'productoController@new');

Route::post('/productoNew', 'productoController@newSave');

Route::post('/productoDelete',
    [ 'as' => 'productoDelete',
      'uses' => 'productoController@delete'
    ]);

//Rutas de Promociones
Route::get('/listaPromocion', 'promocionController@list');

Route::get('/promocion/{promocion}', 'promocionController@show');

Route::post('/promocion/{promocion}', 'promocionController@save');

Route::get('/promocionNew', 'promocionController@new');

Route::post('/promocionNew', 'promocionController@newSave');

Route::post('/promocionDelete',
    [ 'as' => 'promocionDelete',
      'uses' => 'promocionController@delete'
    ]);

//Ruta de pedido

Route::get('/nuevoPedido', 'pedidoController@index');

Route::post('/finPedido', 'pedidoController@save');

Route::post('/pedidoPDF', 'pedidoController@crearPDF');

Route::get('/listaPedidos', 'pedidoController@list');

Route::post('/listaPedidos', 'pedidoController@filter');

Route::get('/detallePedido/{detallePedido}', 'pedidoController@show');

Route::post('/listaPedidos/excel', 'pedidoController@getBladeExcel');

Route::post('/listaPedidos/pdf', 'pedidoController@getBladePdf');

Route::post('/marcarPedido', 'pedidoController@marcar');


//Ruta de login y registro




Route::get('/listaMantenedores', function () {
  $usuario = App\Models\Usuario::all();
  return view('listaMantenedor', ['usuario' => $usuario]);
});

Route::get('/listaPedido', function () {
  $usuario = App\Models\Usuario::all();
  $categoria = App\Models\Categorium::all();
  $producto = App\Models\Producto::all();
  $promocion = App\Models\Promocion::all();
  $mediopago = App\Models\MedioPago::all();

  return view('pedido.finpedido', ['usuario' => $usuario,
                          'categoria' => $categoria,
                          'producto' => $producto,
                          'promocion' => $promocion,
                          'mediopago' => $mediopago,]);
});



Route::get('/submit', function () {
    return view('submit');
});

Route::post('/submit', function (Request $request) {
    $data = $request->validate([
        'usuario' => 'required|max:255',
        'nombre' => 'required|max:255',
        'pass' => 'required|max:255',
    ]);

    $link = tap(new App\Models\Usuario($data))->save();

    return redirect('/');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
