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
                <div class="tab-content">
                  <div id="home" class="tab-pane fade in active">
                    <h3>Categorias - Detalle - Nuevo</h3>
                    <form action="{{ url('/categoriaNew') }}" method="post">
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                Arregle los errores
                            </div>
                        @endif
                        <input type="hidden" hidden="true" class="form-control" id="idcategoria" name="idcategoria" value="{{ $categoria->idcategoria }}">
                        {!! csrf_field() !!}
                        <div class="form-group{{ $errors->has('usuario') ? ' has-error' : '' }}">
                            <label for="categoria_nombre">Nombre categoria</label>
                            <input type="text" class="form-control" id="categoria_nombre" name="categoria_nombre" placeholder="Nombre del categoria" value="{{ $categoria->categoria_nombre }}">
                            @if($errors->has('$categoria->categoria_nombre'))
                                <span class="help-block">{{ $errors->first('$categoria->categoria_nombre') }}</span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-default">Finalizar creación</button>
                    </form>
                  </div>
                </div>

            </div>
        </div>
@endsection
