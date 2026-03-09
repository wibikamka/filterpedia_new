@extends('layout.user')

@section('title', 'Syarat & Ketentuan')

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
            Syarat & Ketentuan
        </h1>
        <p class="text-gray-500 dark:text-gray-400 text-sm">
            Terakhir diperbarui: <span class="font-medium text-gray-700 dark:text-gray-300">{{ date('d F Y') }}</span>
        </p>
    </div>
</section>

{{-- CONTENT --}}
<section class="py-12 px-6 pb-24">
    <div class="max-w-4xl mx-auto">

        {{-- Layout: sidebar TOC + konten --}}
        <div class="flex flex-col lg:flex-row gap-10">

            {{-- Sidebar Table of Contents --}}
            <aside class="lg:w-64 shrink-0">
                <div class="sticky top-24 p-6 rounded-2xl bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-700">
                    <p class="text-xs font-semibold tracking-widest uppercase text-gray-400 dark:text-gray-500 mb-4">Daftar Isi</p>
                    <nav class="space-y-2 text-sm">
                        <a href="#penggunaan" class="flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-indigo-500 dark:hover:text-indigo-400 transition-colors">
                            <span class="w-5 h-5 flex items-center justify-center rounded-md bg-indigo-50 dark:bg-indigo-900/50 text-indigo-500 text-xs font-bold">1</span>
                            Penggunaan Layanan
                        </a>
                        <a href="#hak-kewajiban" class="flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-indigo-500 dark:hover:text-indigo-400 transition-colors">
                            <span class="w-5 h-5 flex items-center justify-center rounded-md bg-indigo-50 dark:bg-indigo-900/50 text-indigo-500 text-xs font-bold">2</span>
                            Hak & Kewajiban
                        </a>
                        <a href="#pembayaran" class="flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-indigo-500 dark:hover:text-indigo-400 transition-colors">
                            <span class="w-5 h-5 flex items-center justify-center rounded-md bg-indigo-50 dark:bg-indigo-900/50 text-indigo-500 text-xs font-bold">3</span>
                            Pembayaran & Refund
                        </a>
                        <a href="#larangan" class="flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-indigo-500 dark:hover:text-indigo-400 transition-colors">
                            <span class="w-5 h-5 flex items-center justify-center rounded-md bg-indigo-50 dark:bg-indigo-900/50 text-indigo-500 text-xs font-bold">4</span>
                            Larangan Penggunaan
                        </a>
                        <a href="#perubahan" class="flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-indigo-500 dark:hover:text-indigo-400 transition-colors">
                            <span class="w-5 h-5 flex items-center justify-center rounded-md bg-indigo-50 dark:bg-indigo-900/50 text-indigo-500 text-xs font-bold">5</span>
                            Perubahan Ketentuan
                        </a>
                        <a href="#terms" class="flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-indigo-500 dark:hover:text-indigo-400 transition-colors">
                            <span class="w-5 h-5 flex items-center justify-center rounded-md bg-indigo-50 dark:bg-indigo-900/50 text-indigo-500 text-xs font-bold">6</span>
                            Terms & Conditions
                        </a>
                    </nav>
                </div>
            </aside>

            {{-- Main Content --}}
            <div class="flex-1 space-y-12">

                {{-- Intro --}}
                <div class="relative pl-5 border-l-2 border-indigo-400 dark:border-indigo-600">
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                        Dengan mengakses dan menggunakan layanan kami, Anda dianggap telah membaca,
                        memahami, dan menyetujui seluruh syarat dan ketentuan yang berlaku di bawah ini.
                        Harap baca dengan seksama sebelum menggunakan layanan kami.
                    </p>
                </div>

                {{-- Section 1 --}}
                <div id="penggunaan" class="scroll-mt-24">
                    <x-tos-section number="1" title="Penggunaan Layanan" color="indigo">
                        <p>Layanan kami tersedia untuk pengguna yang telah berusia minimal 17 tahun atau telah mendapat persetujuan dari orang tua/wali. Dengan mendaftar, Anda menyatakan memenuhi persyaratan tersebut.</p>
                        <p>Anda bertanggung jawab penuh atas keamanan akun, termasuk menjaga kerahasiaan kata sandi. Segala aktivitas yang terjadi melalui akun Anda menjadi tanggung jawab Anda sepenuhnya.</p>
                        <p>Kami berhak menangguhkan atau menghapus akun yang melanggar ketentuan ini tanpa pemberitahuan sebelumnya.</p>
                    </x-tos-section>
                </div>

                {{-- Section 2 --}}
                <div id="hak-kewajiban" class="scroll-mt-24">
                    <x-tos-section number="2" title="Hak & Kewajiban Pengguna" color="purple">
                        <p><strong class="text-gray-800 dark:text-gray-200">Hak pengguna:</strong></p>
                        <ul class="mt-2 space-y-1.5 pl-1">
                            <li class="flex items-start gap-2"><span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-purple-400 shrink-0"></span> Mendapatkan akses penuh ke seluruh fitur sesuai paket yang dipilih.</li>
                            <li class="flex items-start gap-2"><span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-purple-400 shrink-0"></span> Mendapatkan dukungan layanan pelanggan yang responsif.</li>
                            <li class="flex items-start gap-2"><span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-purple-400 shrink-0"></span> Mengajukan pertanyaan, laporan, atau keluhan melalui saluran resmi kami.</li>
                        </ul>
                        <p class="mt-4"><strong class="text-gray-800 dark:text-gray-200">Kewajiban pengguna:</strong></p>
                        <ul class="mt-2 space-y-1.5 pl-1">
                            <li class="flex items-start gap-2"><span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-purple-400 shrink-0"></span> Memberikan informasi yang akurat dan terkini saat pendaftaran.</li>
                            <li class="flex items-start gap-2"><span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-purple-400 shrink-0"></span> Menggunakan layanan sesuai dengan ketentuan yang berlaku.</li>
                            <li class="flex items-start gap-2"><span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-purple-400 shrink-0"></span> Tidak menyalahgunakan layanan untuk kepentingan yang melanggar hukum.</li>
                        </ul>
                    </x-tos-section>
                </div>

                {{-- Section 3 --}}
                <div id="pembayaran" class="scroll-mt-24">
                    <x-tos-section number="3" title="Pembayaran & Refund" color="emerald">
                        <p>Seluruh transaksi dilakukan dalam mata uang Rupiah (IDR). Harga yang tertera sudah termasuk pajak yang berlaku kecuali dinyatakan lain.</p>
                        <p>Pembayaran dapat dilakukan melalui metode yang tersedia di platform kami. Pesanan dianggap sah setelah pembayaran berhasil dikonfirmasi oleh sistem.</p>
                        <p><strong class="text-gray-800 dark:text-gray-200">Kebijakan Refund:</strong> Pengembalian dana dapat diajukan dalam waktu maksimal <strong class="text-gray-800 dark:text-gray-200">7 hari kerja</strong> sejak transaksi, dengan syarat produk belum digunakan/diunduh dan memenuhi ketentuan yang berlaku. Refund akan diproses dalam 3–5 hari kerja setelah pengajuan disetujui.</p>
                    </x-tos-section>
                </div>

                {{-- Section 4 --}}
                <div id="larangan" class="scroll-mt-24">
                    <x-tos-section number="4" title="Larangan Penggunaan" color="rose">
                        <p>Pengguna dilarang keras melakukan hal-hal berikut:</p>
                        <ul class="mt-3 space-y-1.5 pl-1">
                            <li class="flex items-start gap-2"><span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-rose-400 shrink-0"></span> Menyebarkan konten yang bersifat SARA, pornografi, atau melanggar hukum.</li>
                            <li class="flex items-start gap-2"><span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-rose-400 shrink-0"></span> Melakukan upaya peretasan, manipulasi, atau gangguan terhadap sistem kami.</li>
                            <li class="flex items-start gap-2"><span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-rose-400 shrink-0"></span> Menggunakan akun orang lain tanpa izin.</li>
                            <li class="flex items-start gap-2"><span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-rose-400 shrink-0"></span> Melakukan penipuan atau transaksi palsu.</li>
                            <li class="flex items-start gap-2"><span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-rose-400 shrink-0"></span> Menjual kembali akses layanan tanpa persetujuan tertulis dari kami.</li>
                        </ul>
                        <p class="mt-4">Pelanggaran terhadap ketentuan ini dapat berakibat pada penangguhan permanen akun dan tindakan hukum yang berlaku.</p>
                    </x-tos-section>
                </div>

                {{-- Section 5 --}}
                <div id="perubahan" class="scroll-mt-24">
                    <x-tos-section number="5" title="Perubahan Ketentuan" color="amber">
                        <p>Kami berhak mengubah syarat dan ketentuan ini sewaktu-waktu tanpa pemberitahuan sebelumnya. Perubahan akan berlaku efektif sejak dipublikasikan di halaman ini.</p>
                        <p>Kami akan berupaya memberikan notifikasi melalui email atau pengumuman di platform untuk perubahan yang bersifat signifikan. Namun, tanggung jawab untuk memeriksa pembaruan secara berkala tetap berada pada pengguna.</p>
                        <p>Kelanjutan penggunaan layanan setelah perubahan dipublikasikan dianggap sebagai persetujuan Anda terhadap ketentuan yang telah diperbarui.</p>
                    </x-tos-section>
                </div>

                {{-- Section 6 --}}
                <div id="terms" class="scroll-mt-24">
                    <x-tos-section number="6" title="Terms & Conditions" color="indigo">
                        <p>Syarat dan ketentuan ini merupakan keseluruhan perjanjian antara Anda dan kami terkait penggunaan layanan, dan menggantikan semua perjanjian sebelumnya.</p>
                        <p>Apabila salah satu ketentuan dinyatakan tidak berlaku oleh pengadilan yang berwenang, ketentuan lainnya tetap berlaku penuh.</p>
                        <p>Layanan ini diatur oleh hukum Republik Indonesia. Segala sengketa yang timbul akan diselesaikan melalui musyawarah mufakat, dan apabila tidak tercapai kesepakatan, akan diselesaikan melalui Pengadilan Negeri yang berwenang di Indonesia.</p>
                        <p>Dengan terus menggunakan layanan kami, Anda menyatakan telah membaca, memahami, dan menyetujui seluruh ketentuan di atas.</p>
                    </x-tos-section>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection