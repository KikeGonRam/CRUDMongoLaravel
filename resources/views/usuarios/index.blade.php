@extends('layouts.app')

@section('title', 'Gestión de Usuarios')
@section('icon', 'users')
@section('subtitle', 'Administra los usuarios del sistema')

@section('breadcrumbs')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
        <span class="ml-4 text-sm font-medium text-gray-500">Usuarios</span>
    </div>
</li>
@endsection

@section('header-actions')
<a href="{{ route('usuarios.create') }}" 
   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary to-primary-dark border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-primary-dark hover:to-primary-darker focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
    <i class="fas fa-user-plus mr-2"></i> Nuevo Usuario
</a>
@endsection

@section('content')
<div class="animate__animated animate__fadeIn">
    <!-- Flash Message -->
    @if(session('success'))
    <div class="mb-6 animate__animated animate__bounceIn">
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md flex items-center">
            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
            <div>
                <p class="font-medium">{{ session('success') }}</p>
            </div>
            <button class="ml-auto text-green-700 hover:text-green-900" onclick="this.parentElement.classList.add('hidden')">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    @endif

    <!-- Search and Filter Card -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6 transition-all duration-300 hover:shadow-lg">
        <form method="GET" action="{{ route('usuarios.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-3">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="search" 
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm" 
                           placeholder="Buscar por nombre, email o teléfono" 
                           value="{{ request('search') }}"
                           x-data
                           x-init="$el.focus()">
                </div>
            </div>
            <div>
                <button type="submit" 
                        class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-300">
                    <i class="fas fa-filter mr-2"></i> Filtrar
                </button>
            </div>
        </form>
    </div>

    <!-- Users Table -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden animate__animated animate__fadeInUp">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:text-gray-700 transition-colors duration-200" onclick="sortTable('nombre')">
                            <div class="flex items-center">
                                <i class="fas fa-user mr-2"></i> Nombre
                                <i class="fas fa-sort ml-1 text-gray-400"></i>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:text-gray-700 transition-colors duration-200" onclick="sortTable('email')">
                            <div class="flex items-center">
                                <i class="fas fa-envelope mr-2"></i> Email
                                <i class="fas fa-sort ml-1 text-gray-400"></i>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:text-gray-700 transition-colors duration-200" onclick="sortTable('telefono')">
                            <div class="flex items-center">
                                <i class="fas fa-phone mr-2"></i> Teléfono
                                <i class="fas fa-sort ml-1 text-gray-400"></i>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-cog mr-2"></i> Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($usuarios as $usuario)
                    <tr class="hover:bg-gray-50 transition-colors duration-150 animate__animated animate__fadeIn" style="animation-delay: {{ $loop->index * 0.05 }}s">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-r from-primary-light to-secondary-light flex items-center justify-center text-white">
                                    {{ strtoupper(substr($usuario->nombre, 0, 1)) }}{{ strtoupper(substr($usuario->apellido, 0, 1)) }}
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $usuario->nombre }} {{ $usuario->apellido }}</div>
                                    <div class="text-sm text-gray-500">{{ $usuario->rol ?? 'Usuario' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $usuario->email }}</div>
                            <div class="text-sm text-gray-500">Registrado: {{ $usuario->created_at->format('d/m/Y') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                <i class="fas fa-phone-alt mr-2 text-gray-400"></i> {{ $usuario->telefono ?? 'N/A' }}
                            </div>
                            <div class="text-sm text-gray-500 mt-1">
                                @if($usuario->email_verified_at)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i> Verificado
                                </span>
                                @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-exclamation-circle mr-1"></i> No verificado
                                </span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('usuarios.show', $usuario->_id) }}" 
                                   class="text-blue-600 hover:text-blue-900 transition-colors duration-200 p-2 rounded-full hover:bg-blue-50"
                                   data-tooltip="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('usuarios.edit', $usuario->_id) }}" 
                                   class="text-yellow-600 hover:text-yellow-900 transition-colors duration-200 p-2 rounded-full hover:bg-yellow-50"
                                   data-tooltip="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('usuarios.destroy', $usuario->_id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('¿Estás seguro de eliminar este usuario permanentemente?')"
                                            class="text-red-600 hover:text-red-900 transition-colors duration-200 p-2 rounded-full hover:bg-red-50"
                                            data-tooltip="Eliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="animate__animated animate__fadeIn">
                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex flex-col items-center justify-center py-8">
                                <i class="fas fa-user-slash text-4xl text-gray-400 mb-3 animate__animated animate__bounceIn"></i>
                                <p class="text-lg font-medium text-gray-600">No se encontraron usuarios</p>
                                <p class="text-sm text-gray-500 mt-1">Intenta con otros términos de búsqueda o crea un nuevo usuario</p>
                                <a href="{{ route('usuarios.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-dark focus:bg-primary-dark active:bg-primary-darker focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150">
                                    <i class="fas fa-user-plus mr-2"></i> Crear Usuario
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
    @if($usuarios->hasPages())
    <div class="mt-6 animate__animated animate__fadeInUp">
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 rounded-b-lg shadow-sm">
            {{ $usuarios->withQueryString()->links() }}
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    // Tooltips
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-tooltip]'));
        
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            let tooltip = null;
            
            tooltipTriggerEl.addEventListener('mouseenter', function() {
                // Create tooltip element
                tooltip = document.createElement('div');
                tooltip.className = 'absolute z-50 bg-gray-800 text-white text-xs rounded py-1 px-2 whitespace-nowrap shadow-lg';
                tooltip.textContent = this.getAttribute('data-tooltip');
                tooltip.style.top = (this.getBoundingClientRect().top - 30) + 'px';
                tooltip.style.left = (this.getBoundingClientRect().left + this.offsetWidth / 2 - 50) + 'px';
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

        // Sort table function
        window.sortTable = function(column) {
            const url = new URL(window.location.href);
            let sort = url.searchParams.get('sort');
            let direction = 'asc';

            if (sort === column) {
                direction = url.searchParams.get('direction') === 'asc' ? 'desc' : 'asc';
            }

            url.searchParams.set('sort', column);
            url.searchParams.set('direction', direction);
            window.location.href = url.toString();
        };
    });
</script>
@endsection