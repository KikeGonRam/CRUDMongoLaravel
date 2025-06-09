@extends('layouts.app')

@section('title', 'Gestión de Productos')
@section('icon', 'box-open')
@section('subtitle', 'Administra el inventario de productos')

@section('breadcrumbs')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
        <a href="{{ route('productos.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-primary-dark">Productos</a>
    </div>
</li>
@endsection

@section('header-actions')
<a href="{{ route('productos.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-dark border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-darker focus:bg-primary-darker active:bg-primary-darker focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150 animate__animated animate__pulse animate__infinite animate__slower">
    <i class="fas fa-plus-circle mr-2"></i> Nuevo Producto
</a>
@endsection

@section('content')
<div class="animate__animated animate__fadeIn">
    @if(session('success'))
        <div class="mb-6 animate__animated animate__bounceIn">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3 text-xl"></i>
                    <div>
                        <p class="font-bold">¡Éxito!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                    <button class="ml-auto text-green-700 hover:text-green-900" onclick="this.parentElement.parentElement.classList.add('hidden')">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 animate__animated animate__bounceIn">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-3 text-xl"></i>
                    <div>
                        <p class="font-bold">¡Error!</p>
                        <p>{{ session('error') }}</p>
                    </div>
                    <button class="ml-auto text-red-700 hover:text-red-900" onclick="this.parentElement.parentElement.classList.add('hidden')">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Search Form -->
    <div class="mb-6">
        <form action="{{ route('productos.index') }}" method="GET" class="flex items-center space-x-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre..." class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
            </div>
            <button type="submit" class="px-4 py-2 bg-primary-dark text-white rounded-md hover:bg-primary-darker transition ease-in-out duration-150">
                <i class="fas fa-search mr-2"></i> Buscar
            </button>
        </form>
    </div>

    @if(request('search') || request('sort'))
        <div class="mb-4 text-sm text-gray-600">
            @if(request('search'))
                <span><strong>Búsqueda:</strong> "{{ request('search') }}"</span>
            @endif
            @if(request('sort'))
                <span class="ml-2"><strong>Ordenado por:</strong> 
                    {{ ucfirst(str_replace('_', ' ', request('sort'))) }} 
                    ({{ request('direction') === 'asc' ? 'Ascendente' : 'Descendente' }})
                </span>
            @endif
            <a href="{{ route('productos.index') }}" class="ml-4 text-blue-600 hover:underline">Limpiar filtros</a>
        </div>
    @endif

    <!-- Product Table -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg transition-all duration-300 hover:shadow-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <a href="{{ route('productos.index', array_merge(request()->query(), ['sort' => 'nombre', 'direction' => request('sort') == 'nombre' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center">
                                <i class="fas fa-tag mr-1"></i> Nombre
                                @if(request('sort') == 'nombre')
                                    <i class="fas {{ request('direction') == 'asc' ? 'fa-sort-up' : 'fa-sort-down' }} ml-1"></i>
                                @endif
                            </a>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-align-left mr-1"></i> Descripción
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-image mr-1"></i> Foto
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <a href="{{ route('productos.index', array_merge(request()->query(), ['sort' => 'precio', 'direction' => request('sort') == 'precio' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center">
                                <i class="fas fa-dollar-sign mr-1"></i> Precio
                                @if(request('sort') == 'precio')
                                    <i class="fas {{ request('direction') == 'asc' ? 'fa-sort-up' : 'fa-sort-down' }} ml-1"></i>
                                @endif
                            </a>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <a href="{{ route('productos.index', array_merge(request()->query(), ['sort' => 'created_at', 'direction' => request('sort') == 'created_at' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center">
                                <i class="fas fa-clock mr-1"></i> Fecha Creación
                                @if(request('sort') == 'created_at')
                                    <i class="fas {{ request('direction') == 'asc' ? 'fa-sort-up' : 'fa-sort-down' }} ml-1"></i>
                                @endif
                            </a>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-cog mr-1"></i> Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($productos as $index => $producto)
                        <tr class="@if($index % 2 === 0) bg-white @else bg-gray-50 @endif hover:bg-gray-100 transition-colors duration-200 animate__animated animate__fadeIn" style="animation-delay: {{ $index * 0.05 }}s">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-primary-light flex items-center justify-center text-primary-dark">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $producto->nombre }}</div>
                                        <div class="text-sm text-gray-500">ID: {{ $producto->_id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-normal text-sm text-gray-700">
                                {{ $producto->descripcion ?? 'Sin descripción' }}
                            </td>
<td class="px-6 py-4 whitespace-nowrap">
    <img src="{{ $producto->foto ? asset('storage/' . $producto->foto) : asset('storage/productos/default.png') }}" alt="Foto" class="w-16 h-16 object-cover rounded shadow">
</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 font-semibold">${{ number_format($producto->precio, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $producto->created_at->format('d/m/Y H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('productos.show', $producto->_id) }}" class="text-blue-600 hover:text-blue-900 transition-colors duration-200" data-tooltip="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('productos.edit', $producto->_id) }}" class="text-yellow-600 hover:text-yellow-900 transition-colors duration-200" data-tooltip="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('productos.destroy', $producto->_id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este producto?')" class="text-red-600 hover:text-red-900 transition-colors duration-200" data-tooltip="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="animate__animated animate__fadeIn">
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                <div class="flex flex-col items-center justify-center py-8">
                                    <i class="fas fa-box-open text-4xl text-gray-400 mb-3 animate__animated animate__bounceIn"></i>
                                    <p class="text-lg font-medium text-gray-600">No hay productos registrados</p>
                                    <p class="text-sm text-gray-500 mt-1">Comienza agregando un nuevo producto</p>
                                    <a href="{{ route('productos.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-dark focus:bg-primary-dark active:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150">
                                        <i class="fas fa-plus-circle mr-2"></i> Crear Producto
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6 animate__animated animate__fadeInUp">
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 rounded-b-lg shadow-sm">
            {{ $productos->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-tooltip]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            let tooltip = null;
            tooltipTriggerEl.addEventListener('mouseenter', function() {
                tooltip = document.createElement('div');
                tooltip.className = 'absolute z-50 bg-gray-800 text-white text-xs rounded py-1 px-2 whitespace-nowrap';
                tooltip.textContent = this.getAttribute('data-tooltip');
                tooltip.style.top = (this.getBoundingClientRect().top - 30) + 'px';
                tooltip.style.left = (this.getBoundingClientRect().left + this.offsetWidth / 2 - tooltip.offsetWidth / 2) + 'px';
                tooltip.classList.add('animate__animated', 'animate__fadeIn', 'animate__faster');
                document.body.appendChild(tooltip);
            });

            tooltipTriggerEl.addEventListener('mouseleave', function() {
                if (tooltip) {
                    tooltip.classList.add('animate__fadeOut');
                    setTimeout(() => {
                        tooltip.remove();
                        tooltip = null;
                    }, 200);
                }
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const firstError = document.querySelector('.error');
        if (firstError) {
            firstError.focus();
        } else {
            const firstInput = document.querySelector('input, select, textarea');
            if (firstInput) {
                firstInput.focus();
            }
        }
    });
</script>
@endsection