@extends('layouts.app')
@section('content')
<!-- Aqui va el detalle del pedido creado -->
<div class="container">
  <div class="col-sm-8 col-sm-offset-2 ">
          <div class="row">
            <div class="alert alert-success">
              <strong>Exito!</strong> El pedido ha sido guardado.
            </div>
                  <div class="form-group{{ $errors->has('usuario') ? ' has-error' : '' }}">
                      <label for="usuario">Nombre cliente</label>
                      <input type="text" class="form-control"
                      id="cliente_nombre" name="cliente_nombre"
                      value="{{ $detalle->detalle_pedido_nombre }}" disabled>
                  </div>

                  <div class="form-group{{ $errors->has('usuario') ? ' has-error' : '' }}">
                      <label for="usuario">Pedido tomado por:</label>
                      <input type="text" class="form-control"
                      id="usuario_nombre" name="usuario_nombre"
                      value="{{ $nameUsuario }}" disabled>
                  </div>

                  <div class="form-group{{ $errors->has('domicilio') ? ' has-error' : '' }}">
                      <label for="domicilio">Domicilio</label>
                      <input type="text" class="form-control"
                      id="domicilio" name="domicilio"
                      value="{{$detalle->detalle_pedido_direccion}}" disabled>
                  </div>
                  <div class="form-group{{ $errors->has('fono') ? ' has-error' : '' }}">
                      <label for="fono">Fono</label>
                      <input type="text" class="form-control"
                      id="fono" name="fono"
                      value="{{ $detalle->detalle_pedido_fono }}" disabled>
                  </div>

                  <div class="form-group{{ $errors->has('tiempo_espera') ? ' has-error' : '' }}">
                      <label for="tiempo_espera">Pedido realizado a las:</label>
                      <input type="text" class="form-control"
                      id="tiempo_pedido" name="tiempo_pedido"
                      value="{{ $detalle->detalle_pedido_hora_pedido }}" disabled>
                  </div>

                  <div class="form-group{{ $errors->has('tiempo_espera') ? ' has-error' : '' }}">
                      <label for="tiempo_espera">Hora de entrega estimada: </label>
                      <input type="text" class="form-control"
                      id="tiempo_espera" name="tiempo_espera"
                      value="{{ $detalle->detalle_pedido_hora_entrega }}" disabled>
                  </div>

                  <div class="form-group{{ $errors->has('tiempo_espera') ? ' has-error' : '' }}">
                      <label for="total">Total</label>
                      <input type="text" class="form-control"
                      id="total_monto" name="total_monto"
                      value="{{ $detalle->detalle_pedido_total }}" disabled>
                  </div>

                  <div class="form-group{{ $errors->has('pass') ? ' has-error' : '' }}">
                      <label for="pago">Pago</label>
                      <!-- aqui va el medio de pago -->
                      <label for="mediopago">Total</label>
                      <input type="text" class="form-control"
                      id="total_monto" name="total_monto"
                      value="{{ $mediopago->medio_pago_nombre }}" disabled>
                  </div>
                  <div class="form-group{{ $errors->has('pass') ? ' has-error' : '' }}">
                      <input type="checkbox"
                      id="tipo_entrega" name="tipo_entrega"
                      @if ($detalle->detalle_pedido_domicilio == 1)
                        checked="checked"
                      @endif
                      > A domicilio<br>
                  </div>
                  <div class="form-group{{ $errors->has('pass') ? ' has-error' : '' }}">
                      <input type="checkbox" id="entregado"
                      name="entregado"
                      @if ($detalle->detalle_pedido_entregado == 1)
                        checked="checked"
                      @endif
                      >
                      Entregado<br>
                  </div>
                  <div class="form-group{{ $errors->has('pass') ? ' has-error' : '' }}">
                      <input type="checkbox" id="pagado" name="pagado"
                      @if ($detalle->detalle_pedido_pagado == 1)
                        checked="checked"
                      @endif
                      > Pagado<br>
                  </div>

                  <h4>Detalle de producto(s)</h4>
                  <div class="col-sm-6">
                    <b>Nombre</b>
                  </div>
                  <div class="col-sm-2">
                    <b>Precio</b>
                  </div>
                  <div class="col-sm-2">
                    <b>Cant</b>
                  </div>
                  <div class="col-sm-2">
                    <b>Subtotal</b>
                  </div>
                  @foreach ($productos as $listaProductos)
                    <div class="col-sm-6">
                      {{$listaProductos->producto_nombre}}
                    </div>
                    <div class="col-sm-2">
                      {{$listaProductos->producto_precio}}
                    </div>
                    <div class="col-sm-2">
                      {{$listaProductos->cant_prod_detalle}}
                    </div>
                    <div class="col-sm-2">
                      {{$listaProductos->cant_prod_detalle * $listaProductos->producto_precio}}
                    </div>
                  @endforeach

                  <h4>Detalle de promocion(es)</h4>
                  <div class="col-sm-6">
                    <b>Nombre</b>
                  </div>
                  <div class="col-sm-2">
                    <b>Precio</b>
                  </div>
                  <div class="col-sm-2">
                    <b>Cant</b>
                  </div>
                  <div class="col-sm-2">
                    <b>Subtotal</b>
                  </div>
                  @foreach ($promocion as $listaPromociones)
                    <div class="col-sm-6">
                      {{$listaPromociones->promocion_nombre}}
                    </div>
                    <div class="col-sm-2">
                      {{$listaPromociones->promocion_precio}}
                    </div>
                    <div class="col-sm-2">
                      {{$listaPromociones->cant_prom_detalle}}
                    </div>
                    <div class="col-sm-2">
                      {{$listaPromociones->cant_prom_detalle * $listaPromociones->promocion_precio}}
                    </div>
                  @endforeach

                  <div class="col-sm-12">
                     <h3>Total: {{$detalle->detalle_pedido_total}}
                  </div>

                  <div class="form-group{{ $errors->has('observacion') ? ' has-error' : '' }}">
                      <label for="observacion">Observación</label>
                      <textarea class="form-control" id="observacion" name="observacion" placeholder="Indique aqui los detalles del pedido">
                        {{ $detalle->detalle_pedido_descripcion }}
                      </textarea>
                  </div>
                  <form action="{{ url('/listaPedidos/pdf') }}" method="post" id="excelPedidos">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                  <input type="hidden" name="idpedido" id="idpedido" value="{{ $detalle->iddetalle_pedido }}" >
                  <button type="submit" class="btn btn-default">Imprimir pedido</button>
              </form>

          </div>
      </div>
</div>
@endsection
