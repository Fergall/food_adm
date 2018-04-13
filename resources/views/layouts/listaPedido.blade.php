<h1>Detalle del pedido</h1>
@push('lista-function')
    <script type="text/javascript" src="{{ asset('../resources/assets/js/lista-function.js') }}"></script>
@endpush
<form action="{{ url('/finPedido') }}" id="finPedido" name="finPedido" method="post">
<input id="ord_total" name="total" type=hidden>
<input id="items" name="items" type=hidden value="">

<div id="containerOrden">
  <div class="row" id="ordenActual">
    <div class="col-sm-2">
      Elim
    </div>
    <div class="col-sm-6">
       Nombre Producto
    </div>
    <div class="col-sm-1">
       Cant.
    </div>
    <div class="col-sm-1">
       Precio
    </div>
  </div>
  @if(isset($orden))
    @foreach ($orden as $orden)
        <div class="row">
          <div class="col-sm-1">
            <button type="button" class="btn btn-danger">X</button>
          </div>
          <div class="col-sm-8">
             Nombre del producto
          </div>
          <div class="col-sm-2">
             2
          </div>
          <div class="col-sm-2">
             $1.500
          </div>
        </div>
    @endforeach
  @endif
</div>
  <hr/>
  <div class="row text-right">
    <div class="col-sm-4">
      <button
         type="button"
         class="btn btn-success"
         data-toggle="modal"
         data-target="#detalleFinPedido">
        Finalizar
      </button>
    </div>
    <div class="col-sm-4">
      <h3>
      Total:
      </h3>
    </div>
    <div class="col-sm-2" id="totalPedido" name="totalPedido">
      <h3>
      $0
      </h3>
    </div>
    <div class="col-sm-2">
    </div>
  </div>

  <div class="modal fade" id="detalleFinPedido"
       tabindex="-1" role="dialog"
       aria-labelledby="detalleFinPedido">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close"
            data-dismiss="modal"
            aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"
          id="detalleFinPedido">Finalizar pedido</h4>
        </div>
        <div class="modal-body">
          {!! csrf_field() !!}
          <div class="form-group{{ $errors->has('usuario') ? ' has-error' : '' }}">
              <label for="usuario">Nombre cliente</label>
              <input type="text" class="form-control" id="cliente_nombre" name="cliente_nombre" placeholder="Nombre del cliente" value="{{ old('cliente_nombre') }}">
              @if($errors->has('cliente_nombre'))
                  <span class="help-block">{{ $errors->first('cliente_nombre') }}</span>
              @endif
          </div>
          <div class="form-group{{ $errors->has('domicilio') ? ' has-error' : '' }}">
              <label for="domicilio">Domicilio</label>
              <input type="text" class="form-control" id="domicilio" name="domicilio" placeholder="domicilio" value="{{ old('domicilio') }}">
              @if($errors->has('domicilio'))
                  <span class="help-block">{{ $errors->first('domicilio') }}</span>
              @endif
          </div>
          <div class="form-group{{ $errors->has('fono') ? ' has-error' : '' }}">
              <label for="fono">Fono</label>
              <input type="text" class="form-control" id="fono" name="fono" placeholder="fono" value="{{ old('fono') }}">
              @if($errors->has('fono'))
                  <span class="help-block">{{ $errors->first('fono') }}</span>
              @endif
          </div>
          <div class="form-group{{ $errors->has('tiempo_espera') ? ' has-error' : '' }}">
              <label for="tiempo_espera">Tiempo de espera (minutos)</label>
              <input type="number" class="form-control" id="tiempo_espera" name="tiempo_espera" placeholder="tiempo de espera (en minutos)" value="{{ old('tiempo_espera') }}">
              @if($errors->has('tiempo_espera'))
                  <span class="help-block">{{ $errors->first('tiempo_espera') }}</span>
              @endif
          </div>

          <div class="form-group{{ $errors->has('tiempo_espera') ? ' has-error' : '' }}">
              <label for="total">Total</label>
              <input type="number" class="form-control" id="total_monto" name="total_monto" placeholder="monto total" value="{{ old('tiempo_espera') }}">
              @if($errors->has('tiempo_espera'))
                  <span class="help-block">{{ $errors->first('total_monto') }}</span>
              @endif
          </div>

          <div class="form-group{{ $errors->has('pass') ? ' has-error' : '' }}">
              <label for="pago">Pago</label>
              <!-- aqui va el medio de pago -->
              <select  id="mediopago" name="mediopago" class="form-control">
                  @foreach ($mediopago as $listPago)
                      <option value="{{$listPago->idmedio_pago}}">{{$listPago->medio_pago_nombre}}</option>
                  @endforeach
              </select>
              @if($errors->has('pass'))
                  <span class="help-block">{{ $errors->first('pass') }}</span>
              @endif
          </div>
          <div class="form-group{{ $errors->has('pass') ? ' has-error' : '' }}">
              <input type="checkbox" id="tipo_entrega" name="tipo_entrega" checked="checked"> A domicilio<br>
          </div>
          <div class="form-group{{ $errors->has('pass') ? ' has-error' : '' }}">
              <input type="checkbox" id="entregado" name="entregado"  checked="checked"> Entregado<br>
          </div>
          <div class="form-group{{ $errors->has('pass') ? ' has-error' : '' }}">
              <input type="checkbox" id="pagado" name="pagado" checked="checked"> Pagado<br>
          </div>
          <div class="form-group{{ $errors->has('observacion') ? ' has-error' : '' }}">
              <label for="observacion">Observación</label>
              <textarea class="form-control" id="observacion" name="observacion" placeholder="Indique aqui los detalles del pedido">
                {{ old('observacion') }}
              </textarea>
              @if($errors->has('observacion'))
                  <span class="help-block">{{ $errors->first('observacion') }}</span>
              @endif
          </div>



        </div>
        <div class="modal-footer">
          <button type="button"
             class="btn btn-default"
             data-dismiss="modal">Close</button>
          <span class="pull-right">

            <button type="submit" id="finalizarPedido" name="finalizarPedido" class="btn btn-success">Finalizar pedido</button>
          </span>
        </div>
      </div>
    </div>
  </div>



</form>
