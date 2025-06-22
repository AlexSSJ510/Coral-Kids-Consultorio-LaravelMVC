<nav x-data="{ open: false }" class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo y links -->
            <div class="flex items-center space-x-6">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('img/LogoCK - copia.jpg') }}" alt="Logo Clinica" class="w-12 h-12 rounded-full shadow" />
                </a>

                <div class="hidden sm:flex space-x-6">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m0 0h4m-4 0H5" />
                        </svg>
                        Dashboard
                    </x-nav-link>
                </div>
            </div>

            <!-- Dropdown usuario -->
            <div class="hidden sm:flex items-center space-x-4">
                <span class="text-gray-700 dark:text-gray-300 text-sm">{{ Auth::user()->name }}</span>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm text-gray-600 dark:text-gray-300 focus:outline-none">
                            <svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414L10 13.414l-4.707-4.707a1 1 0 010-1.414z" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">Perfil</x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Cerrar sesión
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Botón hamburguesa (mobile) -->
            <div class="-me-2 flex sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none transition">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menú Responsive -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                🏠 Dashboard
            </x-responsive-nav-link>
        </div>

        <div class="border-t border-gray-200 dark:border-gray-700 pt-4 pb-1 px-4">
            <div class="text-gray-800 dark:text-white text-sm font-medium">{{ Auth::user()->name }}</div>
            <div class="text-gray-500 text-xs">{{ Auth::user()->email }}</div>
        </div>

        <div class="mt-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('profile.edit')">⚙️ Perfil</x-responsive-nav-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                    🚪 Cerrar sesión
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>