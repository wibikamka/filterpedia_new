<x-app-layout>
<x-slot name="header">
    <div class="flex items-center gap-3">
        {{-- Tombol Kembali --}}
        <a href="/" class="flex items-center text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Akun Saya
        </h2>
    </div>
</x-slot>
{{-- Di dalam div dengan x-data, tambahkan ini --}}
<div class="min-h-screen bg-gray-50 dark:bg-gray-950 pb-10 md:pb-0"
     x-data="{ 
        activeTab: 'informasi',
        notification: { show: false, message: '', type: 'success' }
     }"
     @notification.window="notification = { show: true, message: $event.detail.message, type: $event.detail.type }; setTimeout(() => notification.show = false, 3000)">

    {{-- NOTIFICATION TOAST --}}
    <template x-teleport="body">
        <div x-show="notification.show" 
             x-transition
             class="fixed top-4 right-4 z-50 px-4 py-3 rounded-lg shadow-lg text-sm"
             :class="{
                 'bg-green-50 text-green-700 border border-green-200': notification.type === 'success',
                 'bg-red-50 text-red-700 border border-red-200': notification.type === 'error'
             }"
             x-text="notification.message">
        </div>
    </template>
    
    {{-- SISANYA KONTEN --}}
{{-- ═══════════════════════════════════════════════════════════
     PAGE WRAPPER - Responsive Design (Mobile & Desktop)
     - Mobile: Tampilan stack (default)
     - Desktop: Layout dengan sidebar sticky dan tab panel
═══════════════════════════════════════════════════════════ --}}
<div class="min-h-screen bg-gray-50 dark:bg-gray-950 pb-10 md:pb-0"
     x-data="{ activeTab: 'informasi' }">

    {{-- Mobile Container (max-w-lg) --}}
    <div class="max-w-lg mx-auto md:hidden">
        
        {{-- Mobile: Hero Profile Card --}}
        <div class="relative bg-white dark:bg-gray-900 mx-4 mt-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
            <div class="h-1 w-full bg-gradient-to-r from-bluefilterpedia via-blue-400 to-cyan-400"></div>
            <div class="px-5 py-5 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="relative flex-shrink-0">
                        <div class="w-16 h-16 rounded-full ring-2 ring-bluefilterpedia ring-offset-2 dark:ring-offset-gray-900 overflow-hidden bg-gray-200 dark:bg-gray-700">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                     class="w-full h-full object-cover"
                                     alt="Avatar">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-900 dark:to-blue-800">
                                    <svg class="w-8 h-8 text-bluefilterpedia" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <span class="absolute bottom-0.5 right-0.5 w-3 h-3 bg-green-400 border-2 border-white dark:border-gray-900 rounded-full"></span>
                    </div>
                    <div>
                        <h2 class="font-semibold text-base text-gray-900 dark:text-white leading-tight">
                            {{ auth()->user()->name }}
                        </h2>
                        @if(auth()->user()->phone)
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                            {{ auth()->user()->phone }}
                        </p>
                        @endif
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            {{ auth()->user()->email }}
                        </p>
                    </div>
                </div>
                <a href="{{ route('profile.index') }}"
                   class="flex items-center gap-1.5 text-xs px-3 py-1.5 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors font-medium">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                    Edit
                </a>
            </div>
        </div>

        {{-- Mobile: Quick Menu Grid --}}
        <div class="mx-4 mt-4 bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
            <div class="grid grid-cols-3 divide-x divide-gray-100 dark:divide-gray-800">
                <a href="{{ url('/cart') }}"
                   class="flex flex-col items-center gap-2 py-5 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors group">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center group-hover:bg-blue-100 dark:group-hover:bg-blue-900/50 transition-colors">
                        <svg class="w-5 h-5 text-bluefilterpedia" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <p class="text-xs font-medium text-gray-600 dark:text-gray-300">Keranjang</p>
                </a>
                <a href="{{ url('/orders') }}"
                   class="flex flex-col items-center gap-2 py-5 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors group">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-900/30 flex items-center justify-center group-hover:bg-amber-100 dark:group-hover:bg-amber-900/50 transition-colors">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <p class="text-xs font-medium text-gray-600 dark:text-gray-300">Histori</p>
                </a>
                <a href="{{ url('/reorder') }}"
                   class="flex flex-col items-center gap-2 py-5 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors group">
                    <div class="w-10 h-10 rounded-xl bg-green-50 dark:bg-green-900/30 flex items-center justify-center group-hover:bg-green-100 dark:group-hover:bg-green-900/50 transition-colors">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                    </div>
                    <p class="text-xs font-medium text-gray-600 dark:text-gray-300">Beli Lagi</p>
                </a>
            </div>
        </div>

        {{-- Mobile: Main Menu --}}
        <div class="mx-4 mt-4 bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden divide-y divide-gray-100 dark:divide-gray-800">
            @php
            $mobileMenuItems = [

                [
                    'label' => 'Daftar Alamat',
                    'href'  => '/addresses',
                    'color' => 'text-violet-500',
                    'bg'    => 'bg-violet-50 dark:bg-violet-900/30',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>',
                ],
                [
                    'label' => 'Keamanan Akun',
                    'href'  => '#keamanan',
                    'color' => 'text-red-500',
                    'bg'    => 'bg-red-50 dark:bg-red-900/30',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
                ],
                [
                    'label' => 'Notifikasi',
                    'href'  => '#notifikasi',
                    'color' => 'text-sky-500',
                    'bg'    => 'bg-sky-50 dark:bg-sky-900/30',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>',
                ],
                [
                    'label' => 'Mode Tampilan',
                    'href'  => null,
                    'color' => 'text-orange-500',
                    'bg'    => 'bg-orange-50 dark:bg-orange-900/30',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>',
                    'toggle' => true,
                ],
            ];
            @endphp

            @foreach($mobileMenuItems as $item)
                @if(!empty($item['toggle']))
                <button id="account-theme-toggle-mobile" type="button"
                        class="w-full flex items-center justify-between px-5 py-4 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors group">
                    <div class="flex items-center gap-3.5">
                        <div class="w-9 h-9 rounded-xl {{ $item['bg'] }} flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 {{ $item['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $item['icon'] !!}
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ $item['label'] }}</span>
                    </div>
                    <div id="theme-pill-mobile"
                         class="relative w-11 h-6 rounded-full transition-colors duration-200 bg-gray-200 dark:bg-bluefilterpedia">
                        <span id="theme-pill-dot-mobile"
                              class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow transition-transform duration-200 dark:translate-x-5"></span>
                    </div>
                </button>
                @else
                <a href="{{ $item['href'] }}"
                   class="flex items-center justify-between px-5 py-4 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors group">
                    <div class="flex items-center gap-3.5">
                        <div class="w-9 h-9 rounded-xl {{ $item['bg'] }} flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 {{ $item['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $item['icon'] !!}
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ $item['label'] }}</span>
                    </div>
                    <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                @endif
            @endforeach
        </div>

        {{-- Mobile: Seputar Filterpedia --}}
        <div class="mx-4 mt-4 bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden"
             x-data="{ open: false }">
            <button @click="open = !open"
                    class="w-full flex items-center justify-between px-5 py-4 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors group">
                <div class="flex items-center gap-3.5">
                    <div class="w-9 h-9 rounded-xl bg-teal-50 dark:bg-teal-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Seputar Filterpedia</span>
                </div>
                <svg class="w-4 h-4 text-gray-400 transition-transform duration-200"
                     :class="open ? 'rotate-90' : ''"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-150"
                 x-transition:enter-start="opacity-0 -translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-100"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-1"
                 class="border-t border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/50 divide-y divide-gray-100 dark:divide-gray-800">
                @php
                $subItems = [
                    ['label' => 'Kenali Filterpedia', 'href' => '/about'],
                    ['label' => 'Berita / Blog',      'href' => '/blog'],
                    ['label' => 'Syarat & Ketentuan', 'href' => '/terms'],
                    ['label' => 'Kebijakan Privasi',  'href' => '/privacy-policy'],
                ];
                @endphp
                @foreach($subItems as $sub)
                <a href="{{ url($sub['href']) }}"
                   class="flex items-center justify-between pl-16 pr-5 py-3.5 hover:bg-gray-100 dark:hover:bg-gray-700/50 transition-colors">
                    <span class="text-sm text-gray-600 dark:text-gray-300">{{ $sub['label'] }}</span>
                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                @endforeach
            </div>
        </div>

        {{-- Mobile: Pusat Bantuan --}}
        <div class="mx-4 mt-4 bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
            <a href="{{ url('/bantuan') }}"
               class="flex items-center justify-between px-5 py-4 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors group">
                <div class="flex items-center gap-3.5">
                    <div class="w-9 h-9 rounded-xl bg-indigo-50 dark:bg-indigo-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Pusat Bantuan</span>
                </div>
                <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        {{-- Mobile: Logout --}}
        <div class="mx-4 mt-4 bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-3.5 px-5 py-4 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors group">
                    <div class="w-9 h-9 rounded-xl bg-red-50 dark:bg-red-900/30 flex items-center justify-center group-hover:bg-red-100 dark:group-hover:bg-red-900/50 transition-colors">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-red-600 dark:text-red-400">Keluar Akun</span>
                </button>
            </form>
        </div>

        {{-- Mobile: Version --}}
        <p class="text-center text-xs text-gray-400 dark:text-gray-600 mt-6 mb-2 md:hidden">Filterpedia v1.0</p>
    </div>

    {{-- ═══════════════════════════════════════════════════════════
         DESKTOP LAYOUT (hidden on mobile, visible on md and up)
    ═══════════════════════════════════════════════════════════ --}}
    <div class="hidden md:block max-w-6xl mx-auto px-4 py-6 md:flex md:gap-5 md:items-start">

        {{-- Desktop: Left Sidebar (sticky) --}}
        <aside class="w-full md:w-64 lg:w-72 flex-shrink-0 md:sticky md:top-24 space-y-2 mb-4 md:mb-0">

            {{-- Desktop: Profile info --}}
            <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800">
                <div class="h-0.5 rounded-t-xl bg-bluefilterpedia"></div>
                <div class="px-4 py-4 flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full flex-shrink-0 overflow-hidden bg-gray-100 dark:bg-gray-800 ring-1 ring-gray-200 dark:ring-gray-700">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="w-full h-full object-cover" alt="">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ auth()->user()->name }}</p>
                        @if(auth()->user()->phone)
                        <p class="text-xs text-gray-400 dark:text-gray-500 truncate">{{ auth()->user()->phone }}</p>
                        @endif
                        <p class="text-xs text-gray-400 dark:text-gray-500 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>

            {{-- Desktop: Quick links --}}
            <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 divide-y divide-gray-100 dark:divide-gray-800 overflow-hidden">
                @foreach([
                    ['/cart',    'Keranjang',       'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'],
                    ['/orders',  'Histori Pesanan', 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                    ['/reorder', 'Beli Lagi',       'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15'],
                ] as $link)
                    <a href="{{ url($link[0]) }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white transition-colors group">
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $link[2] }}"/>
                        </svg>
                        {{ $link[1] }}
                    </a>
                @endforeach
            </div>

            {{-- Desktop: Mode Tampilan --}}
            <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
                <button id="account-theme-toggle-desktop" type="button"
                        class="w-full flex items-center justify-between px-4 py-3 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        Mode Tampilan
                    </div>
                    <div class="relative w-10 h-5 rounded-full bg-gray-200 dark:bg-bluefilterpedia flex-shrink-0 transition-colors duration-200">
                        <span class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform duration-200 dark:translate-x-5 block"></span>
                    </div>
                </button>
            </div>

            {{-- Desktop: Seputar Filterpedia --}}
            <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden"
                 x-data="{ open: false }">
                <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-3 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Seputar Filterpedia
                    </div>
                    <svg class="w-3.5 h-3.5 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-90' : ''"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                     class="border-t border-gray-100 dark:border-gray-800 divide-y divide-gray-100 dark:divide-gray-800 bg-gray-50 dark:bg-gray-800/50">
                    @foreach([['Kenali Filterpedia','/about'],['Berita / Blog','/blog'],['Syarat & Ketentuan','/terms'],['Kebijakan Privasi','/privacy-policy']] as $sub)
                    <a href="{{ url($sub[1]) }}" class="flex items-center justify-between pl-11 pr-4 py-2.5 text-xs text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700/50 hover:text-gray-700 dark:hover:text-gray-200 transition-colors">
                        {{ $sub[0] }}
                        <svg class="w-3 h-3 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Desktop: Pusat Bantuan --}}
            <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
                <a href="{{ url('/bantuan') }}" class="flex items-center justify-between px-4 py-3 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white transition-colors group">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Pusat Bantuan
                    </div>
                    <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            {{-- Desktop: Keluar --}}
            <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-500 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors group">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Keluar Akun
                    </button>
                </form>
            </div>

            <p class="text-center text-xs text-gray-300 dark:text-gray-700 pt-1 pb-3">Filterpedia v1.0</p>
        </aside>

        {{-- Desktop: Right Panel with Tabs --}}
        <main class="flex-1 min-w-0">

            {{-- Desktop: Tab bar --}}
            <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden mb-4">
                <div class="flex overflow-x-auto" style="scrollbar-width:none">
                    @foreach([
                        ['informasi',  'Informasi Pribadi'],
                        ['kontak',     'Kontak'],
                        ['alamat',     'Daftar Alamat'],
                        ['keamanan',   'Keamanan'],
                        ['notifikasi', 'Notifikasi'],
                    ] as $tab)
                    <button type="button"
                            @click="activeTab = '{{ $tab[0] }}'"
                            :class="activeTab === '{{ $tab[0] }}'
                                ? 'border-b-2 border-bluefilterpedia text-bluefilterpedia bg-blue-50/60 dark:bg-blue-900/20 font-semibold'
                                : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 border-b-2 border-transparent'"
                            class="flex-shrink-0 px-5 py-3.5 text-sm transition-colors whitespace-nowrap">
                        {{ $tab[1] }}
                    </button>
                    @endforeach
                </div>
            </div>

            {{-- Desktop: Tab Panels --}}

            {{-- INFORMASI PRIBADI --}}
            <div x-show="activeTab === 'informasi'" x-cloak
                 x-transition:enter="transition ease-out duration-150"
                 x-transition:enter-start="opacity-0 translate-y-0.5"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-800">
                    <p class="text-sm font-semibold text-gray-800 dark:text-white">Informasi Pribadi</p>
                    <p class="text-xs text-gray-400 mt-0.5">Nama dan data dasar akun Anda</p>
                </div>
    
    <x-account.form-avatar :user="$user" />

