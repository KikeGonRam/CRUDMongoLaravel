@extends('layouts.app')

@section('title', 'Detalle de Producto')
@section('icon', 'info-circle')
@section('subtitle', 'Información detallada del producto')

@section('breadcrumbs')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
        <a href="{{ route('productos.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-primary-dark">Productos</a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
        <span class="ml-4 text-sm font-medium text-gray-500">{{ $producto->nombre }}</span>
    </div>
</li>
@endsection

@section('content')
<div class="animate__animated animate__fadeIn">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden transform transition-all duration-300 hover:shadow-xl">
        <div class="md:flex">
            {{-- Sección de Imagen del Producto --}}
            <div class="md:w-1/3 bg-gray-100 flex items-center justify-center p-8">
                @if ($producto->foto)
                    <img src="{{ asset('storage/' . $producto->foto) }}" alt="Imagen del producto" class="object-cover w-full h-64 rounded-lg shadow-md">
                @else
                    <div class="relative w-full h-64 md:h-auto">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-light to-secondary-light opacity-20 rounded-lg"></div>
                        <i class="fas fa-box-open text-6xl md:text-8xl text-primary-dark absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></i>
                    </div>
                @endif
            </div>

            {{-- Sección de Información del Producto --}}
            <div class="md:w-2/3 p-6 md:p-8">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-1">{{ $producto->nombre }}</h2>
                        <div class="flex items-center mb-4">
                            <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full uppercase font-semibold tracking-wide">
                                <i class="fas fa-check-circle mr-1"></i> Activo
                            </span>
                            <span class="ml-2 text-gray-500 text-sm">
                                <i class="fas fa-hashtag mr-1"></i> ID: {{ $producto->_id }}
                            </span>
                        </div>
                    </div>
                    <div class="bg-primary-light text-primary-dark text-2xl font-bold px-4 py-2 rounded-lg animate__animated animate__pulse animate__infinite animate__slower">
                        ${{ number_format($producto->precio, 2) }}
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Fecha de creación --}}
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-500 mb-2 flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i> Fecha de creación
                        </h3>
                        <p class="text-gray-800">{{ $producto->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    {{-- Última actualización --}}
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-500 mb-2 flex items-center">
                            <i class="fas fa-sync-alt mr-2"></i> Última actualización
                        </h3>
                        <p class="text-gray-800">{{ $producto->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                {{-- Descripción del Producto --}}
                <div class="mt-6">
                    <h3 class="text-sm font-medium text-gray-500 mb-2 flex items-center">
                        <i class="fas fa-align-left mr-2"></i> Descripción
                    </h3>
                    <p class="text-gray-800 bg-gray-50 p-4 rounded-lg whitespace-pre-line">
                        {{ $producto->descripcion ?? 'No hay descripción disponible' }}
                    </p>
                </div>

                {{-- Botones de Acción --}}
                <div class="mt-8 flex flex-col sm:flex-row sm:items-center gap-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('productos.edit', $producto->_id) }}"
                       class="inline-flex items-center justify-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition duration-300 transform hover:scale-105 card-hover text-sm">
                        <i class="fas fa-edit mr-2"></i> Editar Producto
                    </a>
                    <form action="{{ route('productos.destroy', $producto->_id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este producto permanentemente?')"
                                class="inline-flex items-center justify-center px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-300 transform hover:scale-105 card-hover text-sm">
                            <i class="fas fa-trash-alt mr-2"></i> Eliminar Producto
                        </button>
                    </form>
                    <a href="{{ route('productos.index') }}" class="sm:ml-auto mt-4 sm:mt-0 inline-flex items-center text-sm text-primary hover:text-primary-dark transition-colors duration-300">
                        <i class="fas fa-arrow-left mr-2"></i> Volver a la lista
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Script para animar el precio del producto
    document.addEventListener('DOMContentLoaded', function() {
        const priceElement = document.querySelector('.bg-primary-light.text-primary-dark'); // Selector más específico para el precio
        if (priceElement) { // Verificar que el elemento exista
            setInterval(() => {
                priceElement.classList.toggle('animate__pulse');
            }, 3000); // Alterna la animación cada 3 segundos
        }
    });
</script>
@endsection
