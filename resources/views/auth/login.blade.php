<x-guest-layout>
<style>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap');

:root {
    --blue:      #0ea5e9;
    --blue-dk:   #0284c7;
    --navy:      #040f1e;
    --ease-expo: cubic-bezier(0.87, 0, 0.13, 1);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

html, body {
    width: 100%; height: 100%;
    overflow: hidden;
    font-family: 'DM Sans', sans-serif;
}

/* ══════════════════════════════════════
   LAYER 0 — BG FOTO (paling bawah, full screen)
══════════════════════════════════════ */
.bg-photo {
    position: fixed; inset: 0; z-index: 0;
    background: url("{{ asset('storage/img/banner/warehouse.webp') }}") center/cover no-repeat;
    transform: scale(1.04);
    transition: transform 0.9s var(--ease-expo);
}

/* Overlay gelap ringan agar konten tetap terbaca */
.bg-dim {
    position: fixed; inset: 0; z-index: 1;
    background: rgba(4, 15, 30, 0.45);
}

/* ══════════════════════════════════════
   LAYER 1 — PAGE (di atas bg)
══════════════════════════════════════ */
.page {
    position: fixed; inset: 0; z-index: 2;
    display: flex;
    overflow: hidden;
}

/* ══════════════════════════════════════
   INFO SIDE — kiri (logo + intro)
   Transparan total, foto tembus sepenuhnya
══════════════════════════════════════ */
.side-info {
    position: relative;
    width: 50%; height: 100%;
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 2rem 2.25rem 2.8rem;
    /* tidak ada background — foto di belakangnya terlihat penuh */
    order: 0;
    transition: opacity .3s;
}

/* ══════════════════════════════════════
   GLASS PANEL SIDE — kanan (bergeser)
══════════════════════════════════════ */
.side-glass {
    position: relative;
    width: 50%; height: 100%;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    overflow-y: auto;
    order: 1;

    /* ── Glassmorphism utama ── */
    background: rgba(255, 255, 255, 0.10);
    backdrop-filter: blur(28px) saturate(1.6) brightness(1.08);
    -webkit-backdrop-filter: blur(28px) saturate(1.6) brightness(1.08);
    border-left: 1px solid rgba(255, 255, 255, 0.20);
    box-shadow: inset 1px 0 0 rgba(255,255,255,0.08),
                -12px 0 40px rgba(0,0,0,0.18);
}

/* ── Swap: glass ke kiri, info ke kanan ── */
.page.swapped .side-info  { order: 1; }
.page.swapped .side-glass {
    order: 0;
    border-left: none;
    border-right: 1px solid rgba(255, 255, 255, 0.20);
    box-shadow: inset -1px 0 0 rgba(255,255,255,0.08),
                12px 0 40px rgba(0,0,0,0.18);
}

/* ── Slide animasi ── */
@keyframes slideFromRight {
    from { transform: translateX(80px); opacity: 0; }
    to   { transform: translateX(0);    opacity: 1; }
}
@keyframes slideFromLeft {
    from { transform: translateX(-80px); opacity: 0; }
    to   { transform: translateX(0);     opacity: 1; }
}
.slide-from-right { animation: slideFromRight .68s var(--ease-expo) both; }
.slide-from-left  { animation: slideFromLeft  .68s var(--ease-expo) both; }

/* ══════════════════════════════════════
   LOGO
══════════════════════════════════════ */
.logo {
    display: flex; align-items: center; gap: 0.65rem;
    animation: fadeDown .7s both;
}
.logo img { height: 2.6rem; filter: drop-shadow(0 2px 10px rgba(0,0,0,.6)); }
.logo-text {
    font-family: 'Sora', sans-serif;
    font-size: 1.45rem; font-weight: 800;
    color: #fff; letter-spacing: -.02em;
    text-shadow: 0 2px 14px rgba(0,0,0,.6);
}


/* ══════════════════════════════════════
   TAB BUTTONS (sejajar kanan di info side)
══════════════════════════════════════ */
.info-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.img-tabs {
    display: flex; gap: .5rem;
    animation: fadeDown .75s .1s both;
}
.itab {
    padding: .44rem 1.25rem;
    font-family: 'Sora', sans-serif;
    font-size: .78rem; font-weight: 600;
    border-radius: 100px;
    border: 1.5px solid rgba(255,255,255,.32);
    color: rgba(255,255,255,.78);
    background: rgba(255,255,255,.08);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    cursor: pointer;
    transition: background .2s, color .2s, border-color .2s, transform .15s;
    letter-spacing: .04em;
    user-select: none;
}
.itab:hover { background: rgba(255,255,255,.20); color: #fff; transform: translateY(-1px); }
.itab.active {
    background: var(--blue); border-color: var(--blue);
    color: #fff; box-shadow: 0 4px 14px rgba(14,165,233,.45);
}

/* ══════════════════════════════════════
   INTRO (bawah info side)
══════════════════════════════════════ */
.img-intro { animation: fadeUp .85s .25s both; }

.badge {
    display: inline-block;
    background: rgba(14,165,233,.18);
    border: 1px solid rgba(14,165,233,.45);
    color: #7dd3fc;
    font-family: 'Sora', sans-serif;
    font-size: .68rem; font-weight: 600;
    letter-spacing: .13em; text-transform: uppercase;
    padding: .28rem .9rem; border-radius: 100px; margin-bottom: .9rem;
    backdrop-filter: blur(6px);
}
.intro-h {
    font-family: 'Sora', sans-serif;
    font-size: clamp(1.4rem, 2.4vw, 1.85rem);
    font-weight: 700; color: #fff; line-height: 1.25;
    margin-bottom: .7rem; text-shadow: 0 2px 18px rgba(0,0,0,.55);
}
.intro-h em { font-style: normal; color: var(--blue); }
.intro-p {
    font-size: .83rem; font-weight: 300;
    color: rgba(255,255,255,.72); line-height: 1.68; max-width: 360px;
}
.stats { display: flex; gap: 2rem; margin-top: 1.4rem; }
.stat-n { font-family:'Sora',sans-serif; font-size:1.35rem; font-weight:800; color:var(--blue); }
.stat-l { font-size:.7rem; color:rgba(255,255,255,.48); margin-top:.15rem; text-transform:uppercase; letter-spacing:.07em; }

/* ══════════════════════════════════════
   FORM CARD (di dalam glass panel)
   Card ini lebih solid agar teks terbaca
══════════════════════════════════════ */
.fcard {
    width: 100%; max-width: 420px;
    background: rgba(255, 255, 255, 0.88);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    border-radius: 1.25rem;
    padding: 2.5rem 2.25rem;
    border: 1px solid rgba(255,255,255,0.6);
    box-shadow:
        0 4px 6px rgba(0,0,0,0.04),
        0 20px 50px rgba(0,0,0,0.12),
        0 1px 0 rgba(255,255,255,0.95) inset;
}
.fcard-accent {
    height: 3px;
    background: linear-gradient(90deg, var(--blue), #6366f1);
    border-radius: 100px; margin-bottom: 1.75rem;
}

/* ── Typography ── */
.eyebrow {
    font-size:.7rem; font-weight:600; letter-spacing:.13em;
    text-transform:uppercase; color:var(--blue);
    font-family:'Sora',sans-serif; margin-bottom:.35rem;
}
.ftitle {
    font-family:'Sora',sans-serif;
    font-size:1.5rem; font-weight:800;
    color:#0c1a2e; letter-spacing:-.02em; line-height:1.2;
}
.fsub { font-size:.81rem; color:#64748b; margin-top:.35rem; margin-bottom:1.55rem; }

/* ── Fields ── */
.fg { margin-bottom:1rem; }
.flabel {
    display:block; font-size:.77rem; font-weight:600;
    color:#334155; margin-bottom:.38rem; font-family:'Sora',sans-serif;
}
.finput {
    width:100%; padding:.65rem 1rem;
    border:1.5px solid #e2e8f0; border-radius:.65rem;
    font-size:.875rem; font-family:'DM Sans',sans-serif;
    color:#0f172a; background:#f8fafc;
    transition: border-color .2s, box-shadow .2s, background .2s;
    outline:none;
}
.finput:focus { border-color:var(--blue); background:#fff; box-shadow:0 0 0 3.5px rgba(14,165,233,.12); }
.finput::placeholder { color:#94a3b8; }
.ferr { font-size:.74rem; color:#ef4444; margin-top:.3rem; }

.chk { display:flex; align-items:center; gap:.5rem; margin:.85rem 0 1.35rem; }
.chk input[type=checkbox] { width:1rem; height:1rem; accent-color:var(--blue); cursor:pointer; }
.chk label { font-size:.81rem; color:#475569; cursor:pointer; user-select:none; }

.btn {
    width:100%; padding:.76rem 1rem;
    background: linear-gradient(135deg, var(--blue) 0%, var(--blue-dk) 100%);
    color:#fff; font-family:'Sora',sans-serif;
    font-size:.88rem; font-weight:700;
    border:none; border-radius:.65rem; cursor:pointer;
    letter-spacing:.02em;
    transition: transform .15s, box-shadow .15s;
    box-shadow: 0 4px 14px rgba(14,165,233,.32);
}
.btn:hover { transform:translateY(-1px); box-shadow:0 6px 22px rgba(14,165,233,.44); }
.btn:active { transform:translateY(0); }

.ffoot { display:flex; justify-content:center; margin-top:1.15rem; }
.ffoot a { font-size:.79rem; color:#64748b; text-decoration:none; transition:color .15s; }
.ffoot a:hover { color:var(--blue); }

.tab-content { display:none; }
.tab-content.active { display:block; }

.session-ok {
    font-size:.81rem; color:#16a34a;
    background:#f0fdf4; border:1px solid #bbf7d0;
    padding:.5rem .85rem; border-radius:.5rem; margin-bottom:1rem;
}

/* ══════════════════════════════════════
   MOBILE
══════════════════════════════════════ */
@media (max-width: 768px) {
    html, body { overflow: auto !important; height: auto !important; }

    .bg-photo, .bg-dim {
        position: fixed !important;
        /* tetap fixed agar foto jadi bg permanen di mobile juga */
    }

    .page {
        position: relative !important;
        flex-direction: column !important;
        min-height: 100vh;
        overflow: visible !important;
        background: transparent;
    }

    .side-info {
        width: 100% !important;
        order: 0 !important;
        min-height: 52vw;
        max-height: 300px;
        padding: 1.2rem 1.2rem 1.5rem;
        justify-content: space-between;
    }

    /* Sembunyikan intro di mobile, terlalu crowded */
    .img-intro { display: none; }

    .side-glass {
        width: 100% !important;
        order: 1 !important;
        min-height: auto;
        height: auto;
        padding: 1.5rem 1rem 3rem;
        border-left: none !important;
        border-right: none !important;
        border-top: 1px solid rgba(255,255,255,0.2);
        box-shadow: 0 -8px 32px rgba(0,0,0,0.2) !important;
        overflow-y: visible;
    }

    .fcard { max-width: 100%; padding: 1.75rem 1.35rem; border-radius: 1rem; }

    .logo img  { height: 1.9rem; }
    .logo-text { font-size: 1.1rem; }
    .itab { padding: .36rem .9rem; font-size: .72rem; }

    /* Mobile swap: cukup ganti konten card, tidak perlu slide */
    .slide-from-right, .slide-from-left { animation: none !important; }

    /* Swapped di mobile: balik urutan kolom */
    .page.swapped .side-info  { order: 0 !important; }
    .page.swapped .side-glass { order: 1 !important; }
}

/* ══ Keyframes ══ */
@keyframes fadeDown {
    from { opacity:0; transform:translateY(-16px); }
    to   { opacity:1; transform:translateY(0); }
}
@keyframes fadeUp {
    from { opacity:0; transform:translateY(20px); }
    to   { opacity:1; transform:translateY(0); }
}
</style>
@php
$tab = request('tab', 'login');
@endphp
{{-- BG FOTO — paling bawah, full screen --}}
<div class="bg-photo" id="bgPhoto"></div>
<div class="bg-dim"></div>

<div class="page" id="mainPage">

    {{-- ══ INFO SIDE (kiri) — transparan, foto tembus ══ --}}
    <div class="side-info" id="sideInfo">

        {{-- Baris atas: Logo kiri, Tab kanan --}}
        <div class="info-top">
            <div class="logo">
                <img src="{{ asset('storage/img/logo/filterpedialastfilterpedia.png') }}" alt="Filterpedia">
                <span class="logo-text">filterpedia</span>
            </div>
            <div class="img-tabs">
                <button class="itab active" id="tabMasuk"  onclick="switchTab('masuk')">Masuk</button>
                <button class="itab"        id="tabDaftar" onclick="switchTab('daftar')">Daftar</button>
            </div>
        </div>

        {{-- Bawah: Intro --}}
        <div class="img-intro">
            <div class="badge">Distributor &amp; Supplier</div>
            <h2 class="intro-h">
                Solusi Terpercaya untuk<br>
                <em>Water Treatment</em> Anda
            </h2>
            <p class="intro-p">
                Distributor dan supplier spesialis produk water treatment—
                filter air, media filtrasi, dan komponen pengolahan air
                berkualitas tinggi untuk industri &amp; komersial.
            </p>
            <div class="stats">
                <div><div class="stat-n">100+</div><div class="stat-l">Produk</div></div>
                <div><div class="stat-n">10+</div><div class="stat-l">Tahun</div></div>
                <div><div class="stat-n">1K+</div><div class="stat-l">Klien</div></div>
            </div>
        </div>
    </div>

    {{-- ══ GLASS SIDE (kanan) — glassmorphism di atas foto ══ --}}
    <div class="side-glass" id="sideGlass">
        <div class="fcard" id="formCard">
            <div class="fcard-accent"></div>

            {{-- LOGIN --}}
            <div class="tab-content active" id="cMasuk">
                @if(session('status'))
                    <div class="session-ok">{{ session('status') }}</div>
                @endif
                <div class="eyebrow">Portal Pengguna</div>
                <div class="ftitle">Selamat Datang Kembali</div>
                <div class="fsub">Masuk untuk mengakses sistem Filterpedia</div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="fg">
                        <label class="flabel" for="email">Alamat Email</label>
                        <input id="email" class="finput" type="email" name="email"
                            value="{{ old('email') }}" placeholder="nama@email.com"
                            required autofocus autocomplete="username" />
                        @error('email') <div class="ferr">{{ $message }}</div> @enderror
                    </div>
<div class="fg relative">
    <label class="flabel" for="password">Kata Sandi</label>

    <input id="login_pass"
        class="finput pr-10"
        type="password"
        name="password"
        placeholder="••••••••"
        required autocomplete="current-password" />

    <button type="button"
        onclick="togglePassword('login_pass', 'eye-open-3', 'eye-close-3')"
        class="absolute right-3 top-9 text-gray-500">

        <!-- eye open -->
        <svg id="eye-open-3" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.458 12C3.732 7.943 7.523 5 12 5
                c4.477 0 8.268 2.943 9.542 7
                -1.274 4.057-5.065 7-9.542 7
                -4.477 0-8.268-2.943-9.542-7z" />
        </svg>

        <!-- eye closed -->
        <svg id="eye-close-3" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13.875 18.825A10.05 10.05 0 0112 19
                c-4.478 0-8.268-2.943-9.542-7
                a9.956 9.956 0 012.042-3.362M6.223 6.223
                A9.953 9.953 0 0112 5c4.478 0 8.268 2.943
                9.542 7a9.97 9.97 0 01-4.132 5.411M15
                12a3 3 0 11-6 0 3 3 0 016 0zm6
                6L3 3" />
        </svg>

    </button>


    @error('password')
        <div class="ferr">{{ $message }}</div>
    @enderror
</div>
                    <div class="chk">
                        <input id="remember_me" type="checkbox" name="remember">
                        <label for="remember_me">Ingat saya di perangkat ini</label>
                    </div>
                    <button type="submit" class="btn">Masuk Sekarang</button>
                    @if(Route::has('password.request'))
                        <div class="ffoot">
                            <a href="{{ route('password.request') }}">Lupa kata sandi?</a>
                        </div>
                    @endif
                </form>
            </div>

            {{-- REGISTER --}}
            <div class="tab-content" id="cDaftar">
                <div class="eyebrow">Buat Akun Baru</div>
                <div class="ftitle">Daftar Sekarang</div>
                <div class="fsub">Bergabung dengan ekosistem Filterpedia</div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="fg">
                        <label class="flabel" for="reg_name">Nama Lengkap</label>
                        <input id="reg_name" class="finput" type="text" name="name"
                            value="{{ old('name') }}" placeholder="Nama lengkap Anda"
                            required autocomplete="name" />
                        @error('name') <div class="ferr">{{ $message }}</div> @enderror
                    </div>
                    <div class="fg">
                        <label class="flabel" for="reg_email">Alamat Email</label>
                        <input id="reg_email" class="finput" type="email" name="email"
                            value="{{ old('email') }}" placeholder="nama@email.com"
                            required autocomplete="username" />
                        @error('email') <div class="ferr">{{ $message }}</div> @enderror
                    </div>
 <div class="fg relative">
    <label class="flabel" for="reg_pass">Kata Sandi</label>

    <input id="reg_pass"
        class="finput pr-10"
        type="password"
        name="password"
        placeholder="Min. 8 karakter"
        required autocomplete="new-password" />

    <button type="button"
        onclick="togglePassword('reg_pass', 'eye-open-1', 'eye-close-1')"
        class="absolute right-3 top-9 text-gray-500">

        <!-- eye open -->
        <svg id="eye-open-1" xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.458 12C3.732 7.943 7.523 5 12 5
                c4.477 0 8.268 2.943 9.542 7
                -1.274 4.057-5.065 7-9.542 7
                -4.477 0-8.268-2.943-9.542-7z" />
        </svg>

        <!-- eye closed -->
        <svg id="eye-close-1" xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13.875 18.825A10.05 10.05 0 0112 19
                c-4.478 0-8.268-2.943-9.542-7
                a9.956 9.956 0 012.042-3.362M6.223 6.223
                A9.953 9.953 0 0112 5c4.478 0 8.268 2.943
                9.542 7a9.97 9.97 0 01-4.132 5.411M15
                12a3 3 0 11-6 0 3 3 0 016 0zm6
                6L3 3" />
        </svg>
    </button>

    @error('password')
        <div class="ferr">{{ $message }}</div>
    @enderror
</div>
 <div class="fg relative" style="margin-bottom:1.35rem;">
    <label class="flabel" for="reg_pass_confirm">Konfirmasi Kata Sandi</label>

    <input id="reg_pass_confirm"
        class="finput pr-10"
        type="password"
        name="password_confirmation"
        placeholder="Ulangi kata sandi"
        required autocomplete="new-password" />

    <button type="button"
        onclick="togglePassword('reg_pass_confirm', 'eye-open-2', 'eye-close-2')"
        class="absolute right-3 top-9 text-gray-500">

        <!-- eye open -->
        <svg id="eye-open-2" xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.458 12C3.732 7.943 7.523 5 12 5
                c4.477 0 8.268 2.943 9.542 7
                -1.274 4.057-5.065 7-9.542 7
                -4.477 0-8.268-2.943-9.542-7z" />
        </svg>

        <!-- eye closed -->
        <svg id="eye-close-2" xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13.875 18.825A10.05 10.05 0 0112 19
                c-4.478 0-8.268-2.943-9.542-7
                a9.956 9.956 0 012.042-3.362M6.223 6.223
                A9.953 9.953 0 0112 5c4.478 0 8.268 2.943
                9.542 7a9.97 9.97 0 01-4.132 5.411M15
                12a3 3 0 11-6 0 3 3 0 016 0zm6
                6L3 3" />
        </svg>
    </button>
</div>
                    <button type="submit" class="btn">Buat Akun</button>
                    <div class="ffoot" style="margin-top:1rem;">
                        <a href="#" onclick="switchTab('masuk');return false;">Sudah punya akun? Masuk di sini</a>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>

<script>

function togglePassword(inputId, openId, closeId) {
    const input = document.getElementById(inputId);
    const openIcon = document.getElementById(openId);
    const closeIcon = document.getElementById(closeId);

    if (input.type === 'password') {
        input.type = 'text';
        openIcon.classList.add('hidden');
        closeIcon.classList.remove('hidden');
    } else {
        input.type = 'password';
        openIcon.classList.remove('hidden');
        closeIcon.classList.add('hidden');
    }
}

    document.addEventListener("DOMContentLoaded", function () {
    const tab = "{{ $tab }}";

    if (tab === "register") {
        document.getElementById("tabDaftar").click();
    }
});
(function () {
    const page      = document.getElementById('mainPage');
    const sideInfo  = document.getElementById('sideInfo');
    const sideGlass = document.getElementById('sideGlass');
    const formCard  = document.getElementById('formCard');
    const bgPhoto   = document.getElementById('bgPhoto');

    let current   = 'masuk';
    let animating = false;
    const mobile  = () => window.innerWidth <= 768;

    function switchTab(tab) {
        if (tab === current || animating) return;
        animating = true;

        const goingDaftar = tab === 'daftar';
        current = tab;

        document.getElementById('tabMasuk') .classList.toggle('active', !goingDaftar);
        document.getElementById('tabDaftar').classList.toggle('active',  goingDaftar);

        if (mobile()) {
            document.getElementById('cMasuk') .classList.toggle('active', !goingDaftar);
            document.getElementById('cDaftar').classList.toggle('active',  goingDaftar);
            animating = false;
            return;
        }

        // 1. Fade card out + slight translate
        formCard.style.transition = 'opacity .2s, transform .22s';
        formCard.style.opacity    = '0';
        formCard.style.transform  = goingDaftar ? 'translateX(24px)' : 'translateX(-24px)';

        setTimeout(() => {
            // 2. Swap form content
            document.getElementById('cMasuk') .classList.toggle('active', !goingDaftar);
            document.getElementById('cDaftar').classList.toggle('active',  goingDaftar);

            // 3. Flip panel order (glass ke kiri, info ke kanan)
            page.classList.toggle('swapped', goingDaftar);

            // 4. Slide-in animation on both sides
            [sideInfo, sideGlass].forEach(el => {
                el.classList.remove('slide-from-left','slide-from-right');
                void el.offsetWidth; // force reflow
            });

            if (goingDaftar) {
                // glass pindah ke kiri → datang dari kiri
                // info pindah ke kanan → datang dari kanan
                sideGlass.classList.add('slide-from-left');
                sideInfo .classList.add('slide-from-right');
            } else {
                sideGlass.classList.add('slide-from-right');
                sideInfo .classList.add('slide-from-left');
            }

            // 5. Fade card in
            formCard.style.transition = 'opacity .28s .08s, transform .28s .08s';
            formCard.style.opacity    = '1';
            formCard.style.transform  = 'translateX(0)';

            // 6. BG scale pulse
            bgPhoto.style.transition  = 'transform .15s';
            bgPhoto.style.transform   = 'scale(1.07)';
            setTimeout(() => {
                bgPhoto.style.transition = 'transform 0.9s cubic-bezier(0.87,0,0.13,1)';
                bgPhoto.style.transform  = 'scale(1.04)';
            }, 60);

            setTimeout(() => {
                [sideInfo, sideGlass].forEach(el =>
                    el.classList.remove('slide-from-left','slide-from-right'));
                animating = false;
            }, 720);

        }, 230);
    }

    window.switchTab = switchTab;

    @if($errors->any() && old('name') !== null)
        switchTab('daftar');
    @endif
})();
</script>
</x-guest-layout>