<x-account.form-name :user="$user" />

                {{-- Form untuk Username --}}
<x-account.form-username :user="$user" />

                {{-- Form untuk Bio --}}
<x-account.form-bio :user="$user" />

            </div>

            {{-- KONTAK --}}
            <div x-show="activeTab === 'kontak'" x-cloak
                 x-transition:enter="transition ease-out duration-150"
                 x-transition:enter-start="opacity-0 translate-y-0.5"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-800">
                    <p class="text-sm font-semibold text-gray-800 dark:text-white">Kontak</p>
                    <p class="text-xs text-gray-400 mt-0.5">Email dan nomor telepon</p>
                </div>
                
                {{-- Form untuk Email --}}
 <x-account.form-email :user="$user" />

                {{-- Form untuk Phone --}}
 <x-account.form-phone :user="$user" />
            </div>

            {{-- DAFTAR ALAMAT --}}
{{-- DAFTAR ALAMAT --}}
<div x-show="activeTab === 'alamat'" x-cloak
     x-transition:enter="transition ease-out duration-150"
     x-transition:enter-start="opacity-0 translate-y-0.5"
     x-transition:enter-end="opacity-100 translate-y-0"
     class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
    
    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-800">
        <p class="text-sm font-semibold text-gray-800 dark:text-white">Daftar Alamat</p>
        <p class="text-xs text-gray-400 mt-0.5">Kelola alamat pengiriman</p>
    </div>
    
    {{-- Form Tambah Alamat Baru (REGULAR FORM, redirect) --}}
<div class="p-4 border-b border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/30">
    <form action="{{ route('addresses.store') }}" method="POST" class="space-y-3">
        @csrf
        <div class="grid grid-cols-2 gap-3">
            <input type="text" name="label" placeholder="Label (opsional)" 
                   value="{{ old('label') }}"
                   class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-bluefilterpedia/30">
            <input type="text" name="recipient_name" placeholder="Nama Penerima *" required
                   value="{{ old('recipient_name') }}"
                   class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-bluefilterpedia/30">
        </div>
        <div class="grid grid-cols-2 gap-3">
            <input type="text" name="phone" placeholder="Telepon *" required
                   value="{{ old('phone') }}"
                   class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-bluefilterpedia/30">
            <input type="text" name="postal_code" placeholder="Kode Pos *" required
                   value="{{ old('postal_code') }}"
                   class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-bluefilterpedia/30">
        </div>
        <textarea name="full_address" rows="2" placeholder="Alamat Lengkap *" required
                  class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-bluefilterpedia/30">{{ old('full_address') }}</textarea>
        <div class="grid grid-cols-2 gap-3">
            <input type="text" name="city" placeholder="Kota *" required
                   value="{{ old('city') }}"
                   class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-bluefilterpedia/30">
            <input type="text" name="province" placeholder="Provinsi *" required
                   value="{{ old('province') }}"
                   class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-bluefilterpedia/30">
        </div>
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_default" value="1" {{ old('is_default') ? 'checked' : '' }} class="rounded">
            <span class="text-sm text-gray-700 dark:text-gray-300">Jadikan alamat utama</span>
        </label>
        
        @if($errors->any())
            <div class="text-red-500 text-xs space-y-1">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-bluefilterpedia text-white text-sm font-medium rounded-lg hover:opacity-90">
                + Tambah Alamat
            </button>
        </div>
    </form>
