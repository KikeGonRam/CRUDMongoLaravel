<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Avanzado - MongoDB & Laravel</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'bounce-slow': 'bounce 3s infinite',
                        'pulse-slow': 'pulse 5s infinite',
                    },
                    colors: {
                        primary: {
                            light: '#5eead4',
                            DEFAULT: '#14b8a6',
                            dark: '#0f766e',
                        },
                        secondary: {
                            light: '#bae6fd',
                            DEFAULT: '#0ea5e9',
                            dark: '#0369a1',
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <!-- Custom CSS -->
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 50%, #f0f9ff 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .nav-link {
            position: relative;
        }
        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #14b8a6;
            transition: width 0.3s ease;
        }
        .nav-link:hover:after {
            width: 100%;
        }
        .loading-spinner {
            animation: spin 1.5s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="gradient-bg min-h-screen font-sans antialiased">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg animate__animated animate__fadeInDown">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-database text-secondary-dark text-2xl mr-2"></i>
                        <span class="text-xl font-bold text-gray-800">MongoDB CRUD</span>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('welcome') }}" class="nav-link border-primary-dark text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            <i class="fas fa-home mr-1"></i> Inicio
                        </a>
                        <a href="{{ route('productos.index') }}" class="nav-link border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            <i class="fas fa-boxes mr-1"></i> Productos
                        </a>
                        <a href="{{ route('usuarios.index') }}" class="nav-link border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            <i class="fas fa-users mr-1"></i> Usuarios
                        </a>
                        <a href="{{ route('carros.index') }}" class="nav-link border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            <i class="fas fa-car mr-1"></i> Carros
                        </a>
                    </div>
                </div>
                <div class="-mr-2 flex items-center sm:hidden">
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="sm:hidden hidden" id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('welcome') }}" class="bg-primary-light border-primary-dark text-white block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    <i class="fas fa-home mr-2"></i> Inicio
                </a>
                <a href="{{ route('productos.index') }}" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    <i class="fas fa-boxes mr-2"></i> Productos
                </a>
                <a href="{{ route('usuarios.index') }}" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    <i class="fas fa-users mr-2"></i> Usuarios
                </a>
                <a href="{{ route('carros.index') }}" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    <i class="fas fa-car mr-2"></i> Carros
                </a>
            </div>
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div class="flex-shrink-0">
                        <i class="fas fa-user-circle text-3xl text-gray-400"></i>
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-800">Admin User</div>
                        <div class="text-sm font-medium text-gray-500">admin@example.com</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <a href="#" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                        <i class="fas fa-user mr-2"></i> Perfil
                    </a>
                    <a href="#" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                        <i class="fas fa-cog mr-2"></i> Configuración
                    </a>
                    <a href="#" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                        <i class="fas fa-sign-out-alt mr-2"></i> Cerrar sesión
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Flash Messages -->
        <div id="flash-messages" class="fixed top-20 right-4 z-50 space-y-2">
            <div class="hidden animate__animated animate__fadeInRight animate__faster bg-green-100 border-l-4 border-green-500 text-green-700 p-4 max-w-xs shadow-lg" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <p class="font-bold">Éxito</p>
                    <button class="ml-auto" onclick="this.parentElement.parentElement.classList.add('hidden')">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <p class="text-sm">Operación completada correctamente.</p>
            </div>
        </div>

        <!-- Page Header -->
        <div class="mb-8 animate__animated animate__fadeIn">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-@yield('icon', 'cog') text-primary-dark mr-3"></i>
                        @yield('title', 'Dashboard')
                    </h1>
                    <p class="mt-2 text-gray-600">@yield('subtitle', 'Bienvenido al panel de administración')</p>
                </div>
                <div class="flex space-x-3">
                    @yield('header-actions')
                </div>
            </div>
            <div class="mt-4">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-4">
                        <li>
                            <div>
                                <a href="{{ route('welcome') }}" class="text-gray-400 hover:text-gray-500">
                                    <i class="fas fa-home"></i>
                                    <span class="sr-only">Inicio</span>
                                </a>
                            </div>
                        </li>
                        @yield('breadcrumbs')
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Content -->
        <div class="animate__animated animate__fadeInUp animate__faster">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white mt-12 border-t border-gray-200 animate__animated animate__fadeInUp">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center">
                    <i class="fas fa-database text-primary-dark text-xl mr-2"></i>
                    <p class="text-gray-500 text-sm">© 2025 MongoDB CRUD. Todos los derechos reservados.</p>
                </div>
                <div class="mt-4 md:mt-0 flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-primary-dark transition-colors duration-300">
                        <i class="fab fa-github text-lg"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-primary-dark transition-colors duration-300">
                        <i class="fab fa-twitter text-lg"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-primary-dark transition-colors duration-300">
                        <i class="fab fa-linkedin text-lg"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        document.querySelector('[aria-controls="mobile-menu"]').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
            menu.classList.toggle('animate__slideInDown');
        });

        // Show flash message example (for demo)
        setTimeout(() => {
            const flashMsg = document.querySelector('#flash-messages div');
            if(flashMsg) {
                flashMsg.classList.remove('hidden');
                setTimeout(() => {
                    flashMsg.classList.add('animate__fadeOutRight');
                    setTimeout(() => flashMsg.classList.add('hidden'), 500);
                }, 5000);
            }
        }, 1000);

        // Tooltips
        document.querySelectorAll('[data-tooltip]').forEach(el => {
            el.addEventListener('mouseenter', showTooltip);
            el.addEventListener('mouseleave', hideTooltip);
        });

        function showTooltip(e) {
            const tooltipText = this.getAttribute('data-tooltip');
            const tooltip = document.createElement('div');
            tooltip.className = 'absolute z-50 bg-gray-800 text-white text-xs rounded py-1 px-2 whitespace-nowrap';
            tooltip.textContent = tooltipText;
            tooltip.style.top = `${e.clientY + 10}px`;
            tooltip.style.left = `${e.clientX + 10}px`;
            tooltip.id = 'current-tooltip';
            document.body.appendChild(tooltip);
        }

        function hideTooltip() {
            const tooltip = document.getElementById('current-tooltip');
            if(tooltip) tooltip.remove();
        }
    </script>
    
    @yield('scripts')
</body>
</html>