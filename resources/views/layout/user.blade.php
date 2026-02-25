<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Filterpedia')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white dark:bg-gray-950 
text-gray-900 dark:text-gray-100 
overflow-x-hidden transition-colors duration-300">

    {{-- Navbar --}}
    <x-navbar />

    {{-- Content --}}
<main class="container mx-auto px-4 sm:px-6 lg:px-24 py-4 lg:py-8 min-h-screen">
    
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
            <div class="w-12 h-12 md:w-16 md:h-16 rounded-full flex items-center justify-center ring-2 ring-green-500 flex-shrink-0">
                <img 
                    src="{{ asset('storage/img/logo/waicon1.png') }}" 
                    alt="WhatsApp" 
                    class="w-full h-full rounded-full object-cover">
            </div>
            
            {{-- Text (di Kanan) - Muncul saat hover --}}
            <span class="button-text text-gray-900 dark:text-gray-100 font-medium text-sm md:text-base whitespace-nowrap text-center">
                Consultation
            </span>
        </div>
    </a>

    {{-- Tokopedia Button --}}
    <a 
        id="tok-button"
        href="https://www.tokopedia.com/filterpedia-co-id"
        target="_blank"
        class="fixed bottom-16 md:bottom-8 right-4 md:right-6 z-50 group floating-button"
        aria-label="Kunjungi Toko Tokopedia">
        
        {{-- Rectangle Container --}}
        <div class="button-container flex items-center bg-white dark:bg-gray-800 rounded-full shadow-lg hover:shadow-xl overflow-hidden pl-1 py-1">
            {{-- Tokopedia Icon (Bulat di Kiri) --}}
            <div class="w-12 h-12 md:w-16 md:h-16 rounded-full bg-white dark:bg-gray-700 flex items-center justify-center ring-2 ring-green-600 flex-shrink-0">
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

    @yield('content')
</main>

    {{-- Footer --}}
    <x-footer />

</body>
<script>
    const waBtn = document.getElementById('wa-button');
    const tokBtn = document.getElementById('tok-button');
    const footer = document.getElementById('main-footer');

    function updateButtonPosition() {
        const footerRect = footer.getBoundingClientRect();
        const windowHeight = window.innerHeight;

        const distanceFromBottom = windowHeight - footerRect.top;

        if (distanceFromBottom > 0) {
            
            const offset = distanceFromBottom + 12; 

            waBtn.style.bottom = (offset + 92) + 'px'; 
            tokBtn.style.bottom = (offset + 16) + 'px';
        } else {
            waBtn.style.bottom = '';
            tokBtn.style.bottom = '';
        }
    }

    window.addEventListener('scroll', updateButtonPosition);
    window.addEventListener('resize', updateButtonPosition);
    updateButtonPosition(); // jalankan sekali saat load
</script>
<style>

.button-container {
    width: 3.5rem; /* 56px - sesuai icon w-12 (48px) + padding */
    height: 3.5rem; /* 56px */
    transition: width 0.3s ease-in-out;
    padding-right: 0.25rem;
}

@media (min-width: 768px) {
    .button-container {
        width: 4.5rem; /* 72px - sesuai icon w-16 (64px) + padding */
        height: 4.5rem; /* 72px */
    }
}
    
    /* Text tersembunyi by default */
    .button-text {
        opacity: 0;
        width: 0;
        margin-left: 0;
        transition: opacity 0.3s ease-in-out, width 0.3s ease-in-out, margin-left 0.3s ease-in-out;
    }
    
    /* Hover state - expand dengan text */
    .floating-button:hover .button-container {
        width: 11rem; /* 176px */
        padding-right: 1rem;
    }
    
    @media (min-width: 768px) {
        .floating-button:hover .button-container {
            width: 13rem; /* 208px */
        }
    }
    
    /* Text muncul saat hover */
    .floating-button:hover .button-text {
        opacity: 1;
        width: auto;
        margin-left: 0.75rem;
    }
    
    /* Hover effect untuk ring */
    .floating-button:hover .ring-green-500,
    .floating-button:hover .ring-green-600 {
        box-shadow: 0 0 15px rgba(34, 197, 94, 0.5);
    }
</style>
</html>