<x-app-layout>
    <div class="max-w-7xl mx-auto p-6 bg-white dark:bg-gray-900 rounded-2xl shadow-lg transition-all duration-300">
        
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-blue-700 dark:text-blue-400">👨‍⚕️ Doctores Registrados</h1>
            <a href="{{ route('doctores.create') }}" 
               class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-xl shadow transition">
                ➕ Nuevo Doctor
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 rounded-lg bg-green-100 border border-green-300 text-green-800 dark:bg-green-900 dark:text-green-200">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-lg shadow-sm">
            <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-sm text-left">
                <thead class="bg-blue-600 text-white uppercase tracking-wider text-xs">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Nombre</th>
                        <th class="px-4 py-3">Especialidad</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Teléfono</th>
                        <th class="px-4 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 dark:text-gray-200 divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse ($doctores as $doctor)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <td class="px-4 py-3">{{ $doctor->id }}</td>
                            <td class="px-4 py-3 font-medium">{{ $doctor->nombre }}</td>
                            <td class="px-4 py-3">{{ $doctor->especialidad }}</td>
                            <td class="px-4 py-3">{{ $doctor->email }}</td>
                            <td class="px-4 py-3">{{ $doctor->telefono }}</td>
                            <td class="px-4 py-3 space-x-2 whitespace-nowrap">
                                <a href="{{ route('doctores.edit', $doctor->id) }}" 
                                   class="inline-block text-yellow-600 hover:text-yellow-400 font-semibold transition">
                                    ✏️ Editar
                                </a>
                                <form action="{{ route('doctores.destroy', $doctor->id) }}" method="POST" class="inline"
                                      onsubmit="return confirm('¿Eliminar doctor?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-400 font-semibold transition">
                                        🗑️ Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500 dark:text-gray-400">
                                No hay doctores registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($doctores, 'links'))
            <div class="mt-6">
                {{ $doctores->links() }}
            </div>
        @endif
    </div>
</x-app-layout>