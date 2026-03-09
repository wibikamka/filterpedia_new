@extends('layout.user')

@section('title', 'Kebijakan Privasi')

@section('content')

{{-- HERO --}}
<section class="relative overflow-hidden py-20 px-6">
    <div class="absolute -top-20 -left-20 w-96 h-96 bg-indigo-300/20 dark:bg-indigo-600/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-20 -right-20 w-96 h-96 bg-purple-300/20 dark:bg-purple-600/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-3xl mx-auto text-center">
        <span class="inline-block text-xs font-semibold tracking-widest uppercase text-indigo-500 dark:text-indigo-400 mb-4">
            Legal
        </span>
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white leading-tight mb-4">
            Kebijakan Privasi
        </h1>
        <p class="text-gray-500 dark:text-gray-400 text-sm">
            Terakhir diperbarui: <span class="font-medium text-gray-700 dark:text-gray-300">{{ date('d F Y') }}</span>
        </p>
    </div>
</section>

{{-- CONTENT --}}
<section class="py-12 px-6 pb-24">
    <div class="max-w-4xl mx-auto">
        <div class="flex flex-col lg:flex-row gap-10">

            {{-- Sidebar TOC --}}
            <aside class="lg:w-64 shrink-0">
                <div class="sticky top-24 p-6 rounded-2xl bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-700">
                    <p class="text-xs font-semibold tracking-widest uppercase text-gray-400 dark:text-gray-500 mb-4">Daftar Isi</p>
                    <nav class="space-y-2 text-sm">
                        @foreach([
                            ['href' => '#data-dikumpulkan', 'num' => '1', 'label' => 'Data yang Dikumpulkan'],
                            ['href' => '#penggunaan-data', 'num' => '2', 'label' => 'Cara Penggunaan Data'],
                            ['href' => '#cookies',         'num' => '3', 'label' => 'Cookies & Tracking'],
                            ['href' => '#pihak-ketiga',    'num' => '4', 'label' => 'Berbagi Data'],
                            ['href' => '#hak-pengguna',    'num' => '5', 'label' => 'Hak Pengguna'],
                            ['href' => '#keamanan',        'num' => '6', 'label' => 'Keamanan Data'],
                        ] as $item)
                        <a href="{{ $item['href'] }}"
                           class="flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-indigo-500 dark:hover:text-indigo-400 transition-colors">
                            <span class="w-5 h-5 flex items-center justify-center rounded-md bg-indigo-50 dark:bg-indigo-900/50 text-indigo-500 text-xs font-bold shrink-0">
                                {{ $item['num'] }}
                            </span>
                            {{ $item['label'] }}
                        </a>
                        @endforeach
                    </nav>
                </div>
            </aside>

            {{-- Main Content --}}
            <div class="flex-1 space-y-8">

                {{-- Intro --}}
                <div class="relative pl-5 border-l-2 border-indigo-400 dark:border-indigo-600">
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                        Kami menghormati privasi Anda dan berkomitmen untuk melindungi data pribadi yang Anda berikan.
                        Kebijakan ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi Anda
                        saat menggunakan layanan kami.
                    </p>
                </div>

                {{-- Section 1: Data yang Dikumpulkan --}}
                <div id="data-dikumpulkan" class="scroll-mt-24">
                    <x-tos-section number="1" title="Data yang Dikumpulkan" color="indigo">
                        <p>Kami mengumpulkan beberapa jenis data saat Anda menggunakan layanan kami:</p>

                        <div class="mt-4 space-y-4">
                            <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-100 dark:border-gray-600">
                                <p class="font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-indigo-400"></span>
                                    Data Identitas
                                </p>
                                <p>Nama lengkap, username, alamat email, nomor telepon, dan foto profil yang Anda berikan saat mendaftar.</p>
                            </div>
                            <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-100 dark:border-gray-600">
                                <p class="font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-purple-400"></span>
                                    Data Transaksi
                                </p>
                                <p>Riwayat pembelian, metode pembayaran, dan detail pengiriman yang digunakan dalam transaksi.</p>
                            </div>
                            <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-100 dark:border-gray-600">
                                <p class="font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                    Data Teknis
                                </p>
                                <p>Alamat IP, jenis browser, sistem operasi, dan data penggunaan yang dikumpulkan secara otomatis.</p>
                            </div>
                        </div>
                    </x-tos-section>
                </div>

                {{-- Section 2: Cara Penggunaan Data --}}
                <div id="penggunaan-data" class="scroll-mt-24">
                    <x-tos-section number="2" title="Cara Penggunaan Data" color="purple">
                        <p>Data yang kami kumpulkan digunakan untuk keperluan berikut:</p>
                        <ul class="mt-3 space-y-2 pl-1">
                            <li class="flex items-start gap-2">
                                <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-purple-400 shrink-0"></span>
                                Memproses pendaftaran dan mengelola akun Anda.
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-purple-400 shrink-0"></span>
                                Memproses transaksi dan mengirimkan konfirmasi pesanan.
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-purple-400 shrink-0"></span>
                                Mengirimkan notifikasi layanan, pembaruan, dan informasi penting.
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-purple-400 shrink-0"></span>
                                Meningkatkan kualitas layanan berdasarkan pola penggunaan.
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-purple-400 shrink-0"></span>
                                Mendeteksi dan mencegah aktivitas penipuan atau penyalahgunaan.
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-purple-400 shrink-0"></span>
                                Memenuhi kewajiban hukum yang berlaku di Indonesia.
                            </li>
                        </ul>
                    </x-tos-section>
                </div>

                {{-- Section 3: Cookies --}}
                <div id="cookies" class="scroll-mt-24">
                    <x-tos-section number="3" title="Cookies & Tracking" color="amber">
                        <p>Kami menggunakan cookies dan teknologi pelacakan serupa untuk meningkatkan pengalaman Anda:</p>

                        <div class="mt-4 space-y-3">
                            <div class="flex items-start gap-3 p-3 rounded-lg bg-amber-50 dark:bg-amber-900/20 border border-amber-100 dark:border-amber-800/50">
                                <span class="mt-0.5 shrink-0 w-5 h-5 rounded-full bg-amber-400/30 flex items-center justify-center">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                </span>
                                <div>
                                    <p class="font-semibold text-gray-700 dark:text-gray-300 text-xs mb-0.5">Cookies Esensial</p>
                                    <p>Diperlukan agar platform berfungsi dengan baik. Tidak dapat dinonaktifkan.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 p-3 rounded-lg bg-amber-50 dark:bg-amber-900/20 border border-amber-100 dark:border-amber-800/50">
                                <span class="mt-0.5 shrink-0 w-5 h-5 rounded-full bg-amber-400/30 flex items-center justify-center">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                </span>
                                <div>
                                    <p class="font-semibold text-gray-700 dark:text-gray-300 text-xs mb-0.5">Cookies Analitik</p>
                                    <p>Membantu kami memahami cara pengguna berinteraksi dengan layanan kami.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 p-3 rounded-lg bg-amber-50 dark:bg-amber-900/20 border border-amber-100 dark:border-amber-800/50">
                                <span class="mt-0.5 shrink-0 w-5 h-5 rounded-full bg-amber-400/30 flex items-center justify-center">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                </span>
                                <div>
                                    <p class="font-semibold text-gray-700 dark:text-gray-300 text-xs mb-0.5">Cookies Preferensi</p>
                                    <p>Menyimpan pengaturan seperti bahasa dan tema yang Anda pilih.</p>
                                </div>
                            </div>
                        </div>

                        <p class="mt-4">Anda dapat mengatur preferensi cookies melalui pengaturan browser. Namun menonaktifkan cookies tertentu dapat mempengaruhi fungsi layanan.</p>
                    </x-tos-section>
                </div>

                {{-- Section 4: Pihak Ketiga --}}
                <div id="pihak-ketiga" class="scroll-mt-24">
                    <x-tos-section number="4" title="Berbagi Data ke Pihak Ketiga" color="rose">
                        <p>Kami <strong class="text-gray-800 dark:text-gray-200">tidak menjual</strong> data pribadi Anda kepada pihak ketiga. Data hanya dibagikan dalam kondisi berikut:</p>
                        <ul class="mt-3 space-y-2 pl-1">
                            <li class="flex items-start gap-2">
                                <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-rose-400 shrink-0"></span>
                                <span><strong class="text-gray-700 dark:text-gray-300">Mitra layanan</strong> — penyedia pembayaran, logistik, dan layanan cloud yang membantu operasional kami, terikat perjanjian kerahasiaan.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-rose-400 shrink-0"></span>
                                <span><strong class="text-gray-700 dark:text-gray-300">Kewajiban hukum</strong> — apabila diwajibkan oleh peraturan perundang-undangan atau perintah pengadilan.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-rose-400 shrink-0"></span>
                                <span><strong class="text-gray-700 dark:text-gray-300">Persetujuan Anda</strong> — dalam kondisi lain hanya dengan persetujuan eksplisit dari Anda.</span>
                            </li>
                        </ul>
                    </x-tos-section>
                </div>

                {{-- Section 5: Hak Pengguna --}}
                <div id="hak-pengguna" class="scroll-mt-24">
                    <x-tos-section number="5" title="Hak Pengguna atas Data" color="emerald">
                        <p>Sesuai dengan regulasi perlindungan data yang berlaku, Anda memiliki hak-hak berikut:</p>
                        <div class="mt-4 grid sm:grid-cols-2 gap-3">
                            @foreach([
                                ['icon' => '👁', 'title' => 'Akses', 'desc' => 'Meminta salinan data pribadi yang kami simpan.'],
                                ['icon' => '✏️', 'title' => 'Koreksi', 'desc' => 'Memperbarui data yang tidak akurat atau tidak lengkap.'],
                                ['icon' => '🗑', 'title' => 'Penghapusan', 'desc' => 'Meminta penghapusan data dalam kondisi tertentu.'],
                                ['icon' => '🚫', 'title' => 'Pembatasan', 'desc' => 'Membatasi cara kami memproses data Anda.'],
                                ['icon' => '📦', 'title' => 'Portabilitas', 'desc' => 'Menerima data dalam format yang dapat dibaca mesin.'],
                                ['icon' => '✋', 'title' => 'Keberatan', 'desc' => 'Menolak pemrosesan data untuk tujuan tertentu.'],
                            ] as $right)
                            <div class="flex items-start gap-3 p-3 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-100 dark:border-emerald-800/50">
                                <span class="text-lg leading-none mt-0.5">{{ $right['icon'] }}</span>
                                <div>
                                    <p class="font-semibold text-gray-700 dark:text-gray-300 text-xs mb-0.5">{{ $right['title'] }}</p>
                                    <p>{{ $right['desc'] }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <p class="mt-4">Untuk mengajukan permintaan terkait hak-hak di atas, hubungi kami melalui halaman <a href="#" class="text-indigo-500 hover:underline">Kontak</a>.</p>
                    </x-tos-section>
                </div>

                {{-- Section 6: Keamanan --}}
                <div id="keamanan" class="scroll-mt-24">
                    <x-tos-section number="6" title="Keamanan Data" color="indigo">
                        <p>Kami menerapkan langkah-langkah keamanan teknis dan organisasi yang sesuai untuk melindungi data Anda:</p>
                        <ul class="mt-3 space-y-2 pl-1">
                            <li class="flex items-start gap-2">
                                <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-indigo-400 shrink-0"></span>
                                Enkripsi data menggunakan protokol SSL/TLS pada seluruh transmisi data.
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-indigo-400 shrink-0"></span>
                                Penyimpanan kata sandi menggunakan algoritma hashing yang aman (bcrypt).
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-indigo-400 shrink-0"></span>
                                Akses data dibatasi hanya untuk personel yang berwenang dengan prinsip least privilege.
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-indigo-400 shrink-0"></span>
                                Pemantauan sistem secara berkelanjutan untuk mendeteksi akses tidak sah.
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-indigo-400 shrink-0"></span>
                                Pencadangan data secara rutin untuk mencegah kehilangan data.
                            </li>
                        </ul>
                        <p class="mt-4">Meskipun kami berupaya sebaik mungkin, tidak ada sistem yang 100% aman. Apabila terjadi pelanggaran keamanan data yang berdampak pada Anda, kami akan memberitahu sesuai ketentuan hukum yang berlaku.</p>
                    </x-tos-section>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
