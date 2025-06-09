@extends('layouts.app')

@section('title', 'Detalles del Carro')
@section('icon', 'car')
@section('subtitle', 'Información detallada del carro')

@section('breadcrumbs')
    <li>
        <div class="flex items-center">
            <i class="fas fa-chevron-right text-gray-400"></i>
            <a href="{{ route('carros.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Carros</a>
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
<div class="container mx-auto px-4 py-12">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow-lg rounded-lg p-8 card-hover animate__animated animate__fadeInUp animate__faster">
            <div class="flex items-center mb-6">
                <i class="fas fa-car text-primary-dark text-4xl mr-4 animate__animated animate__pulse animate__infinite animate__slow"></i>
                <h2 class="text-2xl font-bold text-gray-800">{{ $carro->marca }} {{ $carro->modelo }}</h2>
            </div>
            <div class="grid grid-cols-1 gap-6">
                <div class="flex items-center">
                    <i class="fas fa-car-side text-primary-dark text-xl mr-4"></i>
                    <div>
                        <span class="text-gray-600 font-semibold text-sm uppercase">Marca</span>
                        <p class="text-gray-800 text-lg">{{ $carro->marca }}</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-car-alt text-primary-dark text-xl mr-4"></i>
                    <div>
                        <span class="text-gray-600 font-semibold text-sm uppercase">Modelo</span>
                        <p class="text-gray-800 text-lg">{{ $carro->modelo }}</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-calendar-alt text-primary-dark text-xl mr-4"></i>
                    <div>
                        <span class="text-gray-600 font-semibold text-sm uppercase">Año</span>
                        <p class="text-gray-800 text-lg">{{ $carro->anio }}</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-dollar-sign text-primary-dark text-xl mr-4"></i>
                    <div>
                        <span class="text-gray-600 font-semibold text-sm uppercase">Precio</span>
                        <p class="text-gray-800 text-lg">${{ number_format($carro->precio, 2) }}</p>
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-6 border-t border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="flex space-x-3">
                    <a href="{{ route('carros.edit', $carro->_id) }}"
                       class="inline-flex items-center justify-center px-5 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-dark transition duration-300 transform hover:scale-105 card-hover text-sm font-medium"
                       data-tooltip="Editar información del carro">
                        <i class="fas fa-edit mr-2"></i> Editar Carro
                    </a>
                    <form action="{{ route('carros.destroy', $carro->_id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este carro permanentemente?')"
                                class="inline-flex items-center justify-center px-5 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-300 transform hover:scale-105 card-hover text-sm font-medium"
                                data-tooltip="Eliminar este carro">
                            <i class="fas fa-trash-alt mr-2"></i> Eliminar
                        </button>
                    </form>
                </div>
                <a href="{{ route('carros.index') }}"
                   class="mt-3 sm:mt-0 inline-flex items-center text-sm text-primary hover:text-primary-dark transition-colors duration-300">
                    <i class="fas fa-arrow-left mr-2"></i> Volver a la lista
                </a>
            </div>
        </div>
    </div>
</div>
@endsection