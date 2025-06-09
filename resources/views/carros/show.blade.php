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
            <div class="mt-8 flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
                <a href="{{ route('carros.edit', $carro->_id) }}"
                   class="inline-flex items-center justify-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition duration-300 transform hover:scale-105 card-hover"
                   data-tooltip="Editar información del carro">
                    <i class="fas fa-edit mr-2"></i> Editar
                </a>
                <a href="{{ route('carros.index') }}"
                   class="inline-flex items-center justify-center px-6 py-3 bg-secondary text-white rounded-lg hover:bg-secondary-dark transition duration-300 transform hover:scale-105 card-hover"
                   data-tooltip="Volver a la lista de carros">
                    <i class="fas fa-arrow-left mr-2"></i> Volver
                </a>
            </div>
        </div>
    </div>
</div>
@endsection