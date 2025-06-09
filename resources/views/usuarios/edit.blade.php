@extends('layouts.app')

@section('title', 'Editar Usuario')
@section('icon', 'user-edit') {{-- Consider a more specific edit icon if available --}}
@section('subtitle', 'Actualiza la información del usuario: ' . $usuario->nombre . ' ' . $usuario->apellido)

@section('breadcrumbs')
    <li>
        <div class="flex items-center">
            <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            <a href="{{ route('usuarios.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-primary-dark">Usuarios</a>
        </div>
    </li>
    <li>
        <div class="flex items-center">
            <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            {{-- Link to show page if it exists, or just display name --}}
            <span class="ml-4 text-sm font-medium text-gray-500">{{ $usuario->nombre }} {{ $usuario->apellido }}</span>
        </div>
    </li>
    <li>
        <div class="flex items-center">
            <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            <span class="ml-4 text-sm font-medium text-gray-500">Editar</span>
        </div>
    </li>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow-lg rounded-lg p-8 card-hover animate__animated animate__fadeInUp animate__faster">

            <div class="flex items-center mb-6">
                <div class="bg-primary-light text-primary-dark p-3 rounded-full mr-4">
                    <i class="fas fa-user-edit text-xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Editar Usuario</h2>
                    <p class="text-gray-600">Modifica los campos a continuación.</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg animate__animated animate__shakeX">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <p class="font-bold">Errores de validación</p>
                    </div>
                    <ul class="mt-2 text-sm list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('usuarios.update', $usuario->_id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Campo: Nombre --}}
                <div class="relative">
                    <label for="nombre" class="flex items-center text-gray-600 font-semibold text-sm uppercase mb-2">
                        <i class="fas fa-user text-primary-dark mr-2"></i> Nombre <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="text" name="nombre" id="nombre" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary-dark transition duration-300 @error('nombre') border-red-500 @enderror"
                           placeholder="Ingrese el nombre"
                           value="{{ old('nombre', $usuario->nombre) }}">
                    @error('nombre')
                        <p class="mt-2 text-sm text-red-600 animate__animated animate__shakeX">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Campo: Apellido --}}
                <div class="relative">
                    <label for="apellido" class="flex items-center text-gray-600 font-semibold text-sm uppercase mb-2">
                        <i class="fas fa-user text-primary-dark mr-2"></i> Apellido <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="text" name="apellido" id="apellido" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary-dark transition duration-300 @error('apellido') border-red-500 @enderror"
                           placeholder="Ingrese el apellido"
                           value="{{ old('apellido', $usuario->apellido) }}">
                    @error('apellido')
                        <p class="mt-2 text-sm text-red-600 animate__animated animate__shakeX">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Campo: Correo Electrónico --}}
                <div class="relative">
                    <label for="email" class="flex items-center text-gray-600 font-semibold text-sm uppercase mb-2">
                        <i class="fas fa-envelope text-primary-dark mr-2"></i> Correo Electrónico <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="email" name="email" id="email" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary-dark transition duration-300 @error('email') border-red-500 @enderror"
                           placeholder="Ingrese el correo electrónico"
                           value="{{ old('email', $usuario->email) }}">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 animate__animated animate__shakeX">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Campo: Teléfono --}}
                <div class="relative">
                    <label for="telefono" class="flex items-center text-gray-600 font-semibold text-sm uppercase mb-2">
                        <i class="fas fa-phone text-primary-dark mr-2"></i> Teléfono <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="text" name="telefono" id="telefono" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary-dark transition duration-300 @error('telefono') border-red-500 @enderror"
                           placeholder="Ingrese el número de teléfono"
                           value="{{ old('telefono', $usuario->telefono) }}">
                    @error('telefono')
                        <p class="mt-2 text-sm text-red-600 animate__animated animate__shakeX">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Campo: Fecha de Nacimiento --}}
                <div class="relative">
                    <label for="fecha_nacimiento" class="flex items-center text-gray-600 font-semibold text-sm uppercase mb-2">
                        <i class="fas fa-calendar-alt text-primary-dark mr-2"></i> Fecha de Nacimiento <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary-dark transition duration-300 @error('fecha_nacimiento') border-red-500 @enderror"
                           value="{{ old('fecha_nacimiento', $usuario->fecha_nacimiento) }}">
                    @error('fecha_nacimiento')
                        <p class="mt-2 text-sm text-red-600 animate__animated animate__shakeX">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Considerar añadir campo para contraseña si es relevante para la edición de usuarios --}}

                {{-- Botones de Acción --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pt-6 border-t border-gray-200 mt-6">
                    <div class="flex space-x-3">
                        <button type="submit"
                                class="inline-flex items-center justify-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition duration-300 transform hover:scale-105 card-hover">
                            <i class="fas fa-save mr-2"></i> Actualizar Usuario
                        </button>
                        <a href="{{ route('usuarios.index') }}" {{-- O podría ser show page: route('usuarios.show', $usuario->_id) --}}
                           class="inline-flex items-center justify-center px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-300 transform hover:scale-105 card-hover">
                            <i class="fas fa-times mr-2"></i> Cancelar
                        </a>
                    </div>
                     <a href="{{ route('usuarios.index') }}" class="mt-4 sm:mt-0 inline-flex items-center text-sm text-primary hover:text-primary-dark transition-colors duration-300">
                        <i class="fas fa-arrow-left mr-2"></i> Volver a la lista
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{{-- Script para enfocar el primer error o campo, similar al de productos.edit --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const errorField = document.querySelector('.border-red-500');
        if (errorField) {
            errorField.focus();
            errorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
        } else {
            const nombreInput = document.getElementById('nombre');
            if (nombreInput) {
                nombreInput.focus();
            }
        }
    });
</script>
@endsection
