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

@section('header-actions')
<a href="{{ route('carros.create') }}"
    class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition duration-300 transform hover:scale-105 card-hover font-semibold text-xs uppercase tracking-widest">
    <i class="fas fa-plus-circle mr-2"></i> Nuevo Carro
</a>
@endsection

@section('content')
<div class="animate__animated animate__fadeIn">
    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="mb-6 animate__animated animate__bounceIn">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md flex items-center">
                <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                <div><p class="font-medium">{{ session('success') }}</p></div>
                <button class="ml-auto text-green-700 hover:text-green-900" onclick="this.parentElement.parentElement.classList.add('hidden')"><i class="fas fa-times"></i></button>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 animate__animated animate__bounceIn">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md flex items-center">
                <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3"></i>
                <div><p class="font-medium">{{ session('error') }}</p></div>
                <button class="ml-auto text-red-700 hover:text-red-900" onclick="this.parentElement.parentElement.classList.add('hidden')"><i class="fas fa-times"></i></button>
            </div>
        </div>
    @endif

    {{-- Búsqueda --}}
    <div class="bg-white rounded-lg shadow-md p-4 md:p-6 mb-6 transition-all duration-300 hover:shadow-lg">
        <form method="GET" action="{{ route('carros.index') }}" class="flex flex-col sm:flex-row items-center gap-4">
            <div class="flex-1 w-full sm:w-auto">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="search" placeholder="Buscar por marca o modelo..." value="{{ request('search') }}"
                           class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition duration-150 sm:text-sm"
                           data-tooltip="Busca carros por marca o modelo">
                </div>
            </div>
            <button type="submit"
                    class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-lg text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-150">
                <i class="fas fa-search mr-2"></i> Buscar
            </button>
        </form>
        @if(request('search'))
        <div class="mt-4 text-sm">
            <span class="text-gray-700"><strong>Búsqueda:</strong> "{{ request('search') }}"</span>
            <a href="{{ route('carros.index') }}" class="ml-3 text-primary hover:text-primary-dark underline">Limpiar búsqueda</a>
        </div>
        @endif
    </div>

    {{-- Tabla de Carros --}}
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><i class="fas fa-car-side mr-1"></i> Marca</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><i class="fas fa-car-alt mr-1"></i> Modelo</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><i class="fas fa-calendar-alt mr-1"></i> Año</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><i class="fas fa-dollar-sign mr-1"></i> Precio</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><i class="fas fa-cog mr-1"></i> Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($carros as $index => $carro)
                        <tr class="@if($index % 2 === 0) bg-white @else bg-gray-50 @endif hover:bg-gray-100 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $carro->marca }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $carro->modelo }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $carro->anio }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-semibold">${{ number_format($carro->precio, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('carros.show', $carro->_id) }}" class="p-2 text-blue-600 bg-blue-100 hover:bg-blue-200 rounded-full transition-colors duration-200" data-tooltip="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('carros.edit', $carro->_id) }}" class="p-2 text-yellow-600 bg-yellow-100 hover:bg-yellow-200 rounded-full transition-colors duration-200" data-tooltip="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('carros.destroy', $carro->_id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este carro?')" class="p-2 text-red-600 bg-red-100 hover:bg-red-200 rounded-full transition-colors duration-200" data-tooltip="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center py-10">
                                    <i class="fas {{ request('search') ? 'fa-search-minus' : 'fa-car-side' }} text-5xl text-gray-400 mb-4 animate__animated animate__bounceIn"></i>
                                    @if (request('search'))
                                        <p class="text-lg font-semibold text-gray-700">No se encontraron carros que coincidan con "{{ request('search') }}"</p>
                                        <p class="text-sm text-gray-500 mt-1">Intenta con otros términos de búsqueda.</p>
                                    @else
                                        <p class="text-lg font-semibold text-gray-700">Aún no hay carros registrados</p>
                                        <p class="text-sm text-gray-500 mt-1">Comienza agregando un nuevo carro al inventario.</p>
                                    @endif
                                    <a href="{{ route('carros.create') }}" class="mt-6 inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition duration-300 transform hover:scale-105 text-sm font-medium">
                                        <i class="fas fa-plus-circle mr-2"></i> Agregar Nuevo Carro
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Paginación --}}
    @if ($carros->hasPages())
    <div class="mt-8"> {{-- Increased margin-top for better spacing --}}
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 rounded-lg shadow-sm">
             {{-- Using default links() for consistency, or ensure vendor.pagination.tailwind is globally preferred and styled --}}
            {{ $carros->links() }}
        </div>
    </div>
    @endif
</div>
@endsection