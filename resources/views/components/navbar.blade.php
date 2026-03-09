{{-- resources/views/components/navbar.blade.php --}}

{{-- ╔══════════════════════════════════════════════════╗ --}}
{{--   DESKTOP NAVBAR (hidden on mobile)                --}}
{{-- ╚══════════════════════════════════════════════════╝ --}}
<nav class="fixed top-0 left-0 z-50 w-full border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 dark:text-gray-100 shadow-sm hidden md:block">
    <div class="mx-auto flex max-w-7xl items-center gap-4 px-4 py-3">

        {{-- ── Burger Menu Dropdown (kiri logo) ────────────── --}}
        <div
            id="desktop-burger-wrapper"
            class="relative shrink-0"
        >
            <button
                id="desktop-burger-btn"
                type="button"
                class="flex items-center justify-center w-10 h-10 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                aria-label="Buka menu"
                aria-expanded="false"
            >
                <svg id="desktop-burger-icon-open" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="desktop-burger-icon-close" class="hidden w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            {{-- Dropdown Panel --}}
            <div
                id="desktop-burger-dropdown"
                class="hidden absolute left-0 top-12 w-64 bg-white dark:bg-gray-900 rounded-xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden z-70"
            >
                {{-- Kategori --}}
                <div class="px-3 pt-3 pb-1">
                    <p class="px-2 pb-1.5 text-xs font-semibold uppercase tracking-widest text-gray-400 dark:text-gray-500">
                        Kategori
                    </p>
                    <div class="space-y-0.5">
                        @foreach($categories as $category)
                        <a href="{{ route('product.category', $category->slug) }}"
                           class="flex items-center gap-3 px-2 py-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors group">
                            @if($category->icon)
                            <span class="shrink-0 w-6 h-6 rounded-full border border-bluefilterpedia flex items-center justify-center bg-white dark:bg-gray-800 overflow-hidden p-0.5 group-hover:shadow-sm transition-shadow">
                                <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}" class="w-full h-full object-contain">
                            </span>
                            @else
                            <span class="shrink-0 w-6 h-6 rounded-full border border-gray-300 dark:border-gray-600 flex items-center justify-center bg-gray-50 dark:bg-gray-800">
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                </svg>
                            </span>
                            @endif
                            <span class="text-sm truncate">{{ $category->name }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>

                <div class="my-2 border-t border-gray-200 dark:border-gray-700 mx-3"></div>

                {{-- Tentang Kami --}}
                <div class="px-3 pb-1 space-y-0.5">
                    <a href="{{ url('/about') }}"
                       class="flex items-center gap-3 px-2 py-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        <span class="shrink-0 w-6 h-6 flex items-center justify-center text-gray-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                        </span>
                        <span class="text-sm">Tentang Kami</span>
                    </a>

                    {{-- Blog --}}
                    <a href="{{ url('/blog') }}"
                       class="flex items-center gap-3 px-2 py-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        <span class="shrink-0 w-6 h-6 flex items-center justify-center text-gray-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"></path>
                                <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z"></path>
                            </svg>
                        </span>
                        <span class="text-sm">Blog</span>
                    </a>
                </div>

            </div>
        </div>

        {{-- ── Logo ────────────────────────────────────────── --}}
        <a href="{{ url('/') }}" title="Filterpedia - Filter Industri" class="shrink-0 flex items-center gap-2">
            <img src="{{ asset('storage/img/logo/filterpedialastfilterpedia.png') }}" class="h-10 lg:h-14" alt="filterpedia Logo">
            <span class="text-xl lg:text-2xl font-bold text-gray-900 dark:text-bluefilterpedia">
                filterpedia
            </span>
        </a>

        {{-- ── Search Bar (flex-grow, tinggi menyesuaikan navbar) ── --}}
        <div class="flex-1 mx-2">
            <x-search class="w-full" />
        </div>

        {{-- ── Right Actions ────────────────────────────────── --}}
        <div class="shrink-0 flex items-center gap-2">

            @auth
            {{-- ── Logged in: Bell + Profile + Cart ────────── --}}

            {{-- Bell Notification --}}
            <button
                type="button"
                class="relative flex h-10 w-10 items-center justify-center rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                aria-label="Notifikasi"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                {{-- Badge notif (opsional, tampilkan jika ada notif) --}}
                {{-- <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span> --}}
            </button>


            {{-- Cart --}}
            <a
                href="{{ url('/cart') }}"
                class="relative flex h-10 w-10 items-center justify-center rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                aria-label="Keranjang"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </a>


            
            {{-- Profile Dropdown --}}
            <div class="relative">
                <button
                    id="desktop-profile-btn"
                    type="button"
                    class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 hover:ring-2 hover:ring-bluefilterpedia transition-all overflow-hidden"
                    aria-label="Profil"
                    aria-expanded="false"
                >
                    @if(auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                    @else
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    @endif
                </button>

                {{-- Profile Dropdown Panel --}}
                <div
                    id="desktop-profile-dropdown"
                    class="hidden absolute right-0 top-12 w-56 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden z-50"
                >
                    {{-- User Info --}}
                    <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                        <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                            {{ auth()->user()->name }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate mt-0.5">
                            {{ auth()->user()->email }}
                        </p>
                    </div>

                    {{-- Menu Items --}}
                    <div class="py-1">
                        <a href="{{ route('account.index') }}"
                           class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Pengaturan
                        </a>

                        <a href="{{ url('/bantuan') }}"
                           class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Bantuan
                        </a>
                    </div>

                    <div class="border-t border-gray-200 dark:border-gray-700"></div>

                    {{-- Logout --}}
                    <div class="py-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                type="submit"
                                class="flex items-center gap-2.5 w-full px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            @else
            {{-- ── Guest: Tombol Masuk ───────────────────────── --}}
            <a
                href="{{ route('login') }}"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-bluefilterpedia text-white text-sm font-medium hover:opacity-90 transition-opacity"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                </svg>
                Masuk
            </a>
            @endauth

        </div>
    </div>
</nav>


{{-- ╔══════════════════════════════════════════════════╗ --}}
{{--   MOBILE TOP BAR                                   --}}
{{-- ╚══════════════════════════════════════════════════╝ --}}
<div class="fixed top-0 left-0 z-50 w-full bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 shadow-sm md:hidden">
    <div class="px-4 py-3">

        {{-- Logo --}}
        <a href="{{ url('/') }}" class="flex items-center justify-center gap-2 mb-3">
            <img src="{{ asset('storage/img/logo/filterpedialastfilterpedia.png') }}" class="h-8" alt="filterpedia Logo">
            <span class="text-xl font-bold text-gray-900 dark:text-bluefilterpedia">
                filterpedia
            </span>
        </a>

        {{-- Search Bar + Burger Menu Row --}}
        <div class="flex items-center gap-2">

            {{-- Burger Menu Button --}}
            <button
                id="mobile-burger-btn"
                type="button"
                class="shrink-0 flex items-center justify-center w-10 h-10 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                aria-label="Buka menu"
                aria-expanded="false"
            >
                {{-- Hamburger icon --}}
                <svg id="burger-icon-open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                {{-- Close icon --}}
                <svg id="burger-icon-close" class="hidden w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            {{-- Search Bar (full width) --}}
            <div class="flex-1">
                <x-search />
            </div>

        </div>
    </div>
</div>


{{-- ╔══════════════════════════════════════════════════╗ --}}
{{--   MOBILE BURGER DRAWER                             --}}
{{-- ╚══════════════════════════════════════════════════╝ --}}
<div id="mobile-burger-drawer" class="hidden fixed inset-0 z-60 md:hidden">

    {{-- Overlay --}}
    <div
        id="burger-overlay"
        class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm"
    ></div>

    {{-- Drawer Panel --}}
    <div class="fixed left-0 top-0 bottom-0 w-72 bg-white dark:bg-gray-900 shadow-2xl flex flex-col overflow-y-auto">

        {{-- Drawer Header --}}
        <div class="flex items-center justify-between px-4 py-4 border-b border-gray-200 dark:border-gray-700">
            <span class="text-base font-semibold text-gray-900 dark:text-white">Menu</span>
            <button
                id="burger-close-btn"
                type="button"
                class="p-1.5 rounded-lg text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-700 dark:hover:text-white transition-colors"
            >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        {{-- Drawer Body --}}
        <div class="flex-1 px-4 py-4 space-y-1">

            {{-- ── KATEGORI ─────────────────────────────── --}}
            <p class="px-3 pt-1 pb-2 text-xs font-bold uppercase tracking-widest text-gray-900 dark:text-gray-500">
                Kategori
            </p>

            @foreach($categories as $category)
            <a href="{{ route('product.category', $category->slug) }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors group">
                @if($category->icon)
                <span class="shrink-0 w-7 h-7 rounded-full border border-bluefilterpedia flex items-center justify-center bg-white dark:bg-gray-800 overflow-hidden p-1 group-hover:shadow-sm transition-shadow">
                    <img src="{{ asset('storage/' . $category->icon) }}"
                         alt="{{ $category->name }}"
                         class="w-full h-full object-contain">
                </span>
                @else
                <span class="shrink-0 w-7 h-7 rounded-full border border-gray-300 dark:border-gray-600 flex items-center justify-center bg-gray-50 dark:bg-gray-800">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                </span>
                @endif
                <span class="text-sm font-medium truncate">{{ $category->name }}</span>
            </a>
            @endforeach

            {{-- ── DIVIDER ──────────────────────────────── --}}
            <div class="my-3 border-t border-gray-200 dark:border-gray-700"></div>

            {{-- ── TENTANG KAMI ──────────────────────────── --}}
            <a href="{{ url('/about') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                <span class="shrink-0 w-7 h-7 flex items-center justify-center text-gray-500 dark:text-gray-400">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                </span>
                <span class="text-sm font-medium">Tentang Kami</span>
            </a>

            {{-- ── BLOG ──────────────────────────────────── --}}
            <a href="{{ url('/blog') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                <span class="shrink-0 w-7 h-7 flex items-center justify-center text-gray-500 dark:text-gray-400">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"></path>
                        <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z"></path>
                    </svg>
                </span>
                <span class="text-sm font-medium">Blog</span>
            </a>

        </div>

        {{-- Drawer Footer: Theme Toggle --}}
        <div class="px-4 py-4 border-t border-gray-200 dark:border-gray-700">
            <button
                id="theme-toggle-mobile"
                type="button"
                class="flex items-center gap-3 w-full px-3 py-2.5 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
            >
                <svg id="theme-toggle-dark-icon-mobile" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
                <svg id="theme-toggle-light-icon-mobile" class="hidden w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>
                <span id="theme-toggle-text" class="text-sm font-medium">Dark Mode</span>
            </button>
        </div>

    </div>
</div>


{{-- ╔══════════════════════════════════════════════════╗ --}}
{{--   MOBILE BOTTOM NAVIGATION                         --}}
{{-- ╚══════════════════════════════════════════════════╝ --}}
<nav class="fixed bottom-0 left-0 z-50 w-full border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 md:hidden">
    <div class="grid h-16 grid-cols-3">

        {{-- Cart --}}
        <a
            href="{{ url('/cart') }}"
            class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group transition-colors"
        >
            <svg class="w-6 h-6 mb-1 text-gray-500 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <span class="text-xs text-gray-500 group-hover:text-blue-600 transition-colors">Keranjang</span>
        </a>

        {{-- Home --}}
        <a
            href="{{ url('/') }}"
            class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group transition-colors"
        >
            <svg class="w-6 h-6 mb-1 text-gray-500 group-hover:text-blue-600 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
            </svg>
            <span class="text-xs text-gray-500 group-hover:text-blue-600 transition-colors">Home</span>
        </a>

        {{-- Akun / Login --}}
        <div class="relative flex items-center justify-center">

            @auth
            {{-- ── User sudah login: tombol Akun langsung ke /account ── --}}
            <a
                href="{{ url('/account') }}"
                class="inline-flex flex-col items-center justify-center w-full h-16 px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group transition-colors"
            >
                <svg class="w-6 h-6 mb-1 text-gray-500 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="text-xs text-gray-500 group-hover:text-blue-600 transition-colors">Akun</span>
            </a>
            @else
            {{-- ── Guest: tombol Login, klik munculkan dropdown ── --}}
            <button
                id="mobile-login-btn"
                type="button"
                class="inline-flex flex-col items-center justify-center w-full h-16 px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group transition-colors"
            >
                {{-- Icon masuk (arrow-right-on-rectangle) --}}
                <svg class="w-6 h-6 mb-1 text-gray-500 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                </svg>
                <span class="text-xs text-gray-500 group-hover:text-blue-600 transition-colors">Masuk</span>
            </button>

            {{-- Dropdown popup (muncul ke atas) --}}
            <div
                id="mobile-login-dropdown"
                class="hidden absolute bottom-18 right-1 w-44 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden z-50"
            >
                <a
                    href="{{ route('login') }}"
                    class="flex items-center gap-2.5 px-4 py-3 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                >
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                    </svg>
                    Masuk
                </a>

                <div class="border-t border-gray-200 dark:border-gray-700 mx-3"></div>

                <a
                    href="{{ route('register') }}"
                    class="flex items-center gap-2.5 px-4 py-3 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                >
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"/>
                    </svg>
                    Daftar
                </a>
            </div>
            @endauth

        </div>

    </div>
</nav>


{{-- ╔══════════════════════════════════════════════════╗ --}}
{{--   SPACERS                                          --}}
{{-- ╚══════════════════════════════════════════════════╝ --}}
{{-- Desktop spacer --}}
<div class="hidden md:block h-20"></div>
{{-- Mobile spacer (top bar height ~88px) --}}
<div class="block md:hidden h-8"></div>
{{-- Mobile bottom spacer --}}
<div class="h-16 md:hidden"></div>


{{-- ╔══════════════════════════════════════════════════╗ --}}
{{--   SCRIPTS                                          --}}
{{-- ╚══════════════════════════════════════════════════╝ --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ══════════════════════════════════════════════════════════════
    //  Helper: tutup semua dropdown
    // ══════════════════════════════════════════════════════════════
    function closeAllDropdowns() {
        // Tutup mobile login dropdown
        document.getElementById('mobile-login-dropdown')?.classList.add('hidden');
        
        // Tutup desktop profile dropdown
        document.getElementById('desktop-profile-dropdown')?.classList.add('hidden');
        document.getElementById('desktop-profile-btn')?.setAttribute('aria-expanded', 'false');
        
        // Desktop burger dropdown - panggil fungsi yang sudah dibuat
        if (typeof closeDesktopBurgerDropdown === 'function') {
            if (!isDesktopBurgerOpenByClick) {
                closeDesktopBurgerDropdown();
            }
        }
    }

    // ══════════════════════════════════════════════════════════════
    //  MOBILE Burger Drawer
    // ══════════════════════════════════════════════════════════════
    const mobileBurgerBtn     = document.getElementById('mobile-burger-btn');
    const mobileBurgerDrawer  = document.getElementById('mobile-burger-drawer');
    const mobileBurgerOverlay = document.getElementById('burger-overlay');
    const mobileBurgerClose   = document.getElementById('burger-close-btn');

    function openMobileDrawer() {
        mobileBurgerDrawer?.classList.remove('hidden');
        mobileBurgerBtn?.setAttribute('aria-expanded', 'true');
        document.getElementById('burger-icon-open')?.classList.add('hidden');
        document.getElementById('burger-icon-close')?.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileDrawer() {
        mobileBurgerDrawer?.classList.add('hidden');
        mobileBurgerBtn?.setAttribute('aria-expanded', 'false');
        document.getElementById('burger-icon-open')?.classList.remove('hidden');
        document.getElementById('burger-icon-close')?.classList.add('hidden');
        document.body.style.overflow = '';
    }

    mobileBurgerBtn?.addEventListener('click', function (e) {
        e.stopPropagation();
        closeAllDropdowns();
        mobileBurgerDrawer?.classList.contains('hidden') ? openMobileDrawer() : closeMobileDrawer();
    });
    mobileBurgerClose?.addEventListener('click', closeMobileDrawer);
    mobileBurgerOverlay?.addEventListener('click', closeMobileDrawer);

    // ══════════════════════════════════════════════════════════════
    //  DESKTOP Burger Dropdown - HOVER TANPA UBAH ICON
    // ══════════════════════════════════════════════════════════════
    const desktopBurgerBtn = document.getElementById('desktop-burger-btn');
    const desktopBurgerDropdown = document.getElementById('desktop-burger-dropdown');
    const desktopBurgerWrapper = document.getElementById('desktop-burger-wrapper');
    const burgerIconOpen = document.getElementById('desktop-burger-icon-open');
    const burgerIconClose = document.getElementById('desktop-burger-icon-close');

    let isDesktopBurgerOpenByClick = false; // false = tutup, true = terbuka karena click
    let hoverTimer = null;

    // Fungsi buka dropdown (HANYA buka dropdown, tidak ubah icon)
    function openDesktopBurgerDropdown() {
        desktopBurgerDropdown?.classList.remove('hidden');
        desktopBurgerBtn?.setAttribute('aria-expanded', 'true');
        // TIDAK mengubah icon di sini
    }

    // Fungsi tutup dropdown
    function closeDesktopBurgerDropdown() {
        desktopBurgerDropdown?.classList.add('hidden');
        desktopBurgerBtn?.setAttribute('aria-expanded', 'false');
        // TIDAK mengubah icon di sini
        if (hoverTimer) {
            clearTimeout(hoverTimer);
            hoverTimer = null;
        }
    }

    // Fungsi untuk mode click (ubah icon)
    function setClickMode(active) {
        if (active) {
            // Mode click aktif: icon berubah jadi X
            burgerIconOpen?.classList.add('hidden');
            burgerIconClose?.classList.remove('hidden');
            isDesktopBurgerOpenByClick = true;
        } else {
            // Mode click nonaktif: icon kembali ke burger
            burgerIconOpen?.classList.remove('hidden');
            burgerIconClose?.classList.add('hidden');
            isDesktopBurgerOpenByClick = false;
        }
    }

    // Hover masuk ke wrapper
    desktopBurgerWrapper?.addEventListener('mouseenter', function () {
        if (hoverTimer) clearTimeout(hoverTimer);
        
        // Hanya buka dropdown jika belum terbuka
        if (desktopBurgerDropdown?.classList.contains('hidden')) {
            closeAllDropdowns(); // tutup dropdown lain
            
            // Buka dropdown tanpa mengubah icon
            openDesktopBurgerDropdown();
            // isDesktopBurgerOpenByClick tetap false, icon tetap burger
        }
    });

    // Hover keluar dari wrapper
    desktopBurgerWrapper?.addEventListener('mouseleave', function (e) {
        // Cek apakah mouse benar-benar keluar dari wrapper
        const relatedTarget = e.relatedTarget;
        if (!desktopBurgerWrapper.contains(relatedTarget)) {
            // Jika dropdown terbuka karena hover (bukan click), tutup setelah delay
            if (!isDesktopBurgerOpenByClick) {
                hoverTimer = setTimeout(() => {
                    // Cek lagi apakah mouse masih di dalam wrapper atau dropdown
                    if (!desktopBurgerWrapper.matches(':hover') && 
                        !desktopBurgerDropdown?.matches(':hover')) {
                        closeDesktopBurgerDropdown();
                    }
                }, 300);
            }
            // Jika terbuka karena click, biarkan tetap terbuka
        }
    });

    // Klik tombol burger
    desktopBurgerBtn?.addEventListener('click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        
        if (hoverTimer) clearTimeout(hoverTimer);
        
        if (desktopBurgerDropdown?.classList.contains('hidden')) {
            // Dropdown lagi tertutup -> buka dengan mode click
            closeAllDropdowns(); // tutup dropdown lain
            openDesktopBurgerDropdown(); // buka dropdown
            setClickMode(true); // aktifkan mode click (icon jadi X)
        } else {
            // Dropdown lagi terbuka -> tutup
            closeDesktopBurgerDropdown(); // tutup dropdown
            setClickMode(false); // nonaktifkan mode click (icon kembali burger)
        }
    });

    // Mouse di dalam dropdown
    desktopBurgerDropdown?.addEventListener('mouseenter', function () {
        if (hoverTimer) clearTimeout(hoverTimer);
        // Tidak perlu melakukan apa-apa, hanya mencegah penutupan
    });

    desktopBurgerDropdown?.addEventListener('mouseleave', function (e) {
        const relatedTarget = e.relatedTarget;
        if (!desktopBurgerWrapper.contains(relatedTarget)) {
            // Jika dropdown terbuka karena hover (bukan click), tutup setelah delay
            if (!isDesktopBurgerOpenByClick) {
                hoverTimer = setTimeout(() => {
                    if (!desktopBurgerWrapper.matches(':hover') && 
                        !desktopBurgerDropdown?.matches(':hover')) {
                        closeDesktopBurgerDropdown();
                    }
                }, 300);
            }
        }
    });

    // ══════════════════════════════════════════════════════════════
    //  DESKTOP Profile Dropdown
    // ══════════════════════════════════════════════════════════════
    const profileBtn      = document.getElementById('desktop-profile-btn');
    const profileDropdown = document.getElementById('desktop-profile-dropdown');

    profileBtn?.addEventListener('click', function (e) {
        e.stopPropagation();
        const isHidden = profileDropdown.classList.contains('hidden');
        closeAllDropdowns();
        if (isHidden) {
            profileDropdown.classList.remove('hidden');
            profileBtn.setAttribute('aria-expanded', 'true');
        }
    });

    // ══════════════════════════════════════════════════════════════
    //  MOBILE Login Dropdown (guest only)
    // ══════════════════════════════════════════════════════════════
    const loginBtn      = document.getElementById('mobile-login-btn');
    const loginDropdown = document.getElementById('mobile-login-dropdown');

    loginBtn?.addEventListener('click', function (e) {
        e.stopPropagation();
        const isHidden = loginDropdown.classList.contains('hidden');
        closeAllDropdowns();
        if (isHidden) loginDropdown.classList.remove('hidden');
    });

    // ══════════════════════════════════════════════════════════════
    //  Global: klik di luar tutup semua + Escape + resize
    // ══════════════════════════════════════════════════════════════
    document.addEventListener('click', function (e) {
        // Cek apakah klik di dalam desktop burger wrapper
        if (desktopBurgerWrapper?.contains(e.target)) {
            return; // Biarkan burger menangani sendiri
        }
        
        // Cek apakah klik di dalam profile dropdown
        if (profileBtn?.contains(e.target) || profileDropdown?.contains(e.target)) {
            return; // Biarkan profile menangani sendiri
        }
        
        // Cek apakah klik di dalam mobile login dropdown
        if (loginBtn?.contains(e.target) || loginDropdown?.contains(e.target)) {
            return; // Biarkan mobile login menangani sendiri
        }
        
        // Tutup semua dropdown
        document.getElementById('mobile-login-dropdown')?.classList.add('hidden');
        document.getElementById('desktop-profile-dropdown')?.classList.add('hidden');
        document.getElementById('desktop-profile-btn')?.setAttribute('aria-expanded', 'false');
        
        // Burger dropdown - jika karena click dan klik di luar, tutup
        if (desktopBurgerDropdown && !desktopBurgerDropdown.classList.contains('hidden')) {
            if (isDesktopBurgerOpenByClick) {
                // Jika mode click, tutup dan kembalikan icon
                closeDesktopBurgerDropdown();
                setClickMode(false);
            } else {
                // Jika mode hover, cukup tutup dropdown
                closeDesktopBurgerDropdown();
            }
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            // Tutup semua dropdown
            document.getElementById('mobile-login-dropdown')?.classList.add('hidden');
            document.getElementById('desktop-profile-dropdown')?.classList.add('hidden');
            document.getElementById('desktop-profile-btn')?.setAttribute('aria-expanded', 'false');
            
            // Burger dropdown - tutup dan kembalikan icon
            if (desktopBurgerDropdown && !desktopBurgerDropdown.classList.contains('hidden')) {
                closeDesktopBurgerDropdown();
                setClickMode(false);
            }
            
            closeMobileDrawer();
        }
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth < 768) {
            closeMobileDrawer();
        }
    });

    // ══════════════════════════════════════════════════════════════
    //  Theme Toggle
    // ══════════════════════════════════════════════════════════════
    function setTheme(isDark) {
        const ids = {
            darkDesktop:  ['theme-toggle-dark-icon', 'theme-toggle-dark-icon-mobile', 'theme-toggle-dark-icon-desktop-drawer'],
            lightDesktop: ['theme-toggle-light-icon', 'theme-toggle-light-icon-mobile', 'theme-toggle-light-icon-desktop-drawer'],
            texts:        ['theme-toggle-text', 'theme-toggle-text-desktop-drawer'],
        };

        if (isDark) {
            document.documentElement.classList.add('dark');
            ids.darkDesktop.forEach(id => document.getElementById(id)?.classList.add('hidden'));
            ids.lightDesktop.forEach(id => document.getElementById(id)?.classList.remove('hidden'));
            ids.texts.forEach(id => { const el = document.getElementById(id); if (el) el.textContent = 'Light Mode'; });
            localStorage.setItem('theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            ids.darkDesktop.forEach(id => document.getElementById(id)?.classList.remove('hidden'));
            ids.lightDesktop.forEach(id => document.getElementById(id)?.classList.add('hidden'));
            ids.texts.forEach(id => { const el = document.getElementById(id); if (el) el.textContent = 'Dark Mode'; });
            localStorage.setItem('theme', 'light');
        }
    }

    setTheme(localStorage.getItem('theme') === 'dark');

    ['theme-toggle', 'theme-toggle-mobile', 'theme-toggle-desktop-drawer'].forEach(id => {
        document.getElementById(id)?.addEventListener('click', function (e) {
            e.stopPropagation();
            setTheme(!document.documentElement.classList.contains('dark'));
        });
    });

});
</script>