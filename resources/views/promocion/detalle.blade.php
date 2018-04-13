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
                <a href="{{ url('/promocion/new') }}"><button class="btn btn-default">+ Nuevo promocion</button></a>
                </div>
                <div class="tab-content">
                  <div id="home" class="tab-pane fade in active">
                    <h3>promocions - Detalle - {{$promocion->promocion_nombre}}</h3>
                    <form action="{{ url('/promocion/') }}/{{$promocion->idpromocion}}" method="post">
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                Arregle los errores
                            </div>
                        @endif
                        <input type="hidden" hidden="true" class="form-control" id="idpromocion" name="idpromocion" value="{{ $promocion->idpromocion }}">
                        {!! csrf_field() !!}
                        <div class="form-group{{ $errors->has('usuario') ? ' has-error' : '' }}">
                            <label for="promocion_nombre">Nombre promocion</label>
                            <input type="text" class="form-control" id="promocion_nombre" name="promocion_nombre" placeholder="Nombre del promocion" value="{{ $promocion->promocion_nombre }}">
                            @if($errors->has('$promocion->promocion_nombre'))
                                <span class="help-block">{{ $errors->first('$promocion->promocion_nombre') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('promocion_precio') ? ' has-error' : '' }}">
                            <label for="promocion_descripcion">precio</label>
                              <input type="text" class="form-control" id="promocion_precio" name="promocion_precio" placeholder="Precio del promocion" value="{{ $promocion->promocion_precio }}">
                            @if($errors->has('$promocion->promocion_precio'))
                                <span class="help-block">{{ $errors->first('$promocion->promocion_precio') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('promocion_descripcion') ? ' has-error' : '' }}">
                            <label for="promocion_descripcion">Detalle</label>
                            <textarea class="form-control" id="promocion_descripcion" name="promocion_descripcion">{{$promocion->promocion_descripcion}}
                            </textarea>
                            @if($errors->has('$promocion->promocion_descripcion'))
                                <span class="help-block">{{ $errors->first('$promocion->promocion_descripcion') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('promocion_categoria') ? ' has-error' : '' }}">
                            <label for="promocion_categoria">Categoría</label>
                              {{ Form::select('promocion_categoria', $categoria, $promocion->categoria_idcategoria, ['class' => 'form-control', 'id' => 'promocion_categoria', 'name' => 'promocion_categoria']) }}
                            @if($errors->has('$promocion->promocion_precio'))
                                <span class="help-block">{{ $errors->first('$promocion->promocion_precio') }}</span>
                            @endif
                        </div>




                        <button type="submit" class="btn btn-default">Finalizar modificación</button>
                    </form>
                  </div>
                </div>

            </div>
        </div>
@endsection
