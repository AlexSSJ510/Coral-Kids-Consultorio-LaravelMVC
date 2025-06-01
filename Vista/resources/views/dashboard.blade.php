<x-app-layout>
    <div class="flex flex-col min-h-screen">

        {{-- Header --}}
        <header class="bg-white dark:bg-gray-800 p-4 flex items-center justify-between shadow-md">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('img/LogoCK - copia.jpg') }}" alt="Logo Clinica" class="w-16 h-16 rounded-full" />
                <h1 class="text-3xl font-extrabold text-blue-700 select-none">CONSULTORIO PEDIÁTRICO CORAL KIDS</h1>
            </div>
            <div class="text-gray-600 dark:text-gray-300 text-sm select-none">
                {{ now()->format('d/m/Y') }}
            </div>
        </header>

        <div class="flex flex-1 overflow-hidden">

            {{-- Sidebar --}}
            <aside class="bg-blue-900 text-white w-64 flex flex-col p-6 space-y-8 overflow-y-auto">

                <div class="text-2xl font-extrabold tracking-wide mb-8 select-none">CITAS-C.S.</div>

                <nav class="flex flex-col space-y-3 text-lg" aria-label="Main Navigation">

                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center space-x-2 hover:bg-blue-700 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <!-- Home Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 4.5l9 5.25v9a2.25 2.25 0 01-2.25 2.25h-13.5A2.25 2.25 0 013 18.75v-9z" />
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 22.5v-7.5h6v7.5" />
                        </svg>
                        <span>Inicio</span>
                    </a>

                    <a href="{{ route('pacientes.index') }}" 
                       class="flex items-center space-x-2 hover:bg-blue-700 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <!-- Users Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-1a4 4 0 00-3-3.87M9 20H4v-1a4 4 0 013-3.87M12 12a4 4 0 100-8 4 4 0 000 8z" />
                        </svg>
                        <span>Pacientes</span>
                    </a>

                    <a href="{{ route('citas.create') }}" 
                       class="flex items-center space-x-2 hover:bg-blue-700 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <!-- Calendar Plus Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-7 4h4m-2 4v-4m0 0V7m0 4v4" />
                        </svg>
                        <span>Crear Cita</span>
                    </a>

                    <a href="{{ route('doctores.index') }}" 
                       class="flex items-center space-x-2 hover:bg-blue-700 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <!-- Stethoscope Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 8a6 6 0 11-12 0 6 6 0 0112 0z" />
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14v3a3 3 0 006 0v-3" />
                        </svg>
                        <span>Médicos</span>
                    </a>

                    <a href="{{ route('profile.edit') }}" 
                       class="flex items-center space-x-2 hover:bg-blue-700 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <!-- User Circle Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.546 0 4.91.68 6.879 1.804M12 12a5 5 0 100-10 5 5 0 000 10z" />
                        </svg>
                        <span>Perfil</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                            class="flex items-center space-x-2 hover:bg-red-600 rounded p-2 w-full text-left focus:outline-none focus:ring-2 focus:ring-red-400">
                            <!-- Logout Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Cerrar sesión</span>
                        </button>
                    </form>

                </nav>
            </aside>

            {{-- Main content --}}
            <main class="flex-1 bg-gray-100 dark:bg-gray-900 p-10 overflow-auto">

                <div class="mb-6 text-gray-800 dark:text-gray-200 text-lg">
                    ¡{{ (now()->hour < 12) ? 'Buenos días' : (now()->hour < 18 ? 'Buenas tardes' : 'Buenas noches') }}! 
                    <span class="font-bold">{{ Auth::user()->name }}</span>, aquí puedes administrar tus citas y hacer seguimiento.
                </div>
            
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
                    <div class="bg-white dark:bg-gray-800 shadow rounded-2xl p-6 hover:shadow-lg transition cursor-pointer">
                        <h2 class="text-xl font-semibold mb-4">Gestionar Horario</h2>
                        <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Ir al panel</a>
                    </div>
            
                    <div class="bg-white dark:bg-gray-800 shadow rounded-2xl p-6 hover:shadow-lg transition cursor-pointer">
                        <h2 class="text-xl font-semibold mb-4">Crear Cita</h2>
                        <a href="{{ route('citas.create') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Ir al panel</a>
                    </div>
            
                    <div class="bg-white dark:bg-gray-800 shadow rounded-2xl p-6 hover:shadow-lg transition cursor-pointer">
                        <h2 class="text-xl font-semibold mb-4">Mis Citas</h2>
                        <a href="{{ route('citas.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Ir al panel</a>
                    </div>
            
                </div>
            
                {{-- NUEVAS OPCIONES PARA HISTORIALES Y PACIENTES --}}
                <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
            
                    <div class="bg-white dark:bg-gray-800 shadow rounded-2xl p-6 hover:shadow-lg transition cursor-pointer">
                        <h2 class="text-xl font-semibold mb-4">Historiales Médicos</h2>
                        <a href="{{ route('historiales.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Ver todos</a>
                    </div>
            
                    <div class="bg-white dark:bg-gray-800 shadow rounded-2xl p-6 hover:shadow-lg transition cursor-pointer">
                        <h2 class="text-xl font-semibold mb-4">Crear Nuevo Historial</h2>
                        <a href="{{ route('historiales.create') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Agregar historial</a>
                    </div>
            
                    <div class="bg-white dark:bg-gray-800 shadow rounded-2xl p-6 hover:shadow-lg transition cursor-pointer">
                        <h2 class="text-xl font-semibold mb-4">Seleccionar Paciente</h2>
                        <a href="{{ route('pacientes.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Buscar paciente</a>
                    </div>
                </div>
            </main>            
        </div>
    </div>
</x-app-layout>