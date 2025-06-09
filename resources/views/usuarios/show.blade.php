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

            <div class="flex flex-col items-center sm:flex-row sm:items-start mb-6">
                <div class="flex-shrink-0 h-24 w-24 rounded-full bg-gradient-to-r from-primary-light to-secondary-light flex items-center justify-center text-white text-3xl font-semibold mb-4 sm:mb-0 sm:mr-6">
                    {{ strtoupper(substr($usuario->nombre, 0, 1)) }}{{ strtoupper(substr($usuario->apellido, 0, 1)) }}
                </div>
                <div class="text-center sm:text-left">
                    <h2 class="text-2xl font-bold text-gray-800">{{ $usuario->nombre }} {{ $usuario->apellido }}</h2>
                    <p class="text-sm text-gray-500">{{ $usuario->email }}</p>
                    @if($usuario->email_verified_at)
                        <span class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i> Correo Verificado
                        </span>
                    @else
                        <span class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-exclamation-circle mr-1"></i> Correo No Verificado
                        </span>
                    @endif
                </div>
            </div>

            <div class="border-t border-gray-200 pt-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 flex items-center"><i class="fas fa-phone mr-2 text-primary-dark"></i>Teléfono</dt>
                        <dd class="mt-1 text-lg text-gray-900">{{ $usuario->telefono ?? 'No especificado' }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 flex items-center"><i class="fas fa-calendar-alt mr-2 text-primary-dark"></i>Fecha de Nacimiento</dt>
                        <dd class="mt-1 text-lg text-gray-900">
                            @if($usuario->fecha_nacimiento)
                                {{ $usuario->fecha_nacimiento instanceof \Carbon\Carbon ? $usuario->fecha_nacimiento->format('d/m/Y') : \Carbon\Carbon::parse($usuario->fecha_nacimiento)->format('d/m/Y') }}
                                <span class="text-sm text-gray-500">({{ $usuario->fecha_nacimiento instanceof \Carbon\Carbon ? $usuario->fecha_nacimiento->age : \Carbon\Carbon::parse($usuario->fecha_nacimiento)->age }} años)</span>
                            @else
                                No especificada
                            @endif
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 flex items-center"><i class="fas fa-clock mr-2 text-primary-dark"></i>Miembro desde</dt>
                        <dd class="mt-1 text-lg text-gray-900">{{ $usuario->created_at->format('d/m/Y H:i') }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500 flex items-center"><i class="fas fa-user-tag mr-2 text-primary-dark"></i>Rol</dt>
                        <dd class="mt-1 text-lg text-gray-900">{{ $usuario->rol ?? 'Usuario' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="flex space-x-3">
                    <a href="{{ route('usuarios.edit', $usuario->_id) }}"
                       class="inline-flex items-center justify-center px-5 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-dark transition duration-300 transform hover:scale-105 card-hover text-sm font-medium"
                       data-tooltip="Editar información del usuario">
                        <i class="fas fa-edit mr-2"></i> Editar Usuario
                    </a>
                    <form action="{{ route('usuarios.destroy', $usuario->_id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este usuario permanentemente?')"
                                class="inline-flex items-center justify-center px-5 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-300 transform hover:scale-105 card-hover text-sm font-medium"
                                data-tooltip="Eliminar este usuario">
                            <i class="fas fa-trash-alt mr-2"></i> Eliminar
                        </button>
                    </form>
                </div>
                <a href="{{ route('usuarios.index') }}"
                   class="mt-3 sm:mt-0 inline-flex items-center text-sm text-primary hover:text-primary-dark transition-colors duration-300">
                    <i class="fas fa-arrow-left mr-2"></i> Volver a la lista
                </a>
            </div>
        </div>
    </div>
</div>
@endsection