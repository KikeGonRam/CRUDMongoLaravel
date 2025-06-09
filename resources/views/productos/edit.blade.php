@extends('layouts.app')

@section('title', 'Editar Producto')
@section('icon', 'edit')
@section('subtitle', 'Modifica los datos del producto')

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
        <a href="{{ route('productos.show', $producto->_id) }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-primary-dark">{{ $producto->nombre }}</a>
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
<div class="animate__animated animate__fadeIn">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden max-w-3xl mx-auto">
        <div class="p-6 md:p-8">
            <div class="flex items-center mb-6">
                <div class="bg-primary-light text-primary-dark p-3 rounded-full mr-4">
                    <i class="fas fa-edit text-xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Editar Producto</h2>
                    <p class="text-gray-600">Actualiza la información del producto {{ $producto->nombre }}</p>
                </div>
            </div>

            @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg animate__animated animate__shakeX">
                <div class="flex">
                    <i class="fas fa-exclamation-circle text-red-500 text-xl mr-2"></i>
                    <div>
                        <h3 class="text-sm font-medium text-red-800">Hay {{ $errors->count() }} error(es)</h3>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <form action="{{ route('productos.update', $producto->_id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Campo: Nombre del Producto --}}
                <div>
                    <label for="nombre" class="flex items-center text-gray-600 font-semibold text-sm uppercase mb-2">
                        <i class="fas fa-box text-primary-dark mr-2"></i> Nombre <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary-dark transition duration-300 @error('nombre') border-red-500 @enderror" required>
                    @error('nombre')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Campo: Precio del Producto --}}
                <div>
                    <label for="precio" class="flex items-center text-gray-600 font-semibold text-sm uppercase mb-2">
                        <i class="fas fa-dollar-sign text-primary-dark mr-2"></i> Precio <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="number" id="precio" name="precio" step="0.01" value="{{ old('precio', $producto->precio) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary-dark transition duration-300 @error('precio') border-red-500 @enderror" required>
                    @error('precio')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Campo: Descripción del Producto --}}
                <div>
                    <label for="descripcion" class="flex items-center text-gray-600 font-semibold text-sm uppercase mb-2">
                        <i class="fas fa-align-left text-primary-dark mr-2"></i> Descripción
                    </label>
                    <textarea id="descripcion" name="descripcion" rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary-dark transition duration-300 @error('descripcion') border-red-500 @enderror">{{ old('descripcion', $producto->descripcion) }}</textarea>
                    @error('descripcion')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Campo: Foto del Producto --}}
                <div>
                    <label for="foto" class="flex items-center text-gray-600 font-semibold text-sm uppercase mb-2">
                        <i class="fas fa-image text-primary-dark mr-2"></i> Foto del Producto
                    </label>
                    @if ($producto->foto && $producto->foto !== 'productos/default.png')
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $producto->foto) }}" alt="Foto actual del producto"
                                 class="w-32 h-32 object-cover rounded-lg shadow">
                        </div>
                        <p class="text-xs text-gray-500 mb-2">Sube una nueva imagen para reemplazar la actual, o deja el campo vacío para conservarla.</p>
                    @elseif ($producto->foto === 'productos/default.png')
                        <div class="mb-3">
                             <img src="{{ asset('storage/productos/default.png') }}" alt="Foto por defecto"
                                 class="w-32 h-32 object-cover rounded-lg shadow bg-gray-100">
                        </div>
                         <p class="text-xs text-gray-500 mb-2">Actualmente se usa la imagen por defecto. Sube una nueva imagen para reemplazarla.</p>
                    @else
                        <p class="text-xs text-gray-500 mb-2">No hay foto asignada. Sube una imagen.</p>
                    @endif
                    <input type="file" id="foto" name="foto"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary-dark transition duration-300 @error('foto') border-red-500 @enderror">
                    @error('foto')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Botones de Acción --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pt-6 border-t border-gray-200 mt-6">
                    <div class="flex space-x-3">
                        <button type="submit"
                                class="inline-flex items-center justify-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition duration-300 transform hover:scale-105 card-hover">
                            <i class="fas fa-save mr-2"></i> Actualizar Producto
                        </button>
                        <a href="{{ route('productos.show', $producto->_id) }}"
                           class="inline-flex items-center justify-center px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-300 transform hover:scale-105 card-hover">
                            <i class="fas fa-times mr-2"></i> Cancelar
                        </a>
                    </div>
                    <a href="{{ route('productos.index') }}" class="mt-4 sm:mt-0 inline-flex items-center text-sm text-primary hover:text-primary-dark transition-colors duration-300">
                        <i class="fas fa-arrow-left mr-2"></i> Volver a la lista
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Script para manejo del formulario de edición de productos
    document.addEventListener('DOMContentLoaded', function () {
        // Enfocar el primer campo con error, o el campo 'nombre' si no hay errores.
        const errorField = document.querySelector('.border-red-500'); // Asume que los campos con error tienen esta clase
        if (errorField) {
            errorField.focus();
            // Opcional: Desplazar a la vista si es necesario
            // errorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
        } else {
            const nombreInput = document.getElementById('nombre');
            if (nombreInput) {
                nombreInput.focus();
            }
        }

        // Formatear el precio a dos decimales al perder el foco.
        const precioInput = document.getElementById('precio');
        if (precioInput) {
            precioInput.addEventListener('blur', function () {
                const val = parseFloat(this.value);
                if (!isNaN(val)) {
                    this.value = val.toFixed(2); // Asegura dos decimales
                }
            });
        }
    });
</script>
@endsection
