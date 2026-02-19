{{-- resources/views/components/navbar.blade.php --}}

{{-- Desktop Navbar (Top) --}}
<nav class="fixed top-0 left-0 z-50 w-full border-b border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900 hidden md:block">
    <div class="mx-auto flex max-w-screen-xl items-center justify-between px-4 py-4">
        
        {{-- Left Section: Logo --}}
        <div class="flex items-center gap-3">
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <img src="{{ asset('storage/img/logo/filterpedialastfilterpedia.png') }}" class="h-10 lg:h-16" alt="filterpedia Logo">
                <span class="text-xl lg:text-3xl font-bold text-gray-900 dark:text-white">
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
                class="flex h-10 w-10 items-center justify-center rounded-lg text-gray-500 border-2 border-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
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
<div class="fixed top-0 left-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-900 dark:border-gray-700 md:hidden">
    <div class="px-4 py-3">
        {{-- Logo and App Name --}}
        <a href="{{ url('/') }}" class="flex items-center justify-center gap-2 mb-3">
            <img src="{{ asset('storage/img/logo/filterpedialastfilterpedia.png') }}" class="h-8" alt="filterpedia Logo">
            <span class="text-xl font-bold text-gray-900 dark:text-white">
                filterpedia
            </span>
        </a>

        {{-- Search Bar --}}
 <x-search />
    </div>
</div>

{{-- resources/views/components/navbar.blade.php --}}

{{-- ... kode sebelumnya ... --}}

{{-- Mobile Bottom Navigation --}}
<nav class="fixed bottom-0 left-0 z-50 w-full border-t border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-900 md:hidden">
    <div class="grid h-16 max-w-lg grid-cols-3 mx-auto">
        {{-- Menu Button (Left) --}}
        <button 
            type="button"
            data-collapse-toggle="mobile-menu-drawer"
            class="inline-flex flex-col items-center justify-center px-5 py-5 hover:bg-gray-50 dark:hover:bg-gray-800 group"
        >
            <svg class="w-6 h-6 mb-1 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <span class="text-xs text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Menu</span>
        </button>

        {{-- Home Button (Center) --}}
        <a 
            href="{{ url('/') }}"
            class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group"
        >
            <svg class="w-6 h-6 mb-1 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
            </svg>
            <span class="text-xs text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Home</span>
        </a>

        {{-- Shop Button (Right) dengan Dropdown --}}
        <div class="relative">
            <button 
                id="shop-toggle"
                type="button"
                class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group w-full h-full"
                aria-expanded="false"
                aria-haspopup="true"
            >
                <svg class="w-6 h-6 mb-1 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                </svg>
                <span class="text-xs text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Shop</span>
            </button>

{{-- Dropdown Menu --}}
<div 
    id="shop-dropdown"
    class="absolute hidden bottom-14 right-0 z-50 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700"
    aria-labelledby="shop-toggle"
>
    <div class="py-1">
        <a 
            href="https://www.tokopedia.com/filterpedia-co-id"
            target="_blank"
            rel="noopener noreferrer"
            class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
        >
            <img 
                src="{{ asset('storage/img/logo/tokopedialogo.png') }}" 
                alt="Tokopedia"
                class="w-5 h-5"
            >
            <span>Shop via Tokopedia</span>
        </a>

        <a 
            href="https://wa.me/6281282388324"
            class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
        >
            <img 
                src="{{ asset('storage/img/logo/waicon1.png') }}" 
                alt="Contact"
                class="w-5 h-5"
            >
            <span>Contact Us</span>
        </a>
    </div>
