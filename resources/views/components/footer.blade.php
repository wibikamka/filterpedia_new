{{-- resources/views/components/footer.blade.php --}}
<footer id="main-footer" class="border-t-4 border-bluefilterpedia bg-gray-50 dark:bg-gray-900 text-gray-600 dark:text-white">
    <div class="mx-auto w-full max-w-7xl p-4 py-6 lg:py-8">
        <div class="md:flex md:justify-between">
            {{-- Logo & Brand Section --}}
            <div class="mb-6 md:mb-0">
                <a href="{{ url('/') }}" class="flex items-center">
                    <img src="{{ asset('storage/img/logo/filterpedialastfilterpedia.png') }}" class="me-3 h-8" alt="filterpedia Logo">
                    <span class="self-center whitespace-nowrap text-2xl lg:text-4xl font-semibold text-gray-900 dark:text-bluefilterpedia">
                        filterpedia
                    </span>
                </a>
<p class="mt-3 text-xs max-w-lg leading-relaxed text-gray-600 dark:text-gray-400">
    Dari kebutuhan
    <span class="font-semibold text-gray-900 dark:text-white">industri</span>
    hingga
    <span class="font-semibold text-gray-900 dark:text-white">rumah tangga</span>,
    kami menyediakan solusi filtrasi yang tepat —
    <span class="font-medium text-bluefilterpedia">cartridge filter</span>,
    <span class="font-medium text-bluefilterpedia">housing filter</span>,
    hingga sistem
    <span class="font-semibold text-bluefilterpedia dark:text-blue-400">water treatment</span>
    lengkap untuk
    <span class="font-medium text-gray-700 dark:text-gray-300">manufaktur</span>,
    <span class="font-medium text-gray-700 dark:text-gray-300">farmasi</span>,
    <span class="font-medium text-gray-700 dark:text-gray-300">food & beverage</span>,
    dan kebutuhan air 
    <span class="font-medium text-gray-700 dark:text-gray-300">sehari-hari.</span>,
</p>
{{-- Metode Pembayaran & Pengiriman --}}
<div class="flex flex-col sm:flex-row gap-6 mt-4">
    
    {{-- Payment Methods --}}
    <div>
        <span class="font-semibold text-gray-800 dark:text-gray-200 block mb-2">Metode Pembayaran:</span>
        <div class="grid grid-cols-3 gap-2">
            @foreach([
                ['src' => 'img/logo/Bank_Central_Asia.svg',      'alt' => 'BCA'],
                ['src' => 'img/logo/Bank_Mandiri_logo_2016.svg',  'alt' => 'Mandiri'],
                ['src' => 'img/logo/BANK_BRI_logo.svg',           'alt' => 'BRI'],
                ['src' => 'img/logo/GoPay.svg',                   'alt' => 'GoPay'],
                ['src' => 'img/logo/dana.svg',                    'alt' => 'Dana'],
                ['src' => 'img/logo/shopeepay.svg',               'alt' => 'ShopeePay'],
            ] as $item)
                <div class="w-20 h-10 flex items-center justify-center 
                            bg-white rounded-lg shadow-sm px-2 py-1
                            border border-gray-100">
                    <img src="{{ asset('storage/' . $item['src']) }}" 
                         alt="{{ $item['alt'] }}" 
                         class="w-full h-full object-contain">
                </div>
            @endforeach
        </div>
    </div>

    {{-- Shipping Methods --}}
    <div>
        <span class="font-semibold text-gray-800 dark:text-gray-200 block mb-2">Pengiriman:</span>
        <div class="grid grid-cols-3 gap-2">
            @foreach([
                ['src' => 'img/logo/kurirtokofilterpedia.svg',  'alt' => 'Kurir Filterpedia'],
                ['src' => 'img/logo/J&T_Express_logo.svg',      'alt' => 'J&T Express'],
                ['src' => 'img/logo/New_Logo_JNE.png',          'alt' => 'JNE'],
                ['src' => 'img/logo/gosend-seeklogo.svg',        'alt' => 'GoSend'],
                ['src' => 'img/logo/grab.svg',                   'alt' => 'Grab'],
                ['src' => 'img/logo/tiki.svg',                   'alt' => 'Tiki'],
            ] as $item)
                <div class="w-20 h-10 flex items-center justify-center 
                            bg-white rounded-lg shadow-sm px-2 py-1
                            border border-gray-100">
                    <img src="{{ asset('storage/' . $item['src']) }}" 
                         alt="{{ $item['alt'] }}" 
                         class="w-full h-full object-contain">
                </div>
            @endforeach
        </div>
    </div>

