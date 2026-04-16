<!DOCTYPE html>
<html lang="id">
<head>
    {{-- Basic Meta --}}
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Primary SEO --}}
    <title>@yield('title', 'Filterpedia - Supplier Cartridge Filter & Water Treatment')</title>
    <meta name="description" content="@yield('meta_description', 'Filterpedia adalah supplier cartridge filter, housing filter, dan solusi water treatment untuk industri dan komersial.')">
    <meta name="keywords" content="@yield('meta_keywords', 'cartridge filter, housing filter, water treatment, filter industri, filter air, gemu filter, pentair, everpure, filter air minum, filter kolam renang, uv sterilizer, filter industri kimia, filter industri makanan, filter industri farmasi, nuvonic, filter industri tekstil, filter industri pulp & paper, filter industri minyak & gas, filter industri elektronik, filter industri otomotif')">
    <meta name="author" content="Filterpedia">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph (Facebook, LinkedIn) --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('title', 'Filterpedia')">
    <meta property="og:description" content="@yield('meta_description', 'Solusi filter industri dan water treatment terpercaya.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Filterpedia')">
    <meta name="twitter:description" content="@yield('meta_description', 'Solusi filter industri dan water treatment terpercaya.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-default.jpg'))">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('structured_data')
</head>

<body class="bg-white dark:bg-gray-950 
text-gray-900 dark:text-gray-100 
overflow-x-hidden transition-colors duration-300">

    {{-- Navbar --}}
    <x-navbar />
    @hasSection('full-width-content')
        @yield('full-width-content') {{-- TANPA CONTAINER --}}
    @else
    {{-- Content --}}
<main class="container mx-auto px-4 sm:px-6 lg:px-16 2xl:px-32 min-h-screen">
    
    {{-- WhatsApp Button --}}
  <a 
    id="wa-button" 
    href="https://wa.me/6281110058788?text=Halo,%20saya%20ingin%20berkonsultasi"
    target="_blank"
    class="fixed bottom-32 md:bottom-28 right-4 md:right-6 z-50 group floating-button"
    aria-label="Konsultasi via WhatsApp">
        
        {{-- Rectangle Container --}}
        <div class="button-container flex items-center bg-white dark:bg-gray-800 rounded-full shadow-lg hover:shadow-xl overflow-hidden pl-1 py-1">
            {{-- WhatsApp Icon (Bulat di Kiri) --}}
            <div class="w-12 h-12 md:w-16 md:h-16 rounded-full flex items-center justify-center ring-2 ring-green-500 shrink-0">
                <img 
                    src="{{ asset('storage/img/logo/waicon1.png') }}" 
                    alt="WhatsApp" 
                    class="w-full h-full rounded-full object-cover">
            </div>
            
            {{-- Text (di Kanan) - Muncul saat hover --}}
            <span class="button-text text-gray-900 dark:text-gray-100 font-medium text-sm md:text-base whitespace-nowrap text-center">
                Konsultasi
            </span>
        </div>
    </a>

    {{-- Tokopedia Button --}}
<a 
    id="tok-button"
    href="https://www.tokopedia.com/filterpedia-co-id"
    target="_blank"
    class="fixed bottom-16 md:bottom-16 right-4 md:right-6 z-50 group floating-button"
    aria-label="Kunjungi Toko Tokopedia">
        
        {{-- Rectangle Container --}}
        <div class="button-container flex items-center bg-white dark:bg-gray-800 rounded-full shadow-lg hover:shadow-xl overflow-hidden pl-1 py-1">
            {{-- Tokopedia Icon (Bulat di Kiri) --}}
            <div class="w-12 h-12 md:w-16 md:h-16 rounded-full bg-white dark:bg-gray-700 flex items-center justify-center ring-2 ring-green-600 shrink-0">
                <img 
                    src="{{ asset('storage/img/logo/Tokopedia_Mascot.png') }}" 
                    alt="Tokopedia" 
                    class="w-full h-full p-2 object-cover">
            </div>
            
            {{-- Text (di Kanan) - Muncul saat hover --}}
            <span class="button-text text-gray-900 dark:text-gray-100 font-medium text-sm md:text-base whitespace-nowrap text-center">
                Tokopedia
            </span>
        </div>
    </a>
    
    {{-- shopee Button --}}
     <a id="shopee-button"
    href="https://www.shopee.co.id/filterpedia"
    target="_blank"
    class="fixed bottom-0 md:bottom-4 right-4 md:right-6 z-50 group floating-button"
    aria-label="Kunjungi Toko Shopee">
        
        {{-- Rectangle Container --}}
        <div class="button-container flex items-center bg-white dark:bg-gray-800 rounded-full shadow-lg hover:shadow-xl overflow-hidden pl-1 py-1">
            {{-- Tokopedia Icon (Bulat di Kiri) --}}
            <div class="w-12 h-12 md:w-16 md:h-16 rounded-full bg-white dark:bg-gray-700 flex items-center justify-center ring-2 ring-orange-600 shrink-0">
                <img 
                    src="{{ asset('storage/img/logo/shopee-link.png') }}" 
                    alt="Shopee" 
                    class="w-full h-full p-2 object-cover">
            </div>
            
            {{-- Text (di Kanan) - Muncul saat hover --}}
            <span class="button-text text-gray-900 dark:text-gray-100 font-medium text-sm md:text-base whitespace-nowrap text-center">
                Shopee
            </span>
        </div>
    </a>

    @yield('content')
</main>
@endif
    {{-- Footer --}}
    <x-footer />

    <script>
        const waBtn = document.getElementById('wa-button');
        const tokBtn = document.getElementById('tok-button');
        const shopeeBtn = document.getElementById('shopee-button');
        const footer = document.getElementById('main-footer');
    
        function updateButtonPosition() {
            const footerRect = footer.getBoundingClientRect();
            const windowHeight = window.innerHeight;
    
            const distanceFromBottom = windowHeight - footerRect.top;
    
            if (distanceFromBottom > 0) {
                
                const offset = distanceFromBottom + 12; 
    
        waBtn.style.bottom = (offset + 92) + 'px';
        
        // Tokopedia - tengah (beri jarak 64px dari WA)
        tokBtn.style.bottom = (offset + 28) + 'px';
        
        // Shopee - paling atas (beri jarak 64px dari Tokopedia)
        shopeeBtn.style.bottom = (offset - 36) + 'px';
            } else {
                waBtn.style.bottom = '';
                tokBtn.style.bottom = '';
                shopeeBtn.style.bottom = '';
            }
        }
    
        window.addEventListener('scroll', updateButtonPosition);
        window.addEventListener('resize', updateButtonPosition);
        updateButtonPosition(); // jalankan sekali saat load
    </script>
</body>

</html>