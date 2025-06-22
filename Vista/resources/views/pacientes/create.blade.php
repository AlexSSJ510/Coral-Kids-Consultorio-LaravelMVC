<x-app-layout>
    <div class="py-10 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-5xl mx-auto px-6">
            <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-md border border-gray-200 dark:border-gray-700 transition transform hover:-translate-y-1 duration-300">
                <div class="flex items-center space-x-4 mb-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 1.657-1.343 3-3 3S6 12.657 6 11s1.343-3 3-3 3 1.343 3 3zm0 0c0 1.657 1.343 3 3 3s3-1.343 3-3-1.343-3-3-3-3 1.343-3 3zM6 21v-2a4 4 0 014-4h4a4 4 0 014 4v2" />
                    </svg>
                    <h2 class="text-3xl font-extrabold text-blue-700 dark:text-blue-400">Agregar Nuevo Paciente</h2>
                </div>

                <form action="{{ route('pacientes.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="dni" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">DNI</label>
                            <input type="text" name="dni" id="dni" class="input-style" required>
                        </div>

                        <div>
                            <label for="nombre" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="input-style" required>
                        </div>

                        <div>
                            <label for="apellidos" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" class="input-style" required>
                        </div>

                        <div>
                            <label for="fecha_nacimiento" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Fecha de Nacimiento</label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="input-style" required>
                        </div>

                        <div class="md:col-span-2">
                            <label for="direccion" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Dirección</label>
                            <input type="text" name="direccion" id="direccion" class="input-style">
                        </div>

                        <div>
                            <label for="telefono" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" class="input-style" required>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Email</label>
                            <input type="email" name="email" id="email" class="input-style" required>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4 pt-6">
                        <a href="{{ route('pacientes.index') }}"
                           class="inline-flex items-center px-5 py-2 rounded-lg bg-gray-500 hover:bg-gray-700 text-white font-semibold transition duration-200">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-800 text-white font-semibold transition duration-200">
                            Guardar Paciente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Estilos personalizados --}}
    <style>
        .input-style {
            @apply w-full px-4 py-2 rounded-lg bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200;
        }
    </style>
</x-app-layout>