</div>
            </div>
        
            {{-- Footer Links Grid --}}
            <div class="grid grid-cols-2 gap-8 sm:grid-cols-3 sm:gap-6">
                {{-- Resources Column --}}
                <div>
                    <h2 class="mb-6 text-sm font-semibold uppercase text-gray-900 dark:text-bluefilterpedia">Resources</h2>
                    <ul class="font-medium text-gray-600 dark:text-gray-200">
                        <li class="mb-4">
                            <a href="{{ url('/') }}" class="hover:underline hover:text-bluefilterpedia">Home</a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ url('/blog') }}" class="hover:underline hover:text-bluefilterpedia">blog</a>
                        </li>
                        <li>
                            <a href="{{ url('/about') }}" class="hover:underline hover:text-bluefilterpedia">About</a>
                        </li>
                    </ul>
                </div>

                {{-- Follow Us Column --}}
                <div>
                    <h2 class="mb-6 text-sm font-semibold uppercase text-gray-900 dark:text-bluefilterpedia">Follow us</h2>
                    <ul class="font-medium text-gray-600 dark:text-gray-200">
                        <li class="mb-4">
                            <a href="https://www.instagram.com/filterpedia.id" target="_blank" class="hover:underline hover:text-bluefilterpedia">Instagram</a>
                        </li>
                        <li class="mb-4">
                            <a href="https://www.linkedin.com/in/filterpedia-b826a6236" target="_blank" class="hover:underline hover:text-bluefilterpedia">LinkedIn</a>
                        </li>
                        <li>
                            <a href="https://www.tokopedia.com/filterpedia-co-id" target="_blank" class="hover:underline hover:text-bluefilterpedia">Tokopedia</a>
                        </li>
                    </ul>
                </div>

                {{-- Legal Column --}}
                <div>
                    <h2 class="mb-6 text-sm font-semibold uppercase text-gray-900 dark:text-bluefilterpedia">Legal</h2>
                    <ul class="font-medium text-gray-600 dark:text-gray-200">
                        <li class="mb-4">
                            <a href="{{ url('/privacy-policy') }}" class="hover:underline hover:text-bluefilterpedia">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="{{ url('/terms') }}" class="hover:underline hover:text-bluefilterpedia">Terms &amp; Conditions</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Divider --}}
        <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8">

        {{-- Bottom Section --}}
        <div class="sm:flex sm:items-center sm:justify-between">
            {{-- Copyright --}}
            <span class="text-sm text-gray-600 dark:text-gray-400 sm:text-center">
                © {{ date('Y') }} <a href="{{ url('/') }}" class="hover:underline hover:text-bluefilterpedia">filterpedia™</a>. All Rights Reserved.
            </span>

            {{-- Social Media Icons --}}
            <div class="mt-4 flex gap-5 sm:mt-0 sm:justify-center">
                {{-- Linkedin --}}
                <a href="https://www.linkedin.com/in/filterpedia-b826a6236" 
                target="_blank"
                class="text-gray-600 dark:text-gray-200 hover:text-bluefilterpedia transition-colors">

                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" 
                        fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM.5 8h4V24h-4V8zm7.5 0h3.8v2.2h.1c.53-1 1.83-2.2 3.77-2.2C20.4 8 22 10.03 22 13.1V24h-4v-9.6c0-2.3-.82-3.9-2.9-3.9-1.58 0-2.52 1.06-2.94 2.08-.15.36-.19.86-.19 1.36V24h-4V8z"/>
                    </svg>

                    <span class="sr-only">LinkedIn</span>
                </a>

                {{-- Instagram --}}
                <a href="https://www.instagram.com/filterpedia.id" onclick="window.location='instagram://user?username=filterpedia.id';return false;" class="text-gray-600 dark:text-gray-200 hover:text-bluefilterpedia transition-colors">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7.75 2C4.574 2 2 4.574 2 7.75v8.5C2 19.426 4.574 22 7.75 22h8.5C19.426 22 22 19.426 22 16.25v-8.5C22 4.574 19.426 2 16.25 2h-8.5ZM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10Zm6.5-.75a1.25 1.25 0 1 1-2.5 0 1.25 1.25 0 0 1 2.5 0ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z"/>
                    </svg>
                    <span class="sr-only">Instagram</span>
                </a>
            </div>
        </div>
    </div>
</footer>