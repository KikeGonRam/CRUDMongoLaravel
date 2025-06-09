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

                <!-- Nombre -->
                <div>
                    <label for="nombre" class="block font-semibold mb-1">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}"
                        class="w-full px-4 py-2 border rounded-md @error('nombre') border-red-500 @enderror" required>
                    @error('nombre')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Precio -->
                <div>
                    <label for="precio" class="block font-semibold mb-1">Precio</label>
                    <input type="number" id="precio" name="precio" step="0.01" value="{{ old('precio', $producto->precio) }}"
                        class="w-full px-4 py-2 border rounded-md @error('precio') border-red-500 @enderror" required>
                    @error('precio')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Descripción -->
                <div>
                    <label for="descripcion" class="block font-semibold mb-1">Descripción</label>
                    <textarea id="descripcion" name="descripcion" rows="4"
                        class="w-full px-4 py-2 border rounded-md @error('descripcion') border-red-500 @enderror">{{ old('descripcion', $producto->descripcion) }}</textarea>
                    @error('descripcion')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Foto -->
                <div>
                    <label for="foto" class="block font-semibold mb-1">Foto del Producto</label>
                    @if (!empty($producto->foto))
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $producto->foto) }}" alt="Foto actual del producto"
                                 class="w-32 h-32 object-cover rounded shadow">
                        </div>
                    @endif
                    <input type="file" id="foto" name="foto"
                        class="w-full px-3 py-2 border rounded-md @error('foto') border-red-500 @enderror">
                    @error('foto')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Acciones -->
                <div class="flex flex-wrap gap-3 pt-4 border-t border-gray-200">
                    <button type="submit" class="px-6 py-2 bg-primary text-white rounded hover:bg-primary-dark transition">
                        <i class="fas fa-save mr-2"></i> Actualizar
                    </button>
                    <a href="{{ route('productos.show', $producto->_id) }}" class="px-6 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
                        <i class="fas fa-times mr-2"></i> Cancelar
                    </a>
                    <a href="{{ route('productos.index') }}" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition ml-auto">
                        <i class="fas fa-arrow-left mr-2"></i> Lista de Productos
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const errorField = document.querySelector('.border-red-500');
        if (errorField) {
            errorField.focus();
        } else {
            document.getElementById('nombre').focus();
        }

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
