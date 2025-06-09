@extends('layouts.app')

@section('title', 'Bienvenido al Sistema CRUD')
@section('icon', 'database')
@section('subtitle', 'Gestiona tus productos, usuarios y carros con facilidad')

@section('breadcrumbs')
    <li>
        <div class="flex items-center">
            <i class="fas fa-chevron-right text-gray-400"></i>
            <span class="ml-4 text-sm font-medium text-gray-500">Inicio</span>
        </div>
    </li>
@endsection

@section('content')
<div class="container mx-auto px-4 py-12">
    <!-- Hero Section -->
    <div class="text-center mb-16 animate__animated animate__fadeInDown animate__delay-1s">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 flex justify-center items-center">
            <i class="fas fa-database text-primary-dark text-5xl mr-4 animate__animated animate__pulse animate__infinite animate__slow"></i>
            Sistema CRUD Avanzado
        </h1>
        <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">
            Descubre una forma <span class="text-primary font-semibold">intuitiva</span> y <span class="text-primary font-semibold">poderosa</span> de administrar tus <span class="font-semibold">productos</span>, <span class="font-semibold">usuarios</span> y <span class="font-semibold">carros</span> con nuestra interfaz moderna.
        </p>
    </div>

    <!-- Feature Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
        <!-- Productos Card -->
        <a href="{{ route('productos.index') }}"
           class="group bg-white shadow-lg rounded-lg p-8 card-hover animate__animated animate__fadeInLeft animate__delay-2s flex flex-col items-center text-center transition-all duration-300 hover:bg-primary-light"
           data-tooltip="Gestiona tu inventario de productos">
            <div class="flex-shrink-0 mb-4">
                <i class="fas fa-boxes text-5xl text-primary-dark group-hover:text-primary-dark animate__animated animate__bounce animate__infinite animate__slow"></i>
            </div>
            <div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-3">Gestión de Productos</h3>
                <p class="text-gray-600">Crea, edita y organiza tu inventario con herramientas diseñadas para maximizar la eficiencia.</p>
            </div>
        </a>

        <!-- Usuarios Card -->
        <a href="{{ route('usuarios.index') }}"
           class="group bg-white shadow-lg rounded-lg p-8 card-hover animate__animated animate__fadeInUp animate__delay-2s flex flex-col items-center text-center transition-all duration-300 hover:bg-primary-light"
           data-tooltip="Administra los usuarios del sistema">
            <div class="flex-shrink-0 mb-4">
                <i class="fas fa-users text-5xl text-primary-dark group-hover:text-primary-dark animate__animated animate__bounce animate__infinite animate__slow"></i>
            </div>
            <div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-3">Gestión de Usuarios</h3>
                <p class="text-gray-600">Controla los perfiles, datos y permisos de los usuarios con total seguridad.</p>
            </div>
        </a>

        <!-- Carros Card -->
        <a href="{{ route('carros.index') }}"
           class="group bg-white shadow-lg rounded-lg p-8 card-hover animate__animated animate__fadeInRight animate__delay-2s flex flex-col items-center text-center transition-all duration-300 hover:bg-primary-light"
           data-tooltip="Administra tu inventario de carros">
            <div class="flex-shrink-0 mb-4">
                <i class="fas fa-car text-5xl text-primary-dark group-hover:text-primary-dark animate__animated animate__bounce animate__infinite animate__slow"></i>
            </div>
            <div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-3">Gestión de Carros</h3>
                <p class="text-gray-600">Crea, edita y organiza tus carros con herramientas optimizadas para tu inventario.</p>
            </div>
        </a>
    </div>

    <!-- Call to Action -->
    <div class="text-center mt-16 animate__animated animate__fadeInUp animate__delay-3s">
        <a href="{{ route('carros.index') }}"
           class="inline-flex items-center px-8 py-4 bg-primary text-white rounded-lg hover:bg-primary-dark transition duration-300 transform hover:scale-105 card-hover text-lg font-semibold"
           data-tooltip="Comienza a gestionar ahora">
            <i class="fas fa-rocket mr-3"></i> ¡Comienza Ahora!
        </a>
    </div>

    <!-- Stats Section -->
    <div class="mt-16 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 max-w-5xl mx-auto">
        <div class="bg-white shadow-lg rounded-lg p-6 card-hover animate__animated animate__zoomIn animate__delay-4s text-center">
            <i class="fas fa-box text-3xl text-primary-dark mb-3"></i>
            <h4 class="text-xl font-semibold text-gray-800">Productos</h4>
            <p class="text-2xl font-bold text-primary">{{ \App\Models\Producto::count() }}</p>
        </div>
        <div class="bg-white shadow-lg rounded-lg p-6 card-hover animate__animated animate__zoomIn animate__delay-4s text-center">
            <i class="fas fa-user text-3xl text-primary-dark mb-3"></i>
            <h4 class="text-xl font-semibold text-gray-800">Usuarios</h4>
            <p class="text-2xl font-bold text-primary">{{ \App\Models\Usuario::count() }}</p>
        </div>
        <div class="bg-white shadow-lg rounded-lg p-6 card-hover animate__animated animate__zoomIn animate__delay-4s text-center">
            <i class="fas fa-car text-3xl text-primary-dark mb-3"></i>
            <h4 class="text-xl font-semibold text-gray-800">Carros</h4>
            <p class="text-2xl font-bold text-primary">{{ \App\Models\Carro::count() }}</p>
        </div>
        <div class="bg-white shadow-lg rounded-lg p-6 card-hover animate__animated animate__zoomIn animate__delay-4s text-center">
            <i class="fas fa-shield-alt text-3xl text-primary-dark mb-3"></i>
            <h4 class="text-xl font-semibold text-gray-800">Seguridad</h4>
            <p class="text-2xl font-bold text-primary">100%</p>
        </div>
    </div>
</div>
@endsection