{{-- resources/views/components/footer.blade.php --}}
<footer id="main-footer" class="border-t-4 border-bluefilterpedia bg-gray-50 dark:bg-gray-900 text-gray-600 dark:text-white">
    <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
        <div class="md:flex md:justify-between">
            {{-- Logo & Brand Section --}}
            <div class="mb-6 md:mb-0">
                <a href="{{ url('/') }}" class="flex items-center">
                    <img src="{{ asset('storage/img/logo/filterpedialastfilterpedia.png') }}" class="me-3 h-8" alt="filterpedia Logo">
                    <span class="self-center whitespace-nowrap text-2xl lg:text-4xl font-semibold text-gray-900 dark:text-bluefilterpedia">
                        filterpedia
                    </span>
                </a>
                
                {{-- Metode Pembayaran & Pengiriman --}}
                <div class="flex flex-col sm:flex-row gap-6 mt-4">
                    {{-- Payment Methods --}}
                    <div>
                        <span class="font-semibold text-gray-800 dark:text-gray-200 block mb-2">Metode Pembayaran:</span>
                        <div class="grid grid-cols-3 gap-2">
                            <img src="{{ asset('storage/img/logo/Bank_Central_Asia.svg') }}" alt="BCA" class="h-8 w-auto object-contain bg-white rounded p-1">
                            <img src="{{ asset('storage/img/logo/Bank_Mandiri_logo_2016.svg') }}" alt="Mandiri" class="h-8 w-auto object-contain bg-white rounded p-1">
                            <img src="{{ asset('storage/img/logo/BANK_BRI_logo.svg') }}" alt="BRI" class="h-8 w-auto object-contain bg-white rounded p-1">
                            <img src="{{ asset('storage/img/logo/Bank_Central_Asia.svg') }}" alt="BNI" class="h-8 w-auto object-contain bg-white rounded p-1">
                            <img src="{{ asset('storage/img/logo/Bank_Mandiri_logo_2016.svg') }}" alt="CIMB" class="h-8 w-auto object-contain bg-white rounded p-1">
                            <img src="{{ asset('storage/img/logo/BANK_BRI_logo.svg') }}" alt="Danamon" class="h-8 w-auto object-contain bg-white rounded p-1">
                        </div>
                    </div>

                    {{-- Shipping Methods --}}
                    <div>
                        <span class="font-semibold text-gray-800 dark:text-gray-200 block mb-2">Pengiriman:</span>
                        <div class="grid grid-cols-3 gap-2">
                            <img src="{{ asset('storage/img/logo/kurirtokofilterpedia.svg') }}" alt="Kurir Filterpedia" class="h-8 w-auto object-contain bg-white rounded p-1">
                            <img src="{{ asset('storage/img/logo/J&T_Express_logo.svg') }}" alt="J&T Express" class="h-8 w-auto object-contain bg-white rounded p-1">
                            <img src="{{ asset('storage/img/logo/New_Logo_JNE.png') }}" alt="JNE" class="h-8 w-auto object-contain bg-white rounded p-1">
                            <img src="{{ asset('storage/img/logo/J&T_Express_logo.svg') }}" alt="SiCepat" class="h-8 w-auto object-contain bg-white rounded p-1">
                            <img src="{{ asset('storage/img/logo/New_Logo_JNE.png') }}" alt="Anteraja" class="h-8 w-auto object-contain bg-white rounded p-1">
                            <img src="{{ asset('storage/img/logo/kurirtokofilterpedia.svg') }}" alt="Ninja Express" class="h-8 w-auto object-contain bg-white rounded p-1">
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
                            <a href="#produk-terbaru" class="hover:underline hover:text-bluefilterpedia">Products</a>
                        </li>
                        <li>
                            <a href="{{ url('#') }}" class="hover:underline hover:text-bluefilterpedia">About</a>
                        </li>
                    </ul>
                </div>

                {{-- Follow Us Column --}}
                <div>
                    <h2 class="mb-6 text-sm font-semibold uppercase text-gray-900 dark:text-bluefilterpedia">Follow us</h2>
                    <ul class="font-medium text-gray-600 dark:text-gray-200">
                        <li class="mb-4">
                            <a href="#" class="hover:underline hover:text-bluefilterpedia">Instagram</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline hover:text-bluefilterpedia">Tokopedia</a>
                        </li>
                    </ul>
                </div>

                {{-- Legal Column --}}
                <div>
                    <h2 class="mb-6 text-sm font-semibold uppercase text-gray-900 dark:text-bluefilterpedia">Legal</h2>
                    <ul class="font-medium text-gray-600 dark:text-gray-200">
                        <li class="mb-4">
                            <a href="#" class="hover:underline hover:text-bluefilterpedia">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline hover:text-bluefilterpedia">Terms &amp; Conditions</a>
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
                {{-- Facebook --}}
                <a href="#" class="text-gray-600 dark:text-gray-200 hover:text-bluefilterpedia transition-colors">
                    <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="sr-only">Facebook page</span>
                </a>

                {{-- Instagram --}}
                <a href="#" class="text-gray-600 dark:text-gray-200 hover:text-bluefilterpedia transition-colors">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7.75 2C4.574 2 2 4.574 2 7.75v8.5C2 19.426 4.574 22 7.75 22h8.5C19.426 22 22 19.426 22 16.25v-8.5C22 4.574 19.426 2 16.25 2h-8.5ZM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10Zm6.5-.75a1.25 1.25 0 1 1-2.5 0 1.25 1.25 0 0 1 2.5 0ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z"/>
                    </svg>
                    <span class="sr-only">Instagram</span>
                </a>
            </div>
        </div>
    </div>
</footer>