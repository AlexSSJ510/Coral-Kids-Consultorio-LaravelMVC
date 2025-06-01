<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Pacientes</h2>

                <div class="mb-6 flex justify-between items-center">
                    <a href="{{ route('pacientes.create') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-xl shadow-sm transition">
                        + Crear Nuevo Paciente
                    </a>
                </div>

                <div class="overflow-x-auto rounded-lg shadow-sm">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">DNI</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Apellidos</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Fecha de Nacimiento</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Dirección</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Teléfono</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($pacientes as $paciente)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->dni }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->nombre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->apellidos }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->direccion }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->telefono }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center space-x-2">
                                        <a href="{{ route('historiales.paciente', $paciente->id) }}" 
                                            class="btn btn-info btn-sm">Ver Historial Médico</a>

                                        <a href="{{ route('pacientes.edit', $paciente->id) }}" 
                                           class="text-yellow-500 hover:underline font-semibold">Editar</a>

                                        <form action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Seguro que quieres eliminar este paciente?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline font-semibold">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                        No hay pacientes registrados.
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