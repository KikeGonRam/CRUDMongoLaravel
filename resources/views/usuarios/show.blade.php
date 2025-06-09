@extends('layouts.app')

@section('title', 'Detalles del Usuario')
@section('icon', 'user-circle')
@section('subtitle', 'Información detallada del usuario')

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
            <span class="ml-4 text-sm font-medium text-gray-500">Detalles</span>
        </div>
    </li>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow-lg rounded-lg p-8 card-hover animate__animated animate__fadeInUp animate__faster">
            <div class="grid grid-cols-1 gap-6">
                <div class="flex items-center">
                    <i class="fas fa-user text-primary-dark text-xl mr-4"></i>
                    <div>
                        <span class="text-gray-600 font-semibold text-sm uppercase">Nombre Completo</span>
                        <p class="text-gray-800 text-lg">{{ $usuario->nombre }} {{ $usuario->apellido }}</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-envelope text-primary-dark text-xl mr-4"></i>
                    <div>
                        <span class="text-gray-600 font-semibold text-sm uppercase">Correo Electrónico</span>
                        <p class="text-gray-800 text-lg">{{ $usuario->email }}</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-phone text-primary-dark text-xl mr-4"></i>
                    <div>
                        <span class="text-gray-600 font-semibold text-sm uppercase">Teléfono</span>
                        <p class="text-gray-800 text-lg">{{ $usuario->telefono }}</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-calendar-alt text-primary-dark text-xl mr-4"></i>
                    <div>
                        <span class="text-gray-600 font-semibold text-sm uppercase">Fecha de Nacimiento</span>
                        <p class="text-gray-800 text-lg">{{ $usuario->fecha_nacimiento }}</p>
                    </div>
                </div>
            </div>
            <div class="mt-8 flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
                <a href="{{ route('usuarios.edit', $usuario->_id) }}"
                   class="inline-flex items-center justify-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition duration-300 transform hover:scale-105 card-hover"
                   data-tooltip="Editar información del usuario">
                    <i class="fas fa-edit mr-2"></i> Editar
                </a>
                <a href="{{ route('usuarios.index') }}"
                   class="inline-flex items-center justify-center px-6 py-3 bg-secondary text-white rounded-lg hover:bg-secondary-dark transition duration-300 transform hover:scale-105 card-hover"
                   data-tooltip="Volver a la lista de usuarios">
                    <i class="fas fa-arrow-left mr-2"></i> Volver
                </a>
            </div>
        </div>
    </div>
</div>
@endsection