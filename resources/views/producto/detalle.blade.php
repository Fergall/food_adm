@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Aqui va el detalle del pedido creado -->
            <div class="col-sm-4">
                @component('layouts.listaMantenedor')
                @endcomponent
            </div>
            <!-- fin detalle pedido -->
            <!-- Menú para agregar elementos al pedido -->
            <div class="col-sm-8">
                <div class="row">
                <a href="{{ url('/productoNew') }}"><button class="btn btn-default">+ Nuevo producto</button></a>
                </div>
                <div class="tab-content">
                  <div id="home" class="tab-pane fade in active">
                    <h3>productos - Detalle - {{$producto->producto_nombre}}</h3>
                    <form action="{{ url('/producto/') }}/{{$producto->idproducto}}" method="post">
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                Arregle los errores
                            </div>
                        @endif
                        <input type="hidden" hidden="true" class="form-control" id="idproducto" name="idproducto" value="{{ $producto->idproducto }}">
                        {!! csrf_field() !!}
                        <div class="form-group{{ $errors->has('usuario') ? ' has-error' : '' }}">
                            <label for="producto_nombre">Nombre producto</label>
                            <input type="text" class="form-control" id="producto_nombre" name="producto_nombre" placeholder="Nombre del producto" value="{{ $producto->producto_nombre }}">
                            @if($errors->has('$producto->producto_nombre'))
                                <span class="help-block">{{ $errors->first('$producto->producto_nombre') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('producto_precio') ? ' has-error' : '' }}">
                            <label for="producto_descripcion">precio</label>
                              <input type="text" class="form-control" id="producto_precio" name="producto_precio" placeholder="Precio del producto" value="{{ $producto->producto_precio }}">
                            @if($errors->has('$producto->producto_precio'))
                                <span class="help-block">{{ $errors->first('$producto->producto_precio') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('producto_categoria') ? ' has-error' : '' }}">
                            <label for="producto_categoria">Categoría</label>
                              {{ Form::select('producto_categoria', $categoria, $producto->categoria_idcategoria, ['class' => 'form-control', 'id' => 'producto_categoria', 'name' => 'producto_categoria']) }}
                            @if($errors->has('$producto->producto_precio'))
                                <span class="help-block">{{ $errors->first('$producto->producto_precio') }}</span>
                            @endif
                        </div>




                        <button type="submit" class="btn btn-default">Finalizar modificación</button>
                    </form>
                  </div>
                </div>

            </div>
        </div>
@endsection
