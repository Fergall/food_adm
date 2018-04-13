@extends('layouts.app')

@section('content')
    <div class="container" id="container">
        <div class="row">
            <!-- Aqui va el detalle del pedido creado -->
            <div class="col-sm-4">
                @include('layouts.listaPedido')

            </div>
            <!-- fin detalle pedido -->
            <!-- Menú para agregar elementos al pedido -->
            <div class="col-sm-8">
              <ul class="nav nav-tabs">
              @foreach ($categoria as $categoriaList)
                  <li><a data-toggle="tab" href="#menu{{$categoriaList->idcategoria}}">{{$categoriaList->categoria_nombre}}</a></li>
              @endforeach
                  <li><a data-toggle="tab" href="#menu0">Promociones</a></li>
              </ul>
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        Arregle los errores
                    </div>
                @endif



                <div class="tab-content" id="paneles">
                  @foreach ($productos as $listaProductos)
                    <div id="menu{{$listaProductos->first()['categoria_idcategoria']}}" class="tab-pane fade in @if ($listaProductos->first()['categoria_idcategoria'] == 1) active @endif">
                    @foreach ($categoria as $categoriaList2)
                      @if ($categoriaList2->idcategoria == $listaProductos->first()['categoria_idcategoria'])
                        <h3>{{$categoriaList2->categoria_nombre}}</h3>
                      @endif
                    @endforeach
                    <p>Agregue los productos al pedido.</p>

                            @foreach ($listaProductos as $productos_individuales)
                             <div class="row">
                               <div class="col-sm-2">
                                <button
                                   id="restaProducto"
                                   type="button"
                                   class="btn btn-danger restaProducto"
                                   data-id="{{$productos_individuales->idproducto}}"
                                   data-title="{{$productos_individuales->producto_nombre}}"
                                   data-price="{{$productos_individuales->producto_precio}}"
                                   data-target="#ordenActual">
                                  -
                                </button>
                                <button
                                   id="sumaProducto"
                                   type="button"
                                   class="btn btn-success sumaProducto"
                                   data-id="{{$productos_individuales->idproducto}}"
                                   data-title="{{$productos_individuales->producto_nombre}}"
                                   data-price="{{$productos_individuales->producto_precio}}"
                                   data-target="#ordenActual">
                                  +
                                </button>

                               </div>
                               <div class="col-sm-2">
                               <input type="text" class="form-control" id="cantProd{{$productos_individuales->idproducto}}" name="cantcantProd{{$productos_individuales->idproducto}}" placeholder="0" value="0">
                               </div>
                               <div class="col-sm-6"><b>{{$productos_individuales->producto_nombre}}</b></div>
                               <div class="col-sm-2">
                                ${{$productos_individuales->producto_precio}}
                               </div>

                            </div>
                            <hr/>
                            @endforeach

                  </div>
                  @endforeach

                    <div id="menu0" class="tab-pane fade in @if ($listaProductos->first()['categoria_idcategoria'] == 0) active @endif">
                        <h3>Promociones</h3>

                    <p>Agregue los productos al pedido.</p>

                            @foreach ($promocion as $promociones)
                             <div class="row">
                               <div class="col-sm-2">
                                <button
                                   id="restaPromo"
                                   type="button"
                                   class="btn btn-danger restaPromocion"
                                   data-id="{{$promociones->idpromocion}}"
                                   data-title="{{$promociones->promocion_nombre}}"
                                   data-price="{{$promociones->promocion_precio}}"
                                   data-target="#ordenActual">
                                  -
                                </button>
                                <button
                                   id="sumaPromo"
                                   type="button"
                                   class="btn btn-success sumaPromocion"
                                   data-id="{{$promociones->idpromocion}}"
                                   data-title="{{$promociones->promocion_nombre}}"
                                   data-price="{{$promociones->promocion_precio}}"
                                   data-target="#ordenActual">
                                  +
                                </button>

                               </div>
                               <div class="col-sm-2">
                               <input type="text" class="form-control" id="cantProm{{$promociones->idpromocion}}" name="cantProm{{$promociones->idpromocion}}" placeholder="0" value="0">
                               </div>
                               <div class="col-sm-6"><b>{{$promociones->promocion_nombre}}</b></div>
                               <div class="col-sm-2">
                                ${{$promociones->promocion_precio}}
                               </div>

                            </div>
                            <hr/>
                            @endforeach

                  </div>

            </div>
        </div>
    </div>
</div>


@endsection