</div>
    {{-- List Alamat dengan inline edit --}}
    <div class="divide-y divide-gray-100 dark:divide-gray-800">
        @forelse(auth()->user()->addresses as $address)
            <x-account.address-item :address="$address" />
        @empty
            <div class="px-6 py-12 text-center">
                <svg class="w-10 h-10 mx-auto mb-3 text-gray-200 dark:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <p class="text-sm text-gray-400 dark:text-gray-500">Belum ada alamat tersimpan</p>
                <p class="text-xs text-gray-400 mt-1">Isi form di atas untuk menambah alamat</p>
            </div>
        @endforelse
    </div>
</div>

            {{-- KEAMANAN --}}
            <div x-show="activeTab === 'keamanan'" x-cloak
                 x-transition:enter="transition ease-out duration-150"
                 x-transition:enter-start="opacity-0 translate-y-0.5"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-800">
                    <p class="text-sm font-semibold text-gray-800 dark:text-white">Keamanan Akun</p>
                    <p class="text-xs text-gray-400 mt-0.5">Perbarui kata sandi Anda</p>
                </div>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf @method('PUT')
                    <div class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach([
                            ['current_password',      'Kata Sandi Lama'],
                            ['password',              'Kata Sandi Baru'],
                            ['password_confirmation', 'Konfirmasi Sandi'],
                        ] as $field)
                        <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center gap-2">
                            <label class="text-xs font-medium text-gray-500 dark:text-gray-400 sm:w-40 flex-shrink-0">{{ $field[1] }}</label>
                            <input type="password" name="{{ $field[0] }}"
                                   class="flex-1 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 text-sm text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-bluefilterpedia/30 focus:border-bluefilterpedia transition-colors">
                        </div>
                        @endforeach
                        <div class="px-6 py-4 flex justify-end">
                            <button type="submit" class="px-5 py-2 bg-bluefilterpedia text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity">Perbarui Sandi</button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- NOTIFIKASI --}}
            <div x-show="activeTab === 'notifikasi'" x-cloak
                 x-transition:enter="transition ease-out duration-150"
                 x-transition:enter-start="opacity-0 translate-y-0.5"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
                
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-800">
                    <p class="text-sm font-semibold text-gray-800 dark:text-white">Preferensi Notifikasi</p>
                    <p class="text-xs text-gray-400 mt-0.5">Pilih notifikasi yang ingin Anda terima</p>
                </div>
                
                <div class="divide-y divide-gray-100 dark:divide-gray-800">
                    <div class="px-6 py-8 text-center">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Fitur notifikasi sedang dalam pengembangan</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500">Nantikan update selanjutnya!</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

{{-- Theme Toggle Script (unified) --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Fungsi toggle theme
    function toggleTheme() {
        const isDark = document.documentElement.classList.contains('dark');
        document.documentElement.classList.toggle('dark', !isDark);
        localStorage.setItem('theme', isDark ? 'light' : 'dark');
    }

    // Mobile theme toggle
    document.getElementById('account-theme-toggle-mobile')?.addEventListener('click', function (e) {
        e.preventDefault();
        toggleTheme();
    });

    // Desktop theme toggle
    document.getElementById('account-theme-toggle-desktop')?.addEventListener('click', function (e) {
        e.preventDefault();
        toggleTheme();
    });

    // Untuk memastikan pill bergerak sesuai theme saat halaman dimuat
    const isDarkMode = document.documentElement.classList.contains('dark');
    const pills = document.querySelectorAll('#theme-pill-mobile, #theme-pill-desktop, .dark\\:translate-x-5');
    // CSS akan menangani pergerakan pill via class dark
});
</script>

{{-- Alpine JS untuk tab state (sudah include jika layout punya) --}}
@once
    @push('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endpush
@endonce

</x-app-layout>