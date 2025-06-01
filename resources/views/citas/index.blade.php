<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-2xl shadow-xl">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-extrabold text-gray-800">Lista de Citas</h2>
                    <a href="{{ route('citas.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow transition">
                        + Agendar Nueva Cita
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">Paciente</th>
                                <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">Doctor</th>
                                <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">Fecha</th>
                                <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">Hora</th>
                                <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">Motivo</th>
                                <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($citas as $cita)
                                <tr class="hover:bg-gray-50 transition">
                                    {{-- Accede directamente a las propiedades retornadas del procedimiento --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ $cita->paciente_nombre }} {{ $cita->paciente_apellidos }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ $cita->doctor_nombre }} {{ $cita->doctor_apellido }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ $cita->hora }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ $cita->motivo }}</td>
                                    <td class="px-6 py-4">
                                        {{-- Para cambiar estado, necesitas el id de la cita --}}
                                        <form action="{{ route('citas.cambiarEstado', $cita->id) }}" method="POST">
                                            @csrf
                                            <select name="estado" onchange="this.form.submit()" class="border border-gray-300 rounded-md px-3 py-1 text-sm text-gray-700 focus:ring-blue-500 focus:border-blue-500">
                                                <option value="Pendiente" {{ $cita->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                <option value="Realizada" {{ $cita->estado == 'Realizada' ? 'selected' : '' }}>Realizada</option>
                                                <option value="Cancelada" {{ $cita->estado == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-gray-500">
                                        No hay citas registradas.
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