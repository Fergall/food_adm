<div class="container">
  <div class="col-sm-10 col-sm-offset-1 ">
          <div class="row">
                  <div>
                      <h6><b>Nombre cliente: </b>{{ $detalle->detalle_pedido_nombre }}</h6>
                  </div>
                  <div>
                      <h4><b>Domicilio: </b>{{$detalle->detalle_pedido_direccion}}</h4>
                  </div>
                  <div>
                      <h3><b>Fono: </b>{{ $detalle->detalle_pedido_fono }}</h3>
                  </div>

                  <div >
                     <h6><b>Entrega de pedido: </b>{{ $detalle->detalle_pedido_hora_entrega->format('G:i') }}</h6>
                  </div>

                  <div>
                      <h6><b>Pago: </b>{{$mediopago->medio_pago_nombre }}</h6>
                  </div>
                  <div>
                      <h6><b>A domicilio:</b>
                      @if ($detalle->detalle_pedido_domicilio == 1)
                        Si
                      @else
                        No
                      @endif
                      </h6>
                  </div>
                  <div>
                      <h6><b>Entregado:</b>
                      @if ($detalle->detalle_pedido_entregado == 1)
                        Si
                      @else
                        No
                      @endif
                      </h6>
                  </div>

                  <div>
                      <h6><b>Pagado:</b>
                      @if ($detalle->detalle_pedido_pagado == 1)
                        Si
                      @else
                        No
                      @endif
                      </h6>
                  </div>

                  <h5>Detalle de producto(s)</h5>
                  @foreach ($productos as $listaProductos)
                    @if ($listaProductos->cant_prod_detalle > 0)
                    <div class="col-sm-6">
                      <h3>{{$listaProductos->cant_prod_detalle}}x {{$listaProductos->producto_nombre}}</h3>
                    </div>
                    @endif
                  @endforeach
                  @foreach ($promocion as $listaPromociones)
                    @if ($listaPromociones->cant_prom_detalle > 0)
                    <div class="col-sm-6">
                      <h3>{{$listaPromociones->cant_prom_detalle}}x {{$listaPromociones->promocion_nombre}}</h3>
                    </div>
                    @endif
                  @endforeach

                  <div class="col-sm-12">
                     <h3>Total: </b>{{$detalle->detalle_pedido_total}}</h3>
                  </div>

                  <div>
                      <h4><b>Observación: </b>{{ $detalle->detalle_pedido_descripcion }}</h4>
                  </div>
          </div>
      </div>
</div>
