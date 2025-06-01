<x-app-layout>
    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Agregar Paciente</h2>

                <form action="{{ route('pacientes.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="dni" class="block text-gray-700 font-bold mb-2">DNI:</label>
                        <input type="text" name="dni" id="dni" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <div class="mb-4">
                        <label for="apellidos" class="block text-gray-700 font-bold mb-2">Apellidos:</label>
                        <input type="text" name="apellidos" id="apellidos" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <div class="mb-4">
                        <label for="fecha_nacimiento" class="block text-gray-700 font-bold mb-2">Fecha de Nacimiento:</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <div class="mb-4">
                        <label for="direccion" class="block text-gray-700 font-bold mb-2">Dirección:</label>
                        <input type="text" name="direccion" id="direccion" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div class="mb-4">
                        <label for="telefono" class="block text-gray-700 font-bold mb-2">Teléfono:</label>
                        <input type="text" name="telefono" id="telefono" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <div class="mb-6">
                        <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                        <input type="email" name="email" id="email" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('pacientes.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Cancelar
                        </a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>