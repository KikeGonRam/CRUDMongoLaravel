@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Usuario</h2>

    <form action="{{ route('usuarios.update', $usuario->_id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nombre:</label>
        <input type="text" name="nombre" value="{{ $usuario->nombre }}" required>

        <label>Apellido:</label>
        <input type="text" name="apellido" value="{{ $usuario->apellido }}" required>

        <label>Email:</label>
        <input type="email" name="email" value="{{ $usuario->email }}" required>

        <label>Teléfono:</label>
        <input type="text" name="telefono" value="{{ $usuario->telefono }}" required>

        <label>Fecha de nacimiento:</label>
        <input type="date" name="fecha_nacimiento" value="{{ $usuario->fecha_nacimiento }}" required>

        <button type="submit">Actualizar</button>
    </form>

    <a href="{{ route('usuarios.index') }}">Volver</a>
</div>
@endsection
