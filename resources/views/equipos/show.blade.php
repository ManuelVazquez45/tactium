@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $equipo->nombre }}</h3>
                </div>
                <div class="card-body">
                    <p><strong>Descripción:</strong> {{ $equipo->descripcion }}</p>
                    <p><strong>Entrenador:</strong> {{ $equipo->coach->name }}</p>
                    <p><strong>Estado:</strong> <span class="badge bg-{{ $equipo->status === 'approved' ? 'success' : 'warning' }}">{{ $equipo->status }}</span></p>
                </div>
            </div>

            @if(auth()->user()->role === 'entrenador' && auth()->user()->id === $equipo->coach_id)
            <div class="mt-3">
                <a href="{{ route('equipos.create-jugador', $equipo) }}" class="btn btn-primary">Agregar Jugador</a>
            </div>
            @endif

            <div class="card mt-4">
                <div class="card-header">
                    <h5>Jugadores</h5>
                </div>
                <div class="card-body">
                    @if($jugadores->isEmpty())
                        <p>No hay jugadores registrados aún.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Posición</th>
                                    <th>Camiseta</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jugadores as $jugador)
                                <tr>
                                    <td>{{ $jugador->nombre }} {{ $jugador->apellido }}</td>
                                    <td>{{ $jugador->email }}</td>
                                    <td>{{ $jugador->posicion ?? '-' }}</td>
                                    <td>{{ $jugador->numero_camiseta ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
