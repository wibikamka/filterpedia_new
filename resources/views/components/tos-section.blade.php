@props([
    'number',
    'title',
    'color' => 'indigo'
])

@php
$colors = [
    'indigo' => ['border' => 'from-indigo-500 via-indigo-400 to-transparent', 'badge' => 'bg-indigo-50 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400'],
    'purple' => ['border' => 'from-purple-500 via-purple-400 to-transparent', 'badge' => 'bg-purple-50 dark:bg-purple-900/50 text-purple-600 dark:text-purple-400'],
    'emerald' => ['border' => 'from-emerald-500 via-emerald-400 to-transparent', 'badge' => 'bg-emerald-50 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400'],
    'rose'    => ['border' => 'from-rose-500 via-rose-400 to-transparent',    'badge' => 'bg-rose-50 dark:bg-rose-900/50 text-rose-600 dark:text-rose-400'],
    'amber'   => ['border' => 'from-amber-500 via-amber-400 to-transparent',  'badge' => 'bg-amber-50 dark:bg-amber-900/50 text-amber-600 dark:text-amber-400'],
];
$c = $colors[$color];
@endphp

<div class="relative p-8 rounded-2xl bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
    {{-- Gradient border kiri --}}
    <div class="absolute top-0 left-0 w-1 h-full bg-gradient-to-b {{ $c['border'] }} rounded-l-2xl"></div>

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-5">
        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-sm font-bold {{ $c['badge'] }}">
            {{ $number }}
        </span>
        <h2 class="text-lg font-bold text-gray-900 dark:text-white">{{ $title }}</h2>
    </div>

    {{-- Content --}}
    <div class="space-y-3 text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
        {{ $slot }}
    </div>
</div>


