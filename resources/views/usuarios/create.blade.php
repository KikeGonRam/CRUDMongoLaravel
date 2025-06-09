@extends('layouts.app')

@section('title', 'Crear Nuevo Usuario')
@section('icon', 'user-plus')
@section('subtitle', 'Agregar un nuevo usuario al sistema')

@section('breadcrumbs')
    <li>
        <div class="flex items-center">
            <i class="fas fa-chevron-right text-gray-400"></i>
            <a href="{{ route('usuarios.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Usuarios</a>
        </div>
    </li>
    <li>
        <div class="flex items-center">
            <i class="fas fa-chevron-right text-gray-400"></i>
            <span class="ml-4 text-sm font-medium text-gray-500">Crear</span>
        </div>
    </li>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow-lg rounded-lg p-8 card-hover animate__animated animate__fadeInUp animate__faster">
            <form action="{{ route('usuarios.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Nombre -->
                <div class="relative">
                    <label for="nombre" class="flex items-center text-gray-600 font-semibold text-sm uppercase mb-2">
                        <i class="fas fa-user text-primary-dark mr-2"></i> Nombre
                    </label>
                    <input type="text" name="nombre" id="nombre" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary-dark transition duration-300 @error('nombre') border-red-500 @enderror"
                           placeholder="Ingrese el nombre"
                           value="{{ old('nombre') }}"
                           data-tooltip="Ingrese el nombre del usuario">
                    @error('nombre')
                        <p class="mt-2 text-sm text-red-600 animate__animated animate__shakeX">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Apellido -->
                <div class="relative">
                    <label for="apellido" class="flex items-center text-gray-600 font-semibold text-sm uppercase mb-2">
                        <i class="fas fa-user text-primary-dark mr-2"></i> Apellido
                    </label>
                    <input type="text" name="apellido" id="apellido" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary-dark transition duration-300 @error('apellido') border-red-500 @enderror"
                           placeholder="Ingrese el apellido"
                           value="{{ old('apellido') }}"
                           data-tooltip="Ingrese el apellido del usuario">
                    @error('apellido')
                        <p class="mt-2 text-sm text-red-600 animate__animated animate__shakeX">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="relative">
                    <label for="email" class="flex items-center text-gray-600 font-semibold text-sm uppercase mb-2">
                        <i class="fas fa-envelope text-primary-dark mr-2"></i> Correo Electrónico
                    </label>
                    <input type="email" name="email" id="email" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary-dark transition duration-300 @error('email') border-red-500 @enderror"
                           placeholder="Ingrese el correo electrónico"
                           value="{{ old('email') }}"
                           data-tooltip="Ingrese un correo electrónico válido">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 animate__animated animate__shakeX">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Teléfono -->
                <div class="relative">
                    <label for="telefono" class="flex items-center text-gray-600 font-semibold text-sm uppercase mb-2">
                        <i class="fas fa-phone text-primary-dark mr-2"></i> Teléfono
                    </label>
                    <input type="text" name="telefono" id="telefono" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary-dark transition duration-300 @error('telefono') border-red-500 @enderror"
                           placeholder="Ingrese el número de teléfono"
                           value="{{ old('telefono') }}"
                           data-tooltip="Ingrese un número de teléfono válido">
                    @error('telefono')
                        <p class="mt-2 text-sm text-red-600 animate__animated animate__shakeX">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fecha de Nacimiento -->
                <div class="relative">
                    <label for="fecha_nacimiento" class="flex items-center text-gray-600 font-semibold text-sm uppercase mb-2">
                        <i class="fas fa-calendar-alt text-primary-dark mr-2"></i> Fecha de Nacimiento
                    </label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary-dark transition duration-300 @error('fecha_nacimiento') border-red-500 @enderror"
                           value="{{ old('fecha_nacimiento') }}"
                           data-tooltip="Seleccione la fecha de nacimiento">
                    @error('fecha_nacimiento')
                        <p class="mt-2 text-sm text-red-600 animate__animated animate__shakeX">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
                    <button type="submit"
                            class="inline-flex items-center justify-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition duration-300 transform hover:scale-105 card-hover"
                            data-tooltip="Guardar nuevo usuario">
                        <i class="fas fa-save mr-2"></i> Guardar
                    </button>
                    <a href="{{ route('usuarios.index') }}"
                       class="inline-flex items-center justify-center px-6 py-3 bg-secondary text-white rounded-lg hover:bg-secondary-dark transition duration-300 transform hover:scale-105 card-hover"
                       data-tooltip="Volver a la lista de usuarios">
                        <i class="fas fa-arrow-left mr-2"></i> Volver
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection