<x-app-layout>
    <div class="py-10 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 p-8 rounded-2xl shadow-xl">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-3xl font-bold text-white">📅 Gestión de Citas</h2>
                        <p class="text-sm text-gray-300 mt-1">Visualiza, edita o elimina citas médicas programadas.</p>
                    </div>
                    <a href="{{ route('citas.create') }}"
                        class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded-lg shadow transition">
                        ➕ Agendar Nueva Cita
                    </a>
                </div>

                <div id="calendar" class="bg-white dark:bg-gray-900 text-white rounded-xl shadow-lg p-4"></div>
            </div>
        </div>
    </div>

    @push('styles')
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.css' rel='stylesheet' />
        <style>
            .fc {
                background-color: #1f2937; /* Tailwind bg-gray-800 */
                color: #f9fafb; /* Tailwind text-white */
                border-radius: 1rem;
            }

            .fc .fc-button {
                background-color: #2563eb; /* Tailwind blue-600 */
                border: none;
                color: #fff;
                padding: 0.5rem 1rem;
                margin: 0.2rem;
                border-radius: 0.375rem;
            }

            .fc .fc-toolbar-title {
                font-weight: bold;
                font-size: 1.25rem;
                color: white;
            }

            .fc .fc-daygrid-day-number {
                color: #fff;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    },
                    themeSystem: 'standard',
                    locale: 'es',
                    eventTimeFormat: { hour: '2-digit', minute: '2-digit', hour12: false },
                    events: @json($eventos),
                });
                calendar.render();
            });
        </script>
    @endpush

</x-app-layout>