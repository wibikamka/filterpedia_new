{{-- resources/views/components/navbar.blade.php --}}

{{-- Desktop Navbar (Top) --}}
<nav class="fixed top-0 left-0 z-50 w-full border-b border-gray-200 bg-white shadow-sm hidden md:block">
    <div class="mx-auto flex max-w-screen-xl items-center justify-between px-4 py-4">
        
        {{-- Left Section: Logo --}}
        <div class="flex items-center gap-3">
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <img src="{{ asset('storage/img/logo/filterpedialastfilterpedia.png') }}" class="h-10 lg:h-16" alt="filterpedia Logo">
                <span class="text-xl lg:text-3xl font-bold text-gray-900">
                    filterpedia
                </span>
            </a>
        </div>

        {{-- Right Section: Search + Theme Toggle --}}
        <div class="flex items-center gap-2">
            {{-- Search Bar (Desktop) --}}
 <x-search />


            {{-- Theme Toggle --}}
            <button 
                id="theme-toggle" 
                type="button" 
                class="flex h-10 w-10 items-center justify-center rounded-lg text-gray-500 border-2 border-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300"
                aria-label="Toggle theme"
            >
                {{-- Moon Icon (tampil di light mode) --}}
                <svg id="theme-toggle-dark-icon" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
                {{-- Sun Icon (tampil di dark mode) --}}
                <svg id="theme-toggle-light-icon" class="hidden h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>
</nav>

{{-- Mobile Top Bar --}}
<div class="fixed top-0 left-0 z-50 w-full bg-white border-b border-gray-200 md:hidden">
    <div class="px-4 py-6">
        {{-- Logo --}}
        <a href="{{ url('/') }}" class="flex items-center justify-center gap-2">
            <img src="{{ asset('storage/img/logo/filterpedialastfilterpedia.png') }}" class="h-8" alt="filterpedia Logo">
            <span class="text-xl font-bold text-gray-900">
                filterpedia
            </span>
        </a>

        {{-- Search Bar (tersembunyi by default, muncul saat tombol search diklik) --}}
        <div id="mobile-search-bar" class="hidden mt-3">
            <x-search />
        </div>
    </div>
</div>



{{-- Mobile Bottom Navigation --}}
<nav class="fixed bottom-0 left-0 z-50 w-full border-t border-gray-200 bg-white md:hidden">
    <div class="grid h-16 max-w-lg grid-cols-3 mx-auto">

        {{-- Menu Button (Left) --}}
        <button 
            type="button"
            data-collapse-toggle="mobile-menu-drawer"
            class="inline-flex flex-col items-center justify-center px-5 py-5 hover:bg-gray-50 group"
        >
            <svg class="w-6 h-6 mb-1 text-gray-500 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <span class="text-xs text-gray-500 group-hover:text-blue-600">Menu</span>
        </button>

        {{-- Home Button (Center) --}}
        <a 
            href="{{ url('/') }}"
            class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group"
        >
            <svg class="w-6 h-6 mb-1 text-gray-500 group-hover:text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
            </svg>
            <span class="text-xs text-gray-500 group-hover:text-blue-600">Home</span>
        </a>

        {{-- Search Button (Right) --}}
        <button 
            id="mobile-search-toggle"
            type="button"
            class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group w-full h-full"
        >
            {{-- Ikon Search (tampil saat search bar tertutup) --}}
            <svg id="mobile-search-icon-open" class="w-6 h-6 mb-1 text-gray-500 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
            </svg>
            {{-- Ikon X (tampil saat search bar terbuka) --}}
            <svg id="mobile-search-icon-close" class="hidden w-6 h-6 mb-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            <span id="mobile-search-label" class="text-xs text-gray-500 group-hover:text-blue-600">Search</span>
        </button>

    </div>
</nav>

{{-- Mobile Menu Drawer --}}
<div id="mobile-menu-drawer" class="hidden fixed inset-0 z-[60] md:hidden">
    {{-- Overlay dengan Glass Effect --}}
    <div 
        class="fixed inset-0 bg-gray-900/30 backdrop-blur-sm transition-opacity"
        data-collapse-toggle="mobile-menu-drawer"
    ></div>
    
    {{-- Drawer dengan Glass Effect --}}
    <div class="fixed left-0 top-0 bottom-0 w-64 bg-white/90 backdrop-blur-md shadow-xl transform transition-transform duration-300 ease-in-out">
        <div class="p-4 border-b border-gray-200/50">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900">Menu</h2>
                <button 
                    type="button"
                    data-collapse-toggle="mobile-menu-drawer"
                    class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5"
                >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <ul class="flex flex-col p-4 font-medium space-y-2">
            <li>
                <a href="{{ url('/') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 text-gray-900 hover:bg-gray-100/50">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Home
                </a>
            </li>
            <li>
                <a href="{{ url('/products') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 text-gray-900 hover:bg-gray-100/50">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                    </svg>
                    Products
                </a>
            </li>
            <li>
                <a href="{{ url('/about') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 text-gray-900 hover:bg-gray-100/50">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    About
                </a>
            </li>
            <li class="pt-4 border-t border-gray-200/50">
                <button 
                    id="theme-toggle-mobile" 
                    type="button" 
                    class="flex items-center gap-3 w-full rounded-lg px-3 py-2 text-gray-900 hover:bg-gray-100/50"
                >
                    <svg id="theme-toggle-dark-icon-mobile" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon-mobile" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                    <span id="theme-toggle-text">Dark Mode</span>
                </button>
            </li>
        </ul>
    </div>
