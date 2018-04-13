@extends('layouts.app')

@section('content')

@push('lista-function')
    <script type="text/javascript" src="{{ asset('../resources/assets/js/lista-function.js') }}"></script>
@endpush
    <div class="container">
        <div class="row">
            <!-- Menú para agregar elementos al pedido -->
            <div class="col-sm-12">
                <div class="row">
                <form action="{{ url('/listaPedidos') }}" method="post">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                  Fecha de inicio
                  {{ Form::text('dateInicio', '', array('class' => 'datepicker','id' => 'dateInicio')) }}

                  Fecha de Fin
                  {{ Form::text('dateFin', '', array('class' => 'datepicker', 'id' => 'dateFin')) }}
                <button type="submit" class="btn btn-default">Filtrar</button>
               </form>

               <form action="{{ url('/listaPedidos/excel') }}" method="post" id="excelPedidos">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                {!! Form::hidden('dateInicioExcel', $fechaInicio->format('d/m/Y'), ['id' => 'dateInicioExcel']) !!}
                {!! Form::hidden('dateFinExcel', $fechaFin->format('d/m/Y'), ['id' => 'dateFinExcel']) !!}
               <button type="submit" class="btn btn-default">Exportar</button>
              </form>
                </div>
                <div class="tab-content">
                  <div id="home" class="tab-pane fade in active">
                    <h3>Pedidos</h3>
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>N° pedido</th>
                          <th>Atención</th>
                          <th>Fecha</th>
                          <th>Hora de pedido</th>
                          <th>Hora de entrega</th>
                          <th>Cliente</th>
                          <th>Direccion</th>
                          <th>Fono</th>
                          <th>Total</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                    @foreach ($pedidos as $listaPedidos)
                    <tr @if($listaPedidos->detalle_pedido_pagado == 1) class="success" @else class="danger" @endif>
                      <td>{{$listaPedidos->detalle_pedido_numero}}</td>
                      <td>{{$listaPedidos->name}}</td>
                      <td>{{$listaPedidos->detalle_pedido_hora_pedido->format('d/m/Y')}}</td>
                      <td>{{$listaPedidos->detalle_pedido_hora_pedido->format('G:i')}}</td>
                      <td>{{$listaPedidos->detalle_pedido_hora_entrega->format('G:i')}}</td>

                      <td>{{$listaPedidos->detalle_pedido_nombre}}</td>
                      <td>{{$listaPedidos->detalle_pedido_direccion}}</td>
                      <td>{{$listaPedidos->detalle_pedido_fono}}</td>
                      <td>{{$listaPedidos->detalle_pedido_total}}</td>
                      <td>
                       <a href="{{ url('/detallePedido/') }}/{{$listaPedidos->detalle_pedido_numero}}"><button type="button" class="btn btn-success">Detalle</button></a>

                     </td>
                   </tr>
                   @endforeach
                   </table>
                   <hr/>


                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
