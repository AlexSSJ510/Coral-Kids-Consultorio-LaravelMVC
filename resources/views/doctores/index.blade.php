<x-app-layout>
    <div class="max-w-7xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-blue-700">Listado de Doctores</h1>
            <a href="{{ route('doctores.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Nuevo Doctor
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full table-auto border-collapse border border-gray-200 dark:border-gray-700">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Nombre</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Especialidad</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Teléfono</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200">
                @forelse ($doctores as $doctor)
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
                        <td class="border border-gray-300 px-4 py-2">{{ $doctor->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $doctor->nombre }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $doctor->especialidad }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $doctor->email }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $doctor->telefono }}</td>
                        <td class="border border-gray-300 px-4 py-2 space-x-2">
                            <a href="{{ route('doctores.edit', $doctor->id) }}" 
                                class="text-yellow-500 hover:text-yellow-700 font-semibold">Editar</a>
                             
                            <form action="{{ route('doctores.destroy', $doctor->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('¿Eliminar doctor?');">                             
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-500">No hay doctores registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if(method_exists($doctores, 'links'))
            <div class="mt-6">
                {{ $doctores->links() }}
            </div>
        @endif
    </div>
</x-app-layout>