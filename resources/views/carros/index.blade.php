@extends('layouts.app')

@section('title', 'Lista de Carros')
@section('icon', 'car')
@section('subtitle', 'Explora y gestiona tu inventario de carros')

@section('breadcrumbs')
    <li>
        <div class="flex items-center">
            <i class="fas fa-chevron-right text-gray-400"></i>
            <span class="ml-4 text-sm font-medium text-gray-500">Carros</span>
        </div>
    </li>
@endsection

@section('content')
<div class="container mx-auto px-4 py-12">
    <!-- Flash Message -->
    @if(session('success'))
        <div class="mb-6 animate__animated animate__fadeInRight animate__faster bg-green-100 border-l-4 border-green-500 text-green-700 p-4 max-w-md mx-auto rounded-lg shadow-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <p class="font-bold">Éxito</p>
                <button class="ml-auto" onclick="this.parentElement.parentElement.classList.add('hidden')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <p class="text-sm">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Search and Create -->
    <div class="max-w-4xl mx-auto mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <!-- Search Form -->
            <form method="GET" action="{{ route('carros.index') }}" class="flex-1">
                <div class="relative">
                    <input type="text" name="search" placeholder="Buscar por marca o modelo" value="{{ request('search') }}"
                           class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary-dark transition duration-300"
                           data-tooltip="Busca carros por marca o modelo">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-primary-dark"></i>
                </div>
            </form>
            <!-- Create Button -->
            <a href="{{ route('carros.create') }}"
                class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition duration-300 transform hover:scale-105 card-hover"
                data-tooltip="Agregar un nuevo carro">
                <i class="fas fa-plus mr-2"></i> Crear Carro
            </a>
        </div>
    </div>

    <!-- Cars Table -->
    <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden card-hover animate__animated animate__fadeInUp animate__delay-1s">
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-primary-light text-gray-800">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-sm uppercase">Marca</th>
                        <th class="px-6 py-4 text-left font-semibold text-sm uppercase">Modelo</th>
                        <th class="px-6 py-4 text-left font-semibold text-sm uppercase">Año</th>
                        <th class="px-6 py-4 text-left font-semibold text-sm uppercase">Precio</th>
                        <th class="px-6 py-4 text-left font-semibold text-sm uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($carros as $carro)
                        <tr class="hover:bg-primary-light/50 transition duration-200">
                            <td class="px-6 py-4">{{ $carro->marca }}</td>
                            <td class="px-6 py-4">{{ $carro->modelo }}</td>
                            <td class="px-6 py-4">{{ $carro->anio }}</td>
                            <td class="px-6 py-4">${{ number_format($carro->precio, 2) }}</td>
                            <td class="px-6 py-4 flex space-x-3">
                                <a href="{{ route('carros.show', $carro->_id) }}"
                                    class="text-primary hover:text-primary-dark transition duration-300"
                                    data-tooltip="Ver detalles del carro">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('carros.edit', $carro->_id) }}"
                                    class="text-secondary hover:text-secondary-dark transition duration-300"
                                    data-tooltip="Editar carro">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('carros.destroy', $carro->_id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-800 transition duration-300"
                                            onclick="return confirm('¿Estás seguro de eliminar este carro?')"
                                            data-tooltip="Eliminar carro">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                <i class="fas fa-car-side mr-2"></i> No se encontraron carros.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6 max-w-5xl mx-auto">
        {{ $carros->appends(request()->query())->links('vendor.pagination.tailwind') }}
    </div>
</div>
@endsection