</div>

        </div>
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
    <div class="fixed left-0 top-0 bottom-0 w-64 bg-white/90 dark:bg-gray-900/90 backdrop-blur-md shadow-xl transform transition-transform duration-300 ease-in-out">
        <div class="p-4 border-b border-gray-200/50 dark:border-gray-700/50">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Menu</h2>
                <button 
                    type="button"
                    data-collapse-toggle="mobile-menu-drawer"
                    class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 dark:hover:bg-gray-600 dark:hover:text-white"
                >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <ul class="flex flex-col p-4 font-medium space-y-2">
            <li>
                <a href="{{ url('/') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 text-gray-900 hover:bg-gray-100/50 dark:text-white dark:hover:bg-gray-700/50">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Home
                </a>
            </li>
            <li>
                <a href="{{ url('/products') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 text-gray-900 hover:bg-gray-100/50 dark:text-white dark:hover:bg-gray-700/50">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                    </svg>
                    Products
                </a>
            </li>
            <li>
                <a href="{{ url('/about') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 text-gray-900 hover:bg-gray-100/50 dark:text-white dark:hover:bg-gray-700/50">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    About
                </a>
            </li>
            <li class="pt-4 border-t border-gray-200/50 dark:border-gray-700/50">
                <button 
                    id="theme-toggle-mobile" 
                    type="button" 
                    class="flex items-center gap-3 w-full rounded-lg px-3 py-2 text-gray-900 hover:bg-gray-100/50 dark:text-white dark:hover:bg-gray-700/50"
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
        console.log('Navbar script loaded');

        // Fungsi untuk menutup semua drawer
        function closeAllDrawers() {
            // Tutup mobile menu drawer
            const mobileMenuDrawer = document.getElementById('mobile-menu-drawer');
            if (mobileMenuDrawer) {
                mobileMenuDrawer.classList.add('hidden');
            }
            
            // Tutup shop dropdown
            const shopDropdown = document.getElementById('shop-dropdown');
            if (shopDropdown) {
                shopDropdown.classList.add('hidden');
                const shopToggle = document.getElementById('shop-toggle');
                if (shopToggle) {
                    shopToggle.setAttribute('aria-expanded', 'false');
                }
            }
            
            // Update semua tombol
            document.querySelectorAll('[data-collapse-toggle]').forEach(button => {
                button.setAttribute('aria-expanded', 'false');
            });
        }

        // Toggle collapsible elements
        document.querySelectorAll('[data-collapse-toggle]').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                const targetId = this.getAttribute('data-collapse-toggle');
                const target = document.getElementById(targetId);
                
                if (target) {
                    const isOpening = target.classList.contains('hidden');
                    
                    // Jika membuka drawer, tutup yang lain
                    if (isOpening) {
                        closeAllDrawers();
                    }
                    
                    // Toggle target
                    target.classList.toggle('hidden');
                    this.setAttribute('aria-expanded', !target.classList.contains('hidden'));
                }
            });
        });

        // Tutup drawer saat klik overlay
        const overlay = document.querySelector('#mobile-menu-drawer .fixed.inset-0');
        if (overlay) {
            overlay.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeAllDrawers();
                }
            });
        }

        // Tutup drawer saat tekan Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAllDrawers();
            }
        });

        // Theme toggle functionality
        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeToggleMobileBtn = document.getElementById('theme-toggle-mobile');
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        const themeToggleDarkIconMobile = document.getElementById('theme-toggle-dark-icon-mobile');
        const themeToggleLightIconMobile = document.getElementById('theme-toggle-light-icon-mobile');
        const themeToggleText = document.getElementById('theme-toggle-text');

        // Function to set theme
        function setTheme(isDark) {
            if (isDark) {
                document.documentElement.classList.add('dark');
                if (themeToggleDarkIcon) themeToggleDarkIcon.classList.add('hidden');
                if (themeToggleLightIcon) themeToggleLightIcon.classList.remove('hidden');
                if (themeToggleDarkIconMobile) themeToggleDarkIconMobile.classList.add('hidden');
                if (themeToggleLightIconMobile) themeToggleLightIconMobile.classList.remove('hidden');
                if (themeToggleText) themeToggleText.textContent = 'Light Mode';
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                if (themeToggleDarkIcon) themeToggleDarkIcon.classList.remove('hidden');
                if (themeToggleLightIcon) themeToggleLightIcon.classList.add('hidden');
                if (themeToggleDarkIconMobile) themeToggleDarkIconMobile.classList.remove('hidden');
                if (themeToggleLightIconMobile) themeToggleLightIconMobile.classList.add('hidden');
                if (themeToggleText) themeToggleText.textContent = 'Dark Mode';
                localStorage.setItem('theme', 'light');
            }
        }

        // Check saved theme ONLY (ignore system preference)
        const savedTheme = localStorage.getItem('theme');

        // Default = LIGHT
        if (savedTheme === 'dark') {
            setTheme(true);
        } else {
            setTheme(false);
        }

        // Toggle theme on click (Desktop)
        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                const isDark = document.documentElement.classList.contains('dark');
                setTheme(!isDark);
            });
        }

        // Toggle theme on click (Mobile)
        if (themeToggleMobileBtn) {
            themeToggleMobileBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                const isDark = document.documentElement.classList.contains('dark');
                setTheme(!isDark);
            });
        }

        // Shop dropdown functionality
        const shopToggle = document.getElementById('shop-toggle');
        const shopDropdown = document.getElementById('shop-dropdown');

        if (shopToggle && shopDropdown) {
            console.log('Shop elements found');
            
            // Initialize aria-expanded
            shopToggle.setAttribute('aria-expanded', 'false');
            
            // Toggle dropdown on button click
            shopToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                e.preventDefault();
                
                console.log('Shop button clicked');
                
                // Tutup mobile menu drawer jika terbuka
                closeAllDrawers();
                
                // Toggle shop dropdown
                const isOpening = shopDropdown.classList.contains('hidden');
                shopDropdown.classList.toggle('hidden');
                shopToggle.setAttribute('aria-expanded', !shopDropdown.classList.contains('hidden'));
                
                console.log('Shop dropdown is now:', shopDropdown.classList.contains('hidden') ? 'hidden' : 'visible');
            });

            // Mencegah dropdown tertutup saat klik di dalam dropdown
            shopDropdown.addEventListener('click', function(e) {
                e.stopPropagation();
            });

            // Tutup dropdown saat klik di luar
            document.addEventListener('click', function(e) {
                if (shopDropdown && !shopDropdown.contains(e.target) && 
                    shopToggle && !shopToggle.contains(e.target)) {
                    shopDropdown.classList.add('hidden');
                    shopToggle.setAttribute('aria-expanded', 'false');
                }
            });

            // Tutup dropdown saat tekan Escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && shopDropdown && !shopDropdown.classList.contains('hidden')) {
                    shopDropdown.classList.add('hidden');
                    shopToggle.setAttribute('aria-expanded', 'false');
                }
            });

            // Tutup dropdown saat scroll (optional)
            window.addEventListener('scroll', function() {
                if (shopDropdown && !shopDropdown.classList.contains('hidden')) {
                    shopDropdown.classList.add('hidden');
                    shopToggle.setAttribute('aria-expanded', 'false');
                }
            });
        }

        // Tutup semua dropdown saat resize window
        window.addEventListener('resize', function() {
            closeAllDrawers();
        });
    });
</script>