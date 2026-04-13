@extends('layout.user')

@section('title', 'Syarat & Ketentuan')

@section('content')

{{-- HERO --}}
<section class="py-16 px-6 border-b border-gray-200 dark:border-gray-800">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-3xl md:text-4xl font-semibold text-gray-900 dark:text-white tracking-tight mb-3">
            Syarat & Ketentuan
        </h1>
        <p class="text-gray-500 dark:text-gray-400 text-sm">
            Terakhir diperbarui: <span class="text-gray-600 dark:text-gray-300">{{ date('d F Y') }}</span>
        </p>
    </div>
</section>

{{-- CONTENT --}}
<section class="py-12 px-6 pb-24">
    <div class="max-w-4xl mx-auto">

        {{-- Layout: sidebar TOC + konten --}}
        <div class="flex flex-col lg:flex-row gap-12">

            {{-- Sidebar Table of Contents --}}
            <aside class="lg:w-64 shrink-0">
                <div class="sticky top-24">
                    <p class="text-xs font-semibold tracking-wider uppercase text-gray-400 dark:text-gray-500 mb-4">
                        Daftar Isi
                    </p>
                    <nav class="space-y-2 text-sm">
                        <a href="#penggunaan" class="block text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 transition-colors">
                            1. Penggunaan Layanan
                        </a>
                        <a href="#hak-kewajiban" class="block text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 transition-colors">
                            2. Hak & Kewajiban
                        </a>
                        <a href="#pembayaran" class="block text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 transition-colors">
                            3. Pembayaran & Refund
                        </a>
                        <a href="#larangan" class="block text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 transition-colors">
                            4. Larangan Penggunaan
                        </a>
                        <a href="#perubahan" class="block text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 transition-colors">
                            5. Perubahan Ketentuan
                        </a>
                        <a href="#hukum" class="block text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 transition-colors">
                            6. Hukum yang Berlaku
                        </a>
                    </nav>
                </div>
            </aside>

            {{-- Main Content --}}
            <div class="flex-1 space-y-10">

                {{-- Intro --}}
                <div class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                    <p>
                        Dengan mengakses dan menggunakan layanan kami, Anda dianggap telah membaca,
                        memahami, dan menyetujui seluruh syarat dan ketentuan yang berlaku di bawah ini.
                        Harap baca dengan seksama sebelum menggunakan layanan kami.
                    </p>
                </div>

                {{-- Section 1 --}}
                <section id="penggunaan" class="scroll-mt-24">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                        1. Penggunaan Layanan
                    </h2>
                    <div class="space-y-3 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                        <p>Layanan kami tersedia untuk pengguna yang telah berusia minimal 17 tahun atau telah mendapat persetujuan dari orang tua/wali. Dengan mendaftar, Anda menyatakan memenuhi persyaratan tersebut.</p>
                        <p>Anda bertanggung jawab penuh atas keamanan akun, termasuk menjaga kerahasiaan kata sandi. Segala aktivitas yang terjadi melalui akun Anda menjadi tanggung jawab Anda sepenuhnya.</p>
                        <p>Kami berhak menangguhkan atau menghapus akun yang melanggar ketentuan ini tanpa pemberitahuan sebelumnya.</p>
                    </div>
                </section>

                {{-- Section 2 --}}
                <section id="hak-kewajiban" class="scroll-mt-24">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                        2. Hak & Kewajiban Pengguna
                    </h2>
                    <div class="space-y-4 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                        <div>
                            <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-2">Hak pengguna:</h3>
                            <ul class="list-disc pl-5 space-y-1">
                                <li>Mendapatkan akses penuh ke seluruh fitur sesuai paket yang dipilih.</li>
                                <li>Mendapatkan dukungan layanan pelanggan yang responsif.</li>
                                <li>Mengajukan pertanyaan, laporan, atau keluhan melalui saluran resmi kami.</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-2">Kewajiban pengguna:</h3>
                            <ul class="list-disc pl-5 space-y-1">
                                <li>Memberikan informasi yang akurat dan terkini saat pendaftaran.</li>
                                <li>Menggunakan layanan sesuai dengan ketentuan yang berlaku.</li>
                                <li>Tidak menyalahgunakan layanan untuk kepentingan yang melanggar hukum.</li>
                            </ul>
                        </div>
                    </div>
                </section>

                {{-- Section 3 --}}
                <section id="pembayaran" class="scroll-mt-24">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                        3. Pembayaran & Refund
                    </h2>
                    <div class="space-y-3 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                        <p>Seluruh transaksi dilakukan dalam mata uang Rupiah (IDR). Harga yang tertera sudah termasuk pajak yang berlaku kecuali dinyatakan lain.</p>
                        <p>Pembayaran dapat dilakukan melalui metode yang tersedia di platform kami. Pesanan dianggap sah setelah pembayaran berhasil dikonfirmasi oleh sistem.</p>
                        <p><strong class="font-semibold text-gray-800 dark:text-gray-200">Kebijakan Refund:</strong> Pengembalian dana dapat diajukan dalam waktu maksimal <strong>7 hari kerja</strong> sejak transaksi, dengan syarat produk belum digunakan/diunduh dan memenuhi ketentuan yang berlaku. Refund akan diproses dalam 3–5 hari kerja setelah pengajuan disetujui.</p>
                    </div>
                </section>

                {{-- Section 4 --}}
                <section id="larangan" class="scroll-mt-24">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                        4. Larangan Penggunaan
                    </h2>
                    <div class="space-y-3 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                        <p>Pengguna dilarang keras melakukan hal-hal berikut:</p>
                        <ul class="list-disc pl-5 space-y-1">
                            <li>Menyebarkan konten yang bersifat SARA, pornografi, atau melanggar hukum.</li>
                            <li>Melakukan upaya peretasan, manipulasi, atau gangguan terhadap sistem kami.</li>
                            <li>Menggunakan akun orang lain tanpa izin.</li>
                            <li>Melakukan penipuan atau transaksi palsu.</li>
                            <li>Menjual kembali akses layanan tanpa persetujuan tertulis dari kami.</li>
                        </ul>
                        <p class="mt-3">Pelanggaran terhadap ketentuan ini dapat berakibat pada penangguhan permanen akun dan tindakan hukum yang berlaku.</p>
                    </div>
                </section>

                {{-- Section 5 --}}
                <section id="perubahan" class="scroll-mt-24">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                        5. Perubahan Ketentuan
                    </h2>
                    <div class="space-y-3 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                        <p>Kami berhak mengubah syarat dan ketentuan ini sewaktu-waktu tanpa pemberitahuan sebelumnya. Perubahan akan berlaku efektif sejak dipublikasikan di halaman ini.</p>
                        <p>Kami akan berupaya memberikan notifikasi melalui email atau pengumuman di platform untuk perubahan yang bersifat signifikan. Namun, tanggung jawab untuk memeriksa pembaruan secara berkala tetap berada pada pengguna.</p>
                        <p>Kelanjutan penggunaan layanan setelah perubahan dipublikasikan dianggap sebagai persetujuan Anda terhadap ketentuan yang telah diperbarui.</p>
                    </div>
                </section>

                {{-- Section 6 --}}
                <section id="hukum" class="scroll-mt-24">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                        6. Hukum yang Berlaku
                    </h2>
                    <div class="space-y-3 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                        <p>Syarat dan ketentuan ini merupakan keseluruhan perjanjian antara Anda dan kami terkait penggunaan layanan, dan menggantikan semua perjanjian sebelumnya.</p>
                        <p>Apabila salah satu ketentuan dinyatakan tidak berlaku oleh pengadilan yang berwenang, ketentuan lainnya tetap berlaku penuh.</p>
                        <p>Layanan ini diatur oleh hukum Republik Indonesia. Segala sengketa yang timbul akan diselesaikan melalui musyawarah mufakat, dan apabila tidak tercapai kesepakatan, akan diselesaikan melalui Pengadilan Negeri yang berwenang di Indonesia.</p>
                        <p class="mt-4 pt-3 border-t border-gray-200 dark:border-gray-700 text-gray-500 italic">
                            Dengan terus menggunakan layanan kami, Anda menyatakan telah membaca, memahami, dan menyetujui seluruh ketentuan di atas.
                        </p>
                    </div>
                </section>

            </div>
        </div>

    </div>
</section>

@endsection