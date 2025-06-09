@extends('layouts.app')

@section('title', 'Editar Carro')
@section('icon', 'car')
@section('subtitle', 'Actualiza la información del carro')

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
            <span class="ml-4 text-sm font-medium text-gray-500">Editar</span>
        </div>
    </li>
@endsection

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow-lg rounded-lg p-8 card-hover animate__animated animate__fadeInUp animate__faster">

            <div class="flex items-center mb-6"> {{-- Header like in productos.edit --}}
                <div class="bg-primary-light text-primary-dark p-3 rounded-full mr-4">
                    <i class="fas fa-car text-xl"></i> {{-- Changed icon to fa-car to match title --}}
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Editar Carro</h2>
                    <p class="text-gray-600">Actualiza la información del carro: {{ $carro->marca }} {{ $carro->modelo }}</p>
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

            <form action="{{ route('carros.update', $carro->_id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Campo: Marca --}}
                <div class="relative">
                    <label for="marca" class="flex items-center text-gray-600 font-semibold text-sm uppercase mb-2">
                        <i class="fas fa-car-side text-primary-dark mr-2"></i> Marca <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="text" name="marca" id="marca" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary-dark transition duration-300 @error('marca') border-red-500 @enderror"
                           placeholder="Ingrese la marca del carro"
                           value="{{ old('marca', $carro->marca) }}"
                           data-tooltip="Ingrese la marca del carro">
                    @error('marca')
                        <p class="mt-2 text-sm text-red-600 animate__animated animate__shakeX">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Campo: Modelo --}}
                <div class="relative">
                    <label for="modelo" class="flex items-center text-gray-600 font-semibold text-sm uppercase mb-2">
                        <i class="fas fa-car-alt text-primary-dark mr-2"></i> Modelo <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="text" name="modelo" id="modelo" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary-dark transition duration-300 @error('modelo') border-red-500 @enderror"
                           placeholder="Ingrese el modelo del carro"
                           value="{{ old('modelo', $carro->modelo) }}"
                           data-tooltip="Ingrese el modelo del carro">
                    @error('modelo')
                        <p class="mt-2 text-sm text-red-600 animate__animated animate__shakeX">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Campo: Año --}}
                <div class="relative">
                    <label for="anio" class="flex items-center text-gray-600 font-semibold text-sm uppercase mb-2">
                        <i class="fas fa-calendar-alt text-primary-dark mr-2"></i> Año <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="number" name="anio" id="anio" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary-dark transition duration-300 @error('anio') border-red-500 @enderror"
                           placeholder="Ingrese el año del carro"
                           value="{{ old('anio', $carro->anio) }}"
                           data-tooltip="Ingrese el año del carro (ej. 2023)">
                    @error('anio')
                        <p class="mt-2 text-sm text-red-600 animate__animated animate__shakeX">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Campo: Precio --}}
                <div class="relative">
                    <label for="precio" class="flex items-center text-gray-600 font-semibold text-sm uppercase mb-2">
                        <i class="fas fa-dollar-sign text-primary-dark mr-2"></i> Precio <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="number" name="precio" id="precio" required step="0.01"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary-dark transition duration-300 @error('precio') border-red-500 @enderror"
                           placeholder="Ingrese el precio del carro"
                           value="{{ old('precio', $carro->precio) }}"
                           data-tooltip="Ingrese el precio del carro (ej. 25000.00)">
                    @error('precio')
                        <p class="mt-2 text-sm text-red-600 animate__animated animate__shakeX">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Botones de Acción --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pt-6 border-t border-gray-200 mt-6">
                    <div class="flex space-x-3">
                        <button type="submit"
                                class="inline-flex items-center justify-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition duration-300 transform hover:scale-105 card-hover"
                                data-tooltip="Actualizar información del carro">
                            <i class="fas fa-save mr-2"></i> Actualizar Carro
                        </button>
                        <a href="{{ route('carros.show', $carro->_id) }}"
                           class="inline-flex items-center justify-center px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-300 transform hover:scale-105 card-hover">
                            <i class="fas fa-times mr-2"></i> Cancelar
                        </a>
                    </div>
                    <a href="{{ route('carros.index') }}" class="mt-4 sm:mt-0 inline-flex items-center text-sm text-primary hover:text-primary-dark transition-colors duration-300">
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
            // Opcional: Desplazar a la vista si es necesario
            // errorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
        } else {
            const marcaInput = document.getElementById('marca'); // Enfocar 'marca' como primer campo
            if (marcaInput) {
                marcaInput.focus();
            }
        }
        // Formatear el precio a dos decimales al perder el foco (si aplica).
        const precioInput = document.getElementById('precio');
        if (precioInput) {
            precioInput.addEventListener('blur', function () {
                const val = parseFloat(this.value);
                if (!isNaN(val)) {
                    this.value = val.toFixed(2);
                }
            });
        }
    });
</script>
@endsection