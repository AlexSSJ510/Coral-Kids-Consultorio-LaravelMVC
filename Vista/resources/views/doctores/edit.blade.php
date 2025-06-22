<x-app-layout>
    <div class="max-w-3xl mx-auto p-8 bg-white dark:bg-gray-900 rounded-2xl shadow-lg transition-all duration-300">
        
        <h1 class="text-4xl font-bold text-yellow-600 dark:text-yellow-400 mb-8 flex items-center gap-2">
            🛠️ Editar Doctor: <span class="text-gray-900 dark:text-white">{{ $doctor->nombre }}</span>
        </h1>

        @if ($errors->any())
            <div class="mb-6 p-5 border-l-4 border-red-500 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-lg shadow-sm">
                <h2 class="font-semibold mb-2">Se encontraron los siguientes errores:</h2>
                <ul class="list-disc pl-6 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('doctores.update', $doctor->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-400 dark:text-gray-300 mb-1">
                    Nombre completo
                </label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $doctor->nombre) }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-300 dark:text-white focus:outline-none focus:ring-2 focus:ring-yellow-500"
                    placeholder="Ej. Dr. Juan Pérez" required>
            </div>

            <div>
                <label for="especialidad" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Especialidad
                </label>
                <input type="text" name="especialidad" id="especialidad" value="{{ old('especialidad', $doctor->especialidad) }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-300 dark:text-white focus:outline-none focus:ring-2 focus:ring-yellow-500"
                    placeholder="Ej. Pediatría" required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Correo electrónico
                </label>
                <input type="email" name="email" id="email" value="{{ old('email', $doctor->email) }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-300 dark:text-white focus:outline-none focus:ring-2 focus:ring-yellow-500"
                    placeholder="Ej. doctor@gmail.com" required>
            </div>

            <div>
                <label for="telefono" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Teléfono
                </label>
                <input type="tel" name="telefono" id="telefono" value="{{ old('telefono', $doctor->telefono) }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-300 dark:text-white focus:outline-none focus:ring-2 focus:ring-yellow-500"
                    placeholder="Ej. +51 987654321" required>
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('doctores.index') }}"
                   class="inline-flex items-center px-5 py-2.5 rounded-xl border border-gray-400 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition font-medium">
                    Cancelar
                </a>
                <button type="submit"
                        class="inline-flex items-center px-6 py-2.5 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-white font-semibold transition">
                    💾 Actualizar Doctor
                </button>
            </div>
        </form>
    </div>
</x-app-layout>