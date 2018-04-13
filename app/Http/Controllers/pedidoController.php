<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Promocion;
use App\Models\Usuario;
use App\Models\Categorium;
use App\Models\Producto;
use App\Models\Ingrediente;
use App\Models\MedioPago;
use App\Models\DetallePedido;
use App\Models\RelProdDetalle;
use App\Models\RelPromDetalle;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Excel;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class pedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //primero necesito todas las categorias como array
        //$categoria = Categorium::pluck('categoria_nombre', 'idcategoria');
        $usuario = Usuario::all();
        $categoria = Categorium::All();
        $mediopago = MedioPago::All();

        $listCategoria = $categoria->toArray();

        $arrayProductos = array();

        $promocion = Promocion::all();

        foreach ($listCategoria as $key => $value) {
          $producto = Producto::Where('categoria_idcategoria', $value['idcategoria'])->get();
          $listProducto = $producto;
          $arrayProductos[] = $listProducto;
        }


        return view('pedido.newPedido', ['usuario' => $usuario,
                                        'categoria' => $categoria,
                                        'mediopago' => $mediopago,
                                        'productos' => $arrayProductos,
                                        'promocion' => $promocion,
                                        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        //

        $usuario = Usuario::all();
        $detalle = new DetallePedido;
        $dataDetalle = DetallePedido::orderBy('iddetalle_pedido','desc')->first();

        if (isset($dataDetalle)){
          $detalle->iddetalle_pedido = $dataDetalle->iddetalle_pedido+1;
        } else {
          $detalle->iddetalle_pedido = 1;
        }

        $detalle->detalle_pedido_numero = $detalle->iddetalle_pedido;

        $hora = Carbon::now();
        $hora->timezone = 'America/Santiago';
        $detalle->detalle_pedido_hora_pedido = $hora->toDateTimeString();
        $detalle->detalle_pedido_hora_entrega = $hora->addMinutes($request->tiempo_espera)->toDateTimeString();
        $detalle->detalle_pedido_nombre =$request->cliente_nombre;
        $detalle->detalle_pedido_direccion = $request->domicilio;
        $detalle->detalle_pedido_domicilio = $request->tipo_entrega;
        $detalle->detalle_pedido_entregado = $request->entregado;
        $detalle->detalle_pedido_total = $request->total_monto;
        $detalle->detalle_pedido_fono = $request->fono;
        $detalle->detalle_pedido_descripcion = $request->observacion;
        $detalle->medio_pago_idmedio_pago = $request->medio_pago;
        $detalle->detalle_pedido_pagado = $request->pagado;


        $detalle->usuario_idusuario = Auth::user()->id;

        $detalle->save();

        $ArrayPedido = json_decode($request->items);
        foreach ($ArrayPedido as $key => $value) {
            if (strpos($key, 'prod') !== false) {
                $producto = new RelProdDetalle;
                $dataProd = RelProdDetalle::orderBy('idrel_prod_detalle','desc')->first();

                if (isset($dataProd)){
                  $producto->idrel_prod_detalle = $dataProd->idrel_prod_detalle+1;
                } else {
                  $producto->idrel_prod_detalle = 1;
                }

                $producto->producto_idproducto = substr($key, 4);
                $producto->cant_prod_detalle = $value;
                $producto->detalle_pedido_iddetalle_pedido = $detalle->iddetalle_pedido;
                $producto->save();
            }

            if (strpos($key, 'prom') !== false) {
              $promocion = new RelpromDetalle;
              $dataprom = RelpromDetalle::orderBy('idrel_prom_detalle','desc')->first();

              if (isset($dataprom)){
                $promocion->idrel_prom_detalle = $dataprom->idrel_prom_detalle+1;
              } else {
                $promocion->idrel_prom_detalle = 1;
              }

              $promocion->promocion_idpromocion = substr($key, 4);
              $promocion->cant_prom_detalle = $value;
              $promocion->detalle_pedido_iddetalle_pedido = $detalle->iddetalle_pedido;
              $promocion->save();
            }


        }

        $listaProductos = DB::table('producto')
            ->join('rel_prod_detalle', 'producto.idproducto', '=', 'rel_prod_detalle.producto_idproducto')
            ->where('detalle_pedido_iddetalle_pedido', '=', $detalle->iddetalle_pedido)
            ->select('*')
            ->get();

        $listaPromociones = DB::table('promocion')
            ->join('rel_prom_detalle', 'promocion.idpromocion', '=', 'rel_prom_detalle.promocion_idpromocion')
            ->where('detalle_pedido_iddetalle_pedido', '=', $detalle->iddetalle_pedido)
            ->select('*')
            ->get();



        $mediopago = MedioPago::Where('idmedio_pago', $detalle->medio_pago_idmedio_pago)->first();

        $namePedido = Auth::user()->name;

        $view = view('pedido.finPedido', ['usuario' => $usuario,
                                        'detalle' => $detalle,
                                        'mediopago' => $mediopago,
                                        'productos' => $listaProductos,
                                        'promocion' => $listaPromociones,
                                        'nameUsuario' => $namePedido,
                                        ])->render();

        return $view;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DetallePedido $detallePedido)
    {
        //
        $usuario = Usuario::all();

        $listaProductos = DB::table('producto')
            ->join('rel_prod_detalle', 'producto.idproducto', '=', 'rel_prod_detalle.producto_idproducto')
            ->where('detalle_pedido_iddetalle_pedido', '=', $detallePedido->iddetalle_pedido)
            ->select('*')
            ->get();

        $listaPromociones = DB::table('promocion')
            ->join('rel_prom_detalle', 'promocion.idpromocion', '=', 'rel_prom_detalle.promocion_idpromocion')
            ->where('detalle_pedido_iddetalle_pedido', '=', $detallePedido->iddetalle_pedido)
            ->select('*')
            ->get();

        $mediopago = MedioPago::Where('idmedio_pago', $detallePedido->medio_pago_idmedio_pago)->first();

        $username = User::Where('id', $detallePedido->usuario_idusuario)->first();

        return view('pedido.detalle', ['usuario' => $usuario,
                                        'detalle' => $detallePedido,
                                        'mediopago' => $mediopago,
                                        'productos' => $listaProductos,
                                        'promocion' => $listaPromociones,
                                        'user' => $username,
                                        ]);
    }

    public function list(Request $request){
      $usuario = Usuario::all();
      //$listaPedidos = DetallePedido::all()->sortByDesc('iddetalle_pedido');

        $fechaInicio = Carbon::now();
        $fechaInicio->timezone = 'America/Santiago';
        $fechaInicio->setTime(0, 0, 1);


        $fechaFin = Carbon::now();
        $fechaFin->timezone = 'America/Santiago';
        $fechaFin->setTime(23, 59, 59);


      $listaPedidos = DB::table('detalle_pedido')
          ->whereBetween('detalle_pedido_hora_pedido', array($fechaInicio, $fechaFin))
          ->join('users', 'detalle_pedido.usuario_idusuario', '=', 'users.id')
          ->orderBy('iddetalle_pedido', 'desc')
          ->select('*')
          ->get();

      foreach ($listaPedidos as $lista) {
          $lista->detalle_pedido_hora_pedido = Carbon::parse($lista->detalle_pedido_hora_pedido);
          $lista->detalle_pedido_hora_entrega = Carbon::parse($lista->detalle_pedido_hora_entrega);

      }


      return view('pedido.lista', ['usuario' => $usuario,
                                   'pedidos' => $listaPedidos,
                                   'fechaInicio' => $fechaInicio,
                                   'fechaFin' => $fechaFin,]);
    }


    public function filter(Request $request){
      $usuario = Usuario::all();

      if (isset($request->dateInicio)){
        $fechaInicio = Carbon::createFromFormat('d/m/Y', $request->dateInicio);

        $fechaInicio->setTime(0, 0, 0);
      } else {
        $fechaInicio = Carbon::now();

        $fechaInicio->setTime(0, 0, 0);
      }

      if (isset($request->dateFin)){
        $fechaFin = Carbon::createFromFormat('d/m/Y', $request->dateFin);

        $fechaFin->setTime(23, 59, 59);
      } else {
        $fechaFin = Carbon::now();

        $fechaFin->setTime(23, 59, 59);
      }
      //$detalle->detalle_pedido_hora_pedido = $hora->toDateTimeString();


      $listaPedidos = DB::table('detalle_pedido')
          ->whereBetween('detalle_pedido_hora_pedido', array($fechaInicio, $fechaFin))
          ->join('users', 'detalle_pedido.usuario_idusuario', '=', 'users.id')
          ->orderBy('iddetalle_pedido', 'desc')
          ->select('*')
          ->get();


      foreach ($listaPedidos as $lista) {
          $lista->detalle_pedido_hora_pedido = Carbon::parse($lista->detalle_pedido_hora_pedido);
          $lista->detalle_pedido_hora_entrega = Carbon::parse($lista->detalle_pedido_hora_entrega);

      }


      return view('pedido.lista', ['usuario' => $usuario,
                                   'pedidos' => $listaPedidos,
                                   'fechaInicio' => $fechaInicio,
                                   'fechaFin' => $fechaFin,]);
    }


    public function getBladeExcel(Request $request){

      if (isset($request->dateInicioExcel)){
        $fechaInicio = Carbon::createFromFormat('d/m/Y', $request->dateInicioExcel);

        $fechaInicio->setTime(0, 0, 0);
      } else {
        $fechaInicio = Carbon::now();

        $fechaInicio->setTime(0, 0, 0);
      }

      if (isset($request->dateFinExcel)){
        $fechaFin = Carbon::createFromFormat('d/m/Y', $request->dateFinExcel);

        $fechaFin->setTime(23, 59, 59);
      } else {
        $fechaFin = Carbon::now();

        $fechaFin->setTime(23, 59, 59);
      }
      //$detalle->detalle_pedido_hora_pedido = $hora->toDateTimeString();


      $listaPedidos = DB::table('detalle_pedido')
          ->whereBetween('detalle_pedido_hora_pedido', array($fechaInicio, $fechaFin))
          ->join('users', 'detalle_pedido.usuario_idusuario', '=', 'users.id')
          ->join('medio_pago', 'medio_pago.idmedio_pago', '=', 'detalle_pedido.medio_pago_idmedio_pago')
          ->orderBy('iddetalle_pedido', 'desc')
          ->select('*')
          ->get();

      foreach ($listaPedidos as $lista) {
          $lista->detalle_pedido_hora_pedido = Carbon::parse($lista->detalle_pedido_hora_pedido);
          $lista->detalle_pedido_hora_entrega = Carbon::parse($lista->detalle_pedido_hora_entrega);

      }


      \Excel::create('listado-de-pedidos', function($excel) use($listaPedidos, $fechaFin, $fechaInicio) {

          $excel->sheet('Hoja1', function($sheet) use($listaPedidos, $fechaFin, $fechaInicio) {

              $sheet->loadView('pedido.excel-pedidos', array('pedidos' => $listaPedidos,'fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin));

          });

        })->download('xls');
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getBladePdf(Request $request)
    {
        $usuario = Usuario::all();
        $detallePedido = DetallePedido::Where('iddetalle_pedido', $request->idpedido)->first();

        $listaProductos = DB::table('producto')
            ->join('rel_prod_detalle', 'producto.idproducto', '=', 'rel_prod_detalle.producto_idproducto')
            ->where('detalle_pedido_iddetalle_pedido', '=', $detallePedido->iddetalle_pedido)
            ->select('*')
            ->get();

        $listaPromociones = DB::table('promocion')
            ->join('rel_prom_detalle', 'promocion.idpromocion', '=', 'rel_prom_detalle.promocion_idpromocion')
            ->where('detalle_pedido_iddetalle_pedido', '=', $detallePedido->iddetalle_pedido)
            ->select('*')
            ->get();

        $mediopago = MedioPago::Where('idmedio_pago', $detallePedido->medio_pago_idmedio_pago)->first();


        $pdf = PDF::loadView('pedido.pedido-pdf', ['usuario' => $usuario,
                                        'detalle' => $detallePedido,
                                        'mediopago' => $mediopago,
                                        'productos' => $listaProductos,
                                        'promocion' => $listaPromociones,
                                        ]);
        $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'arial', 'fontHeightRatio' => 0.8]);
        return $pdf->setPaper('c8')->stream('detalle-pedido.pdf');
    }


    public function marcar(Request $request){
      $usuario = Usuario::all();
      //$listaPedidos = DetallePedido::all()->sortByDesc('iddetalle_pedido');

      DB::table('detalle_pedido')
            ->where('iddetalle_pedido', $request->idDetalle)
            ->update([$request->tipo => $request->valor]);

            return 'success';
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
