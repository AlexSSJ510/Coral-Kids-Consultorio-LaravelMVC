<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
        <h1 class="text-3xl font-bold text-blue-700 mb-6">Registrar Nuevo Doctor</h1>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('doctores.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="nombre" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Nombre completo</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" 
                       class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       placeholder="Ej. Dr. Juan Pérez" required>
            </div>

            <div>
                <label for="especialidad" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Especialidad</label>
                <input type="text" name="especialidad" id="especialidad" value="{{ old('especialidad') }}" 
                       class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       placeholder="Ej. Pediatría" required>
            </div>

            <div class="mb-6">
                <label for="email" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Correo electrónico</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" 
                       class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       placeholder="Ej. correo@gmail.com" required>
            </div>  

            <div>
                <label for="telefono" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Teléfono</label>
                <input type="tel" name="telefono" id="telefono" value="{{ old('telefono') }}" 
                       class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       placeholder="Ej. +51 987654321" required>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('doctores.index') }}" 
                   class="px-4 py-2 border border-gray-400 rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition">Cancelar</a>
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition font-semibold">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>