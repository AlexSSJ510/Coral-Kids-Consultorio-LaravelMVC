<x-app-layout>
    <div class="flex flex-col min-h-screen">

        {{-- Header --}}
        <header class="bg-white dark:bg-gray-800 px-6 py-4 flex items-center justify-between shadow-md border-b border-gray-200">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('img/LogoCK - copia.jpg') }}" alt="Logo Clinica" class="w-14 h-14 rounded-full shadow-md" />
                <h1 class="text-2xl md:text-3xl font-extrabold text-blue-700 tracking-tight">Consultorio Pediátrico Coral Kids</h1>
            </div>
            <div class="text-gray-500 text-sm font-medium">
                {{ now()->format('l d \d\e F, Y') }}
            </div>
        </header>

        <div class="flex flex-1 overflow-hidden">

            {{-- Sidebar --}}
            <aside class="bg-blue-800 text-white w-64 min-h-full p-6 space-y-6">
                <div class="text-xl font-bold tracking-wide mb-8">Menú Principal</div>
                <nav class="space-y-3 text-base">
                    @php
                        $navLinks = [
                            ['route' => 'dashboard', 'label' => 'Inicio', 'icon' => 'home'],
                            ['route' => 'pacientes.index', 'label' => 'Pacientes', 'icon' => 'users'],
                            ['route' => 'citas.create', 'label' => 'Crear Cita', 'icon' => 'calendar-plus'],
                            ['route' => 'doctores.index', 'label' => 'Médicos', 'icon' => 'stethoscope'],
                            ['route' => 'profile.edit', 'label' => 'Perfil', 'icon' => 'user-circle'],
                        ];

                        $icons = [
                            'home' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 4.5l9 5.25v9a2.25 2.25 0 01-2.25 2.25h-13.5A2.25 2.25 0 013 18.75v-9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 22.5v-7.5h6v7.5" /></svg>',
                            'users' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-1a4 4 0 00-3-3.87M9 20H4v-1a4 4 0 013-3.87M12 12a4 4 0 100-8 4 4 0 000 8z" /></svg>',
                            'calendar-plus' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-7 4h4m-2 4v-4m0 0V7m0 4v4" /></svg>',
                            'stethoscope' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 8a6 6 0 11-12 0 6 6 0 0112 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14v3a3 3 0 006 0v-3" /></svg>',
                            'user-circle' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.546 0 4.91.68 6.879 1.804M12 12a5 5 0 100-10 5 5 0 000 10z" /></svg>',
                        ];
                    @endphp

                    @foreach ($navLinks as $link)
                        <a href="{{ route($link['route']) }}" class="flex items-center space-x-3 p-2 rounded-md hover:bg-blue-600 transition">
                            {!! $icons[$link['icon']] !!}
                            <span>{{ $link['label'] }}</span>
                        </a>
                    @endforeach

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center space-x-3 w-full text-left p-2 rounded-md hover:bg-red-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Cerrar sesión</span>
                        </button>
                    </form>
                </nav>
            </aside>

            {{-- Main --}}
            <main class="flex-1 bg-gray-50 dark:bg-gray-900 p-8 overflow-y-auto">
                <div class="mb-8 text-lg text-gray-700 dark:text-gray-100 font-medium">
                    ¡{{ now()->hour < 12 ? 'Buenos días' : (now()->hour < 18 ? 'Buenas tardes' : 'Buenas noches') }},
                    <span class="font-bold">{{ Auth::user()->name }}</span>!
                    Aquí puedes gestionar tus citas y datos médicos.
                </div>

                {{-- Tarjetas de acceso rápido --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <x-dashboard-card title="Gestionar Horario" link="https://calendar.google.com/calendar/u/0/r?cid={{ env('GOOGLE_CALENDAR_ID') }}" external />
                    <x-dashboard-card title="Crear Cita" :link="route('citas.create')" />
                    <x-dashboard-card title="Mis Citas" :link="route('citas.index')" />
                </div>

                {{-- Historial y Pacientes --}}
                <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <x-dashboard-card title="Historiales Médicos" :link="route('historiales.index')" />
                    <x-dashboard-card title="Crear Historial" :link="route('historiales.create')" />
                    <x-dashboard-card title="Seleccionar Paciente" :link="route('pacientes.index')" />
                </div>
            </main>
        </div>
    </div>
</x-app-layout>