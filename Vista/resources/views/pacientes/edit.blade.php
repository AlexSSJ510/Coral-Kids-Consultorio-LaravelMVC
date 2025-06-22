<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700">

                <h2 class="text-3xl font-extrabold text-blue-700 dark:text-blue-400 mb-6">✏️ Editar Paciente</h2>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 dark:bg-red-800 border border-red-300 dark:border-red-600 text-red-700 dark:text-red-200 rounded-lg shadow-sm">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pacientes.update', $paciente->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Campo reutilizable -->
                    @php
                        $inputClass = "w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 
                                       bg-white dark:bg-gray-600 text-gray-900 dark:text-white 
                                       focus:outline-none focus:ring-2 focus:ring-blue-500";
                        $labelClass = "block font-semibold text-gray-700 dark:text-gray-200 mb-1";
                    @endphp

                    <div>
                        <label for="dni" class="{{ $labelClass }}">DNI:</label>
                        <input type="text" name="dni" id="dni" value="{{ old('dni', $paciente->dni) }}" class="{{ $inputClass }}" required>
                    </div>

                    <div>
                        <label for="nombre" class="{{ $labelClass }}">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $paciente->nombre) }}" class="{{ $inputClass }}" required>
                    </div>

                    <div>
                        <label for="apellidos" class="{{ $labelClass }}">Apellidos:</label>
                        <input type="text" name="apellidos" id="apellidos" value="{{ old('apellidos', $paciente->apellidos) }}" class="{{ $inputClass }}" required>
                    </div>

                    <div>
                        <label for="fecha_nacimiento" class="{{ $labelClass }}">Fecha de Nacimiento:</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento) }}" class="{{ $inputClass }}" required>
                    </div>

                    <div>
                        <label for="direccion" class="{{ $labelClass }}">Dirección:</label>
                        <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $paciente->direccion) }}" class="{{ $inputClass }}">
                    </div>

                    <div>
                        <label for="telefono" class="{{ $labelClass }}">Teléfono:</label>
                        <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $paciente->telefono) }}" class="{{ $inputClass }}" required>
                    </div>

                    <div>
                        <label for="email" class="{{ $labelClass }}">Email:</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $paciente->email) }}" class="{{ $inputClass }}" required>
                    </div>

                    <div class="flex justify-end space-x-4 pt-6">
                        <a href="{{ route('pacientes.index') }}"
                           class="bg-gray-500 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded-lg transition">
                            💾 Actualizar
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>