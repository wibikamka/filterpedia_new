@extends('layout.user')

@section('title', 'Kebijakan Privasi')

@section('content')

{{-- HERO --}}
<section class="py-16 px-6 border-b border-gray-200 dark:border-gray-800">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-3xl md:text-4xl font-semibold text-gray-900 dark:text-white tracking-tight mb-3">
            Kebijakan Privasi
        </h1>
        <p class="text-gray-500 dark:text-gray-400 text-sm">
            Terakhir diperbarui: <span class="text-gray-600 dark:text-gray-300">{{ date('d F Y') }}</span>
        </p>
    </div>
</section>

{{-- CONTENT --}}
<section class="py-12 px-6 pb-24">
    <div class="max-w-4xl mx-auto">
        <div class="flex flex-col lg:flex-row gap-12">

            {{-- Sidebar TOC --}}
            <aside class="lg:w-64 shrink-0">
                <div class="sticky top-24">
                    <p class="text-xs font-semibold tracking-wider uppercase text-gray-400 dark:text-gray-500 mb-4">
                        Daftar Isi
                    </p>
                    <nav class="space-y-2 text-sm">
                        <a href="#data-dikumpulkan" class="block text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 transition-colors">
                            1. Data yang Dikumpulkan
                        </a>
                        <a href="#penggunaan-data" class="block text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 transition-colors">
                            2. Cara Penggunaan Data
                        </a>
                        <a href="#cookies" class="block text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 transition-colors">
                            3. Cookies & Tracking
                        </a>
                        <a href="#pihak-ketiga" class="block text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 transition-colors">
                            4. Berbagi Data ke Pihak Ketiga
                        </a>
                        <a href="#hak-pengguna" class="block text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 transition-colors">
                            5. Hak Pengguna atas Data
                        </a>
                        <a href="#keamanan" class="block text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 transition-colors">
                            6. Keamanan Data
                        </a>
                    </nav>
                </div>
            </aside>

            {{-- Main Content --}}
            <div class="flex-1 space-y-10">

                {{-- Intro --}}
                <div class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                    <p>
                        Kami menghormati privasi Anda dan berkomitmen untuk melindungi data pribadi yang Anda berikan.
                        Kebijakan ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi Anda
                        saat menggunakan layanan kami.
                    </p>
                </div>

                {{-- Section 1: Data yang Dikumpulkan --}}
                <section id="data-dikumpulkan" class="scroll-mt-24">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                        1. Data yang Dikumpulkan
                    </h2>
                    <div class="space-y-3 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                        <p>Kami mengumpulkan beberapa jenis data saat Anda menggunakan layanan kami:</p>

                        <div class="mt-4 space-y-3">
                            <div>
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">Data Identitas</h3>
                                <p>Nama lengkap, username, alamat email, nomor telepon, dan foto profil yang Anda berikan saat mendaftar.</p>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">Data Transaksi</h3>
                                <p>Riwayat pembelian, metode pembayaran, dan detail pengiriman yang digunakan dalam transaksi.</p>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1">Data Teknis</h3>
                                <p>Alamat IP, jenis browser, sistem operasi, dan data penggunaan yang dikumpulkan secara otomatis.</p>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Section 2: Cara Penggunaan Data --}}
                <section id="penggunaan-data" class="scroll-mt-24">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                        2. Cara Penggunaan Data
                    </h2>
                    <div class="space-y-3 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                        <p>Data yang kami kumpulkan digunakan untuk keperluan berikut:</p>
                        <ul class="list-disc pl-5 space-y-1">
                            <li>Memproses pendaftaran dan mengelola akun Anda.</li>
                            <li>Memproses transaksi dan mengirimkan konfirmasi pesanan.</li>
                            <li>Mengirimkan notifikasi layanan, pembaruan, dan informasi penting.</li>
                            <li>Meningkatkan kualitas layanan berdasarkan pola penggunaan.</li>
                            <li>Mendeteksi dan mencegah aktivitas penipuan atau penyalahgunaan.</li>
                            <li>Memenuhi kewajiban hukum yang berlaku di Indonesia.</li>
                        </ul>
                    </div>
                </section>

                {{-- Section 3: Cookies --}}
                <section id="cookies" class="scroll-mt-24">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                        3. Cookies & Tracking
                    </h2>
                    <div class="space-y-3 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                        <p>Kami menggunakan cookies dan teknologi pelacakan serupa untuk meningkatkan pengalaman Anda:</p>

                        <div class="mt-4 space-y-3">
                            <div>
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-0.5">Cookies Esensial</h3>
                                <p>Diperlukan agar platform berfungsi dengan baik. Tidak dapat dinonaktifkan.</p>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-0.5">Cookies Analitik</h3>
                                <p>Membantu kami memahami cara pengguna berinteraksi dengan layanan kami.</p>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-0.5">Cookies Preferensi</h3>
                                <p>Menyimpan pengaturan seperti bahasa dan tema yang Anda pilih.</p>
                            </div>
                        </div>

                        <p class="mt-3">Anda dapat mengatur preferensi cookies melalui pengaturan browser. Namun menonaktifkan cookies tertentu dapat mempengaruhi fungsi layanan.</p>
                    </div>
                </section>

                {{-- Section 4: Pihak Ketiga --}}
                <section id="pihak-ketiga" class="scroll-mt-24">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                        4. Berbagi Data ke Pihak Ketiga
                    </h2>
                    <div class="space-y-3 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                        <p>Kami <strong class="font-semibold text-gray-800 dark:text-gray-200">tidak menjual</strong> data pribadi Anda kepada pihak ketiga. Data hanya dibagikan dalam kondisi berikut:</p>
                        <ul class="list-disc pl-5 space-y-1">
                            <li><strong class="text-gray-700 dark:text-gray-300">Mitra layanan</strong> — penyedia pembayaran, logistik, dan layanan cloud yang membantu operasional kami, terikat perjanjian kerahasiaan.</li>
                            <li><strong class="text-gray-700 dark:text-gray-300">Kewajiban hukum</strong> — apabila diwajibkan oleh peraturan perundang-undangan atau perintah pengadilan.</li>
                            <li><strong class="text-gray-700 dark:text-gray-300">Persetujuan Anda</strong> — dalam kondisi lain hanya dengan persetujuan eksplisit dari Anda.</li>
                        </ul>
                    </div>
                </section>

                {{-- Section 5: Hak Pengguna --}}
                <section id="hak-pengguna" class="scroll-mt-24">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                        5. Hak Pengguna atas Data
                    </h2>
                    <div class="space-y-3 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                        <p>Sesuai dengan regulasi perlindungan data yang berlaku, Anda memiliki hak-hak berikut:</p>
                        <div class="mt-4 grid sm:grid-cols-2 gap-3">
                            <div>
                                <p class="font-semibold text-gray-800 dark:text-gray-200 mb-0.5">Akses</p>
                                <p>Meminta salinan data pribadi yang kami simpan.</p>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 dark:text-gray-200 mb-0.5">Koreksi</p>
                                <p>Memperbarui data yang tidak akurat atau tidak lengkap.</p>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 dark:text-gray-200 mb-0.5">Penghapusan</p>
                                <p>Meminta penghapusan data dalam kondisi tertentu.</p>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 dark:text-gray-200 mb-0.5">Pembatasan</p>
                                <p>Membatasi cara kami memproses data Anda.</p>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 dark:text-gray-200 mb-0.5">Portabilitas</p>
                                <p>Menerima data dalam format yang dapat dibaca mesin.</p>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 dark:text-gray-200 mb-0.5">Keberatan</p>
                                <p>Menolak pemrosesan data untuk tujuan tertentu.</p>
                            </div>
                        </div>
                        <p class="mt-3">Untuk mengajukan permintaan terkait hak-hak di atas, hubungi kami melalui halaman Kontak.</p>
                    </div>
                </section>

                {{-- Section 6: Keamanan --}}
                <section id="keamanan" class="scroll-mt-24">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                        6. Keamanan Data
                    </h2>
                    <div class="space-y-3 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                        <p>Kami menerapkan langkah-langkah keamanan teknis dan organisasi yang sesuai untuk melindungi data Anda:</p>
                        <ul class="list-disc pl-5 space-y-1">
                            <li>Enkripsi data menggunakan protokol SSL/TLS pada seluruh transmisi data.</li>
                            <li>Penyimpanan kata sandi menggunakan algoritma hashing yang aman (bcrypt).</li>
                            <li>Akses data dibatasi hanya untuk personel yang berwenang dengan prinsip least privilege.</li>
                            <li>Pemantauan sistem secara berkelanjutan untuk mendeteksi akses tidak sah.</li>
                            <li>Pencadangan data secara rutin untuk mencegah kehilangan data.</li>
                        </ul>
                        <p class="mt-3">Meskipun kami berupaya sebaik mungkin, tidak ada sistem yang 100% aman. Apabila terjadi pelanggaran keamanan data yang berdampak pada Anda, kami akan memberitahu sesuai ketentuan hukum yang berlaku.</p>
                    </div>
                </section>

            </div>
        </div>
    </div>
</section>

@endsection