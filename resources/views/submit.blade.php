@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h1>Guarda un usuario</h1>
            <form action="/submit" method="post">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        Arregle los errores
                    </div>
                @endif

                {!! csrf_field() !!}
                <div class="form-group{{ $errors->has('usuario') ? ' has-error' : '' }}">
                    <label for="usuario">Usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="usuario" value="{{ old('usuario') }}">
                    @if($errors->has('usuario'))
                        <span class="help-block">{{ $errors->first('usuario') }}</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                    <label for="nombre">nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre" value="{{ old('nombre') }}">
                    @if($errors->has('nombre'))
                        <span class="help-block">{{ $errors->first('nombre') }}</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('pass') ? ' has-error' : '' }}">
                    <label for="pass">pass</label>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="pass" value="{{ old('pass') }}">
                    @if($errors->has('pass'))
                        <span class="help-block">{{ $errors->first('pass') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
@endsection
