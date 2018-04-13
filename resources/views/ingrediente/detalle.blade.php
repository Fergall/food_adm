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
                <a href="{{ url('/ingrediente/new') }}"><button class="btn btn-default">+ Nuevo ingrediente</button></a>
                </div>
                <div class="tab-content">
                  <div id="home" class="tab-pane fade in active">
                    <h3>Ingredientes - Detalle - {{$ingrediente->ingrediente_nombre}}</h3>
                    <form action="{{ url('/ingrediente/') }}/{{$ingrediente->idingrediente}}" method="post">
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                Arregle los errores
                            </div>
                        @endif
                        <input type="hidden" hidden="true" class="form-control" id="idingrediente" name="idingrediente" value="{{ $ingrediente->idingrediente }}">
                        {!! csrf_field() !!}
                        <div class="form-group{{ $errors->has('usuario') ? ' has-error' : '' }}">
                            <label for="ingrediente_nombre">Nombre ingrediente</label>
                            <input type="text" class="form-control" id="ingrediente_nombre" name="ingrediente_nombre" placeholder="Nombre del ingrediente" value="{{ $ingrediente->ingrediente_nombre }}">
                            @if($errors->has('$ingrediente->ingrediente_nombre'))
                                <span class="help-block">{{ $errors->first('$ingrediente->ingrediente_nombre') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('ingrediente_descripcion') ? ' has-error' : '' }}">
                            <label for="ingrediente_descripcion">Detalle</label>
                            <textarea class="form-control" id="ingrediente_descripcion" name="ingrediente_descripcion">{{$ingrediente->ingrediente_descripcion}}
                            </textarea>
                            @if($errors->has('$ingrediente->ingrediente_descripcion'))
                                <span class="help-block">{{ $errors->first('$ingrediente->ingrediente_descripcion') }}</span>
                            @endif
                        </div>


                        <button type="submit" class="btn btn-default">Finalizar modificación</button>
                    </form>
                  </div>
                </div>

            </div>
        </div>
@endsection
