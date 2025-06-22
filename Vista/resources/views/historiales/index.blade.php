<x-app-layout>
    <div class="max-w-7xl mx-auto p-6 bg-white dark:bg-gray-900 rounded-3xl shadow-xl">

        {{-- Título y botón --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-indigo-700 dark:text-indigo-300 leading-snug">
                    @isset($paciente)
                        🧾 Historial Médico de {{ $paciente->nombre }} {{ $paciente->apellidos }}
                    @else
                        🩺 Historiales Médicos
                    @endisset
                </h1>
                @isset($paciente)
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">🆔 DNI: {{ $paciente->dni }}</p>
                @endisset
            </div>
            <a href="{{ route('historiales.create') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2.5 rounded-xl shadow transition flex items-center gap-2">
                ➕ <span>Nuevo Historial</span>
            </a>
        </div>

        <form method="GET" action="{{ route('historiales.index') }}" class="mb-6">
            <div class="flex space-x-2">
                <input type="text" name="buscar" placeholder="Buscar por nombre, apellido o DNI"
                       value="{{ request('buscar') }}"
                       class="flex-grow border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-600 dark:text-white">
                <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">Buscar</button>
                <a href="{{ route('historiales.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Limpiar</a>
            </div>
        </form>

        {{-- Mensaje de éxito --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100 rounded-lg shadow">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- Tabla de historiales --}}
        <div class="overflow-x-auto rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-indigo-600 text-white text-sm uppercase">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Fecha</th>
                        <th class="px-4 py-3 text-left font-semibold">Paciente</th>
                        <th class="px-4 py-3 text-left font-semibold">Doctor</th>
                        <th class="px-4 py-3 text-left font-semibold">Motivo</th>
                        <th class="px-4 py-3 text-left font-semibold">Diagnóstico</th>
                        <th class="px-4 py-3 text-left font-semibold">Tratamiento</th>
                        <th class="px-4 py-3 text-left font-semibold">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                    @forelse ($historiales as $historial)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                            <td class="px-4 py-3">{{ $historial->fecha }}</td>
                            <td class="px-4 py-3">{{ $historial->nombre_paciente ?? '—' }}</td>
                            <td class="px-4 py-3">{{ $historial->nombre_doctor ?? '—' }}</td>
                            <td class="px-4 py-3">{{ $historial->motivo_consulta }}</td>
                            <td class="px-4 py-3">{{ $historial->diagnostico }}</td>
                            <td class="px-4 py-3">{{ $historial->tratamiento }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('historiales.edit', $historial->id) }}"
                                       class="text-yellow-500 hover:text-yellow-600 font-medium transition">
                                        ✏️ Editar
                                    </a>

                                    <a href="{{ route('historiales.pdf', $historial->id) }}"
                                        target="_blank"
                                        class="text-indigo-600 hover:text-indigo-800 font-medium transition">
                                         📄 PDF
                                     </a>

                                    <form action="{{ route('historiales.destroy', $historial->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Estás seguro de eliminar este historial?');"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-500 hover:text-red-700 font-medium transition">
                                            🗑️ Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-6 text-gray-500 dark:text-gray-400 italic">
                                No hay historiales médicos registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        @if(method_exists($historiales, 'links'))
            <div class="mt-6 text-center">
                {{ $historiales->links() }}
            </div>
        @endif
    </div>
</x-app-layout>