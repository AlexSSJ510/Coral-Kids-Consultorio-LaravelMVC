@props(['title', 'link', 'external' => false])

<div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
    <h2 class="text-lg font-semibold text-blue-700 dark:text-blue-400 mb-3">{{ $title }}</h2>
    <a href="{{ $link }}" 
       @if($external) target="_blank" @endif 
       class="text-blue-600 dark:text-blue-400 font-medium hover:underline">
        Ir al panel
    </a>
</div>