</div>

{{-- Spacer untuk fixed navbar --}}
<div class="h-8 md:h-20"></div>

{{-- Bottom spacer for mobile --}}
<div class="h-16 md:hidden"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // ── Tutup semua overlay/dropdown ──────────────────────────────
        function closeAllDrawers() {
            const mobileMenuDrawer = document.getElementById('mobile-menu-drawer');
            if (mobileMenuDrawer) mobileMenuDrawer.classList.add('hidden');

            document.querySelectorAll('[data-collapse-toggle]').forEach(btn => {
                btn.setAttribute('aria-expanded', 'false');
            });
        }

        // ── data-collapse-toggle (menu drawer) ───────────────────────
        document.querySelectorAll('[data-collapse-toggle]').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                const target = document.getElementById(this.getAttribute('data-collapse-toggle'));
                if (!target) return;

                const isOpening = target.classList.contains('hidden');
                if (isOpening) closeAllDrawers();

                target.classList.toggle('hidden');
                this.setAttribute('aria-expanded', !target.classList.contains('hidden'));
            });
        });

        // Tutup drawer saat klik overlay
        const overlay = document.querySelector('#mobile-menu-drawer .fixed.inset-0');
        if (overlay) overlay.addEventListener('click', function(e) {
            if (e.target === this) closeAllDrawers();
        });

        // Tutup saat Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeAllDrawers();
        });

        // Tutup saat resize
        window.addEventListener('resize', closeAllDrawers);

        // ── Mobile Search Toggle ──────────────────────────────────────
        const searchToggleBtn  = document.getElementById('mobile-search-toggle');
        const searchBar        = document.getElementById('mobile-search-bar');
        const searchIconOpen   = document.getElementById('mobile-search-icon-open');
        const searchIconClose  = document.getElementById('mobile-search-icon-close');
        const searchLabel      = document.getElementById('mobile-search-label');

        if (searchToggleBtn && searchBar) {
            searchToggleBtn.addEventListener('click', function(e) {
                e.stopPropagation();

                const isHidden = searchBar.classList.contains('hidden');

                if (isHidden) {
                    // Buka search bar
                    searchBar.classList.remove('hidden');
                    searchIconOpen.classList.add('hidden');
                    searchIconClose.classList.remove('hidden');
                    searchLabel.textContent = 'Tutup';
                    searchLabel.classList.add('text-blue-600');
                    searchLabel.classList.remove('text-gray-500');
                    // Fokus ke input otomatis
                    const input = searchBar.querySelector('input');
                    if (input) setTimeout(() => input.focus(), 50);
                } else {
                    // Tutup search bar
                    searchBar.classList.add('hidden');
                    searchIconOpen.classList.remove('hidden');
                    searchIconClose.classList.add('hidden');
                    searchLabel.textContent = 'Search';
                    searchLabel.classList.remove('text-blue-600');
                    searchLabel.classList.add('text-gray-500');
                }
            });
        }

        // ── Theme Toggle ──────────────────────────────────────────────
        function setTheme(isDark) {
            if (isDark) {
                document.documentElement.classList.add('dark');
                document.getElementById('theme-toggle-dark-icon')?.classList.add('hidden');
                document.getElementById('theme-toggle-light-icon')?.classList.remove('hidden');
                document.getElementById('theme-toggle-dark-icon-mobile')?.classList.add('hidden');
                document.getElementById('theme-toggle-light-icon-mobile')?.classList.remove('hidden');
                const txt = document.getElementById('theme-toggle-text');
                if (txt) txt.textContent = 'Light Mode';
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                document.getElementById('theme-toggle-dark-icon')?.classList.remove('hidden');
                document.getElementById('theme-toggle-light-icon')?.classList.add('hidden');
                document.getElementById('theme-toggle-dark-icon-mobile')?.classList.remove('hidden');
                document.getElementById('theme-toggle-light-icon-mobile')?.classList.add('hidden');
                const txt = document.getElementById('theme-toggle-text');
                if (txt) txt.textContent = 'Dark Mode';
                localStorage.setItem('theme', 'light');
            }
        }

        // Default = light, kecuali tersimpan dark
        setTheme(localStorage.getItem('theme') === 'dark');

        document.getElementById('theme-toggle')?.addEventListener('click', function(e) {
            e.stopPropagation();
            setTheme(!document.documentElement.classList.contains('dark'));
        });

        document.getElementById('theme-toggle-mobile')?.addEventListener('click', function(e) {
            e.stopPropagation();
            setTheme(!document.documentElement.classList.contains('dark'));
        });
    });
</script>