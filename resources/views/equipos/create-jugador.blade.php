@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Agregar Jugador a ' . $equipo->nombre) }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('equipos.store-jugador', $equipo) }}">
                        @csrf

                        <div class="mb-3">
                            <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autofocus>
                            @error('nombre')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="apellido" class="form-label">{{ __('Apellido') }}</label>
                            <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" required>
                            @error('apellido')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="numero_camiseta" class="form-label">{{ __('Número de Camiseta') }}</label>
                            <input id="numero_camiseta" type="text" class="form-control" name="numero_camiseta" value="{{ old('numero_camiseta') }}">
                        </div>

                        <div class="mb-3">
                            <label for="posicion" class="form-label">{{ __('Posición') }}</label>
                            <input id="posicion" type="text" class="form-control" name="posicion" value="{{ old('posicion') }}">
                        </div>

                        <div class="mb-3">
                            <label for="fecha_nacimiento" class="form-label">{{ __('Fecha de Nacimiento') }}</label>
                            <input id="fecha_nacimiento" type="date" class="form-control" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">{{ __('Crear Jugador') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
