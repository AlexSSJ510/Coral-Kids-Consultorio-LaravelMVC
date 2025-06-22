<x-app-layout> 
    <div class="py-10 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-10 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700">

                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-4xl font-extrabold text-blue-700 dark:text-blue-300 tracking-wide">👩‍⚕️ Lista de Pacientes</h2>
                    <a href="{{ route('pacientes.create') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white text-lg font-semibold py-2 px-5 rounded-xl shadow-md transition duration-300">
                        ➕ Nuevo Paciente
                    </a>
                </div>

                {{-- Buscador --}}
                <form method="GET" action="{{ route('pacientes.index') }}" class="mb-8">
                    <div class="flex items-center gap-4">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="🔎 Buscar por DNI, nombre, etc."
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                            Buscar
                        </button>
                    </div>
                </form>

                <div class="overflow-x-auto rounded-xl shadow-inner ring-1 ring-gray-300 dark:ring-gray-600">
                    <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-600 text-base">
                        <thead class="bg-gray-800">
                            <tr>
                                @foreach (['DNI', 'Nombre', 'Apellidos', 'Nacimiento', 'Dirección', 'Teléfono', 'Email', 'Acciones'] as $col)
                                    <th class="px-5 py-4 text-left text-sm font-bold uppercase tracking-wide text-white">
                                        {{ $col }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="bg-gray-900 divide-y divide-gray-700">
                            @forelse ($pacientes as $paciente)
                                <tr class="hover:bg-gray-800 transition duration-200 ease-in-out">
                                    <td class="px-5 py-4 text-white font-medium">{{ $paciente->dni }}</td>
                                    <td class="px-5 py-4 text-white font-medium">{{ $paciente->nombre }}</td>
                                    <td class="px-5 py-4 text-white font-medium">{{ $paciente->apellidos }}</td>
                                    <td class="px-5 py-4 text-white font-medium">{{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->format('d/m/Y') }}</td>
                                    <td class="px-5 py-4 text-white font-medium">{{ $paciente->direccion }}</td>
                                    <td class="px-5 py-4 text-white font-medium">{{ $paciente->telefono }}</td>
                                    <td class="px-5 py-4 text-white font-medium">{{ $paciente->email }}</td>
                                    <td class="px-5 py-4 text-center space-x-2">
                                        <a href="{{ route('historiales.paciente', ['id' => $paciente->id]) }}"
                                           class="inline-block text-blue-400 hover:text-blue-200 font-semibold text-sm px-2 py-1">
                                            🩺 Ver
                                        </a>
                                    
                                        <a href="{{ route('pacientes.edit', $paciente->id) }}" 
                                           class="inline-block text-yellow-300 hover:text-yellow-100 font-semibold text-sm px-2 py-1">
                                            ✏️ Editar
                                        </a>
                                    
                                        <form action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST" class="inline-block" 
                                              onsubmit="return confirm('¿Seguro que deseas eliminar a este paciente?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-block text-red-400 hover:text-red-200 font-semibold text-sm px-2 py-1">
                                                🗑️ Eliminar
                                            </button>
                                        </form>
                                    </td>                                    
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-6 text-center text-white text-lg font-medium">
                                        😕 No hay pacientes registrados.
                                    </td>
                                </tr>
                            @endforelse                      
                        </tbody>                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>