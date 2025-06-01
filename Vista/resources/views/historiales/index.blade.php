<x-app-layout>
    <div class="max-w-7xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-blue-700">Historiales Médicos</h1>
            <a href="{{ route('historiales.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Nuevo Historial
            </a>
        </div>

        <form method="GET" action="{{ route('historiales.index') }}" class="mb-6">
            <div class="flex space-x-2">
                <input type="text" name="buscar" placeholder="Buscar por nombre, apellido o DNI" 
                       value="{{ request('buscar') }}" 
                       class="flex-grow border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" 
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Buscar</button>
                <a href="{{ route('historiales.index') }}" 
                   class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition">Limpiar</a>
            </div>
        </form>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full table-auto border-collapse border border-gray-200 dark:border-gray-700">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">Fecha</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Paciente</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Doctor</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Motivo</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Diagnóstico</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Tratamiento</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200">
                @forelse ($historiales as $historial)
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
                        <td class="border border-gray-300 px-4 py-2">{{ $historial->fecha }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $historial->nombre_paciente }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $historial->nombre_doctor }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $historial->motivo_consulta }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $historial->diagnostico }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $historial->tratamiento }}</td>
                        <td class="border border-gray-300 px-4 py-2 space-x-2">
                            <a href="{{ route('historiales.edit', $historial->id) }}" 
                               class="text-yellow-500 hover:text-yellow-700 font-semibold">Editar</a>

                            <form action="{{ route('historiales.destroy', $historial->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('¿Estás seguro de eliminar este historial?');">                             
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-6 text-gray-500 dark:text-gray-300">
                            No hay historiales médicos registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if(method_exists($historiales, 'links'))
        {{ $historiales->links() }}
        @endif
    </div>
</x-app-layout>