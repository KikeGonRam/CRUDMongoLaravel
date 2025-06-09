@extends('layouts.app')

@section('title', 'Crear Nuevo Producto')
@section('icon', 'boxes')
@section('subtitle', 'Agregar un nuevo producto al inventario')

@section('breadcrumbs')
    <li>
        <div class="flex items-center">
            <i class="fas fa-chevron-right text-gray-400"></i>
            <a href="{{ route('productos.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Productos</a>
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
<div class="container mx-auto px-4 py-12">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow-lg rounded-lg p-8 card-hover animate__animated animate__fadeInUp animate__faster">
            @if ($errors->any())
                <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg animate__animated animate__shakeX">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <p class="font-bold">Errores</p>
                    </div>
                    <ul class="mt-2 text-sm list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Nombre -->
                <div class="relative">
                    <label for="nombre" class="flex items-center text-gray-600 font-semibold text-sm uppercase mb-2">
                        <i class="fas fa-box text-primary-dark mr-2"></i> Nombre
                    </label>
                    <input type="text" name="nombre" id="nombre" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary-dark transition duration-300 @error('nombre') border-red-500 @enderror"
                           placeholder="Ingrese el nombre del producto"
                           value="{{ old('nombre') }}">
                    @error('nombre')
                        <p class="mt-2 text-sm text-red-600 animate__animated animate__shakeX">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Precio -->
                <div class="relative">
                    <label for="precio" class="flex items-center text-gray-600 font-semibold text-sm uppercase mb-2">
                        <i class="fas fa-dollar-sign text-primary-dark mr-2"></i> Precio
                    </label>
                    <input type="number" name="precio" id="precio" required step="0.01"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary-dark transition duration-300 @error('precio') border-red-500 @enderror"
                            placeholder="Ingrese el precio del producto"
                            value="{{ old('precio') }}">
                    @error('precio')
                        <p class="mt-2 text-sm text-red-600 animate__animated animate__shakeX">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Descripción -->
                <div class="relative">
                    <label for="descripcion" class="flex items-center text-gray-600 font-semibold text-sm uppercase mb-2">
                        <i class="fas fa-align-left text-primary-dark mr-2"></i> Descripción
                    </label>
                    <textarea name="descripcion" id="descripcion" rows="4"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary-dark transition duration-300 @error('descripcion') border-red-500 @enderror"
                                placeholder="Ingrese una breve descripción del producto">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="mt-2 text-sm text-red-600 animate__animated animate__shakeX">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Foto -->
                <div class="relative">
                    <label for="foto" class="flex items-center text-gray-600 font-semibold text-sm uppercase mb-2">
                        <i class="fas fa-image text-primary-dark mr-2"></i> Foto
                    </label>
                    <input type="file" name="foto" id="foto"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary-dark transition duration-300 @error('foto') border-red-500 @enderror">
                    @error('foto')
                        <p class="mt-2 text-sm text-red-600 animate__animated animate__shakeX">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
                    <button type="submit"
                            class="inline-flex items-center justify-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition duration-300 transform hover:scale-105 card-hover">
                        <i class="fas fa-save mr-2"></i> Guardar
                    </button>
                    <a href="{{ route('productos.index') }}"
                       class="inline-flex items-center justify-center px-6 py-3 bg-secondary text-white rounded-lg hover:bg-secondary-dark transition duration-300 transform hover:scale-105 card-hover">
                        <i class="fas fa-arrow-left mr-2"></i> Volver
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
