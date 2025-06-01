<x-app-layout>
    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Editar Paciente</h2>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pacientes.update', $paciente->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- DNI -->
                    <div class="mb-4">
                        <label for="dni" class="block text-gray-700 font-bold mb-2">DNI:</label>
                        <input type="text" name="dni" id="dni" value="{{ old('dni', $paciente->dni) }}" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <!-- Nombre -->
                    <div class="mb-4">
                        <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $paciente->nombre) }}" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <!-- Apellidos -->
                    <div class="mb-4">
                        <label for="apellidos" class="block text-gray-700 font-bold mb-2">Apellidos:</label>
                        <input type="text" name="apellidos" id="apellidos" value="{{ old('apellidos', $paciente->apellidos) }}" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <!-- Fecha de Nacimiento -->
                    <div class="mb-4">
                        <label for="fecha_nacimiento" class="block text-gray-700 font-bold mb-2">Fecha de Nacimiento:</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento) }}" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <!-- Dirección (opcional) -->
                    <div class="mb-4">
                        <label for="direccion" class="block text-gray-700 font-bold mb-2">Dirección:</label>
                        <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $paciente->direccion) }}" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>

                    <!-- Teléfono -->
                    <div class="mb-4">
                        <label for="telefono" class="block text-gray-700 font-bold mb-2">Teléfono:</label>
                        <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $paciente->telefono) }}" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-6">
                        <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $paciente->email) }}" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('pacientes.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Cancelar
                        </a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>