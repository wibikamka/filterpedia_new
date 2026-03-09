<x-guest-layout>
<style>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap');

:root {
    --blue:      #0ea5e9;
    --blue-dk:   #0284c7;
    --ease-expo: cubic-bezier(0.87, 0, 0.13, 1);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

html, body {
    width: 100%; height: 100%;
    overflow: hidden;
    font-family: 'DM Sans', sans-serif;
}

.bg-photo {
    position: fixed; inset: 0; z-index: 0;
    background: url("{{ asset('storage/img/banner/warehouse.webp') }}") center/cover no-repeat;
}
.bg-dim {
    position: fixed; inset: 0; z-index: 1;
    background: rgba(4, 15, 30, 0.50);
}

.page {
    position: fixed; inset: 0; z-index: 2;
    display: flex;
}

/* ── Info side (kiri) ── */
.side-info {
    width: 50%; height: 100%;
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 2rem 2.25rem 2.8rem;
}

.logo {
    display: flex; align-items: center; gap: 0.65rem;
    animation: fadeDown .7s both;
    text-decoration: none;
}
.logo img { height: 2.6rem; filter: drop-shadow(0 2px 10px rgba(0,0,0,.6)); }
.logo-text {
    font-family: 'Sora', sans-serif;
    font-size: 1.45rem; font-weight: 800;
    color: #fff; letter-spacing: -.02em;
    text-shadow: 0 2px 14px rgba(0,0,0,.6);
}

.img-intro { animation: fadeUp .85s .2s both; }
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

/* ── Glass side (kanan) ── */
.side-glass {
    width: 50%; height: 100%;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    overflow-y: auto;
    scrollbar-width: none;
    -ms-overflow-style: none;
    background: rgba(255,255,255,0.10);
    backdrop-filter: blur(28px) saturate(1.6) brightness(1.08);
    -webkit-backdrop-filter: blur(28px) saturate(1.6) brightness(1.08);
    border-left: 1px solid rgba(255,255,255,0.20);
    box-shadow: inset 1px 0 0 rgba(255,255,255,0.08), -12px 0 40px rgba(0,0,0,0.18);
}
.side-glass::-webkit-scrollbar { display: none; }

/* ── Form card ── */
.fcard {
    width: 100%; max-width: 420px;
    background: rgba(255,255,255,0.88);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    border-radius: 1.25rem;
    padding: 2.5rem 2.25rem;
    border: 1px solid rgba(255,255,255,0.6);
    box-shadow: 0 4px 6px rgba(0,0,0,0.04),
                0 20px 50px rgba(0,0,0,0.12),
                0 1px 0 rgba(255,255,255,0.95) inset;
    animation: fadeUp .65s .15s both;
}
.fcard-accent {
    height: 3px;
    background: linear-gradient(90deg, var(--blue), #6366f1);
    border-radius: 100px; margin-bottom: 1.75rem;
}

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
.fsub { font-size:.81rem; color:#64748b; margin-top:.35rem; margin-bottom:1.55rem; line-height: 1.6; }

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

.btn {
    width:100%; padding:.76rem 1rem;
    background: linear-gradient(135deg, var(--blue) 0%, var(--blue-dk) 100%);
    color:#fff; font-family:'Sora',sans-serif;
    font-size:.88rem; font-weight:700;
    border:none; border-radius:.65rem; cursor:pointer;
    letter-spacing:.02em; margin-top: 1.35rem;
    transition: transform .15s, box-shadow .15s;
    box-shadow: 0 4px 14px rgba(14,165,233,.32);
}
.btn:hover { transform:translateY(-1px); box-shadow:0 6px 22px rgba(14,165,233,.44); }
.btn:active { transform:translateY(0); }

.ffoot { display:flex; justify-content:center; margin-top:1.15rem; }
.ffoot a {
    font-size:.79rem; color:#64748b;
    text-decoration:none; transition:color .15s;
    display: flex; align-items: center; gap: .35rem;
}
.ffoot a:hover { color:var(--blue); }
.ffoot a svg { width:14px; height:14px; }

.session-ok {
    font-size:.81rem; color:#16a34a;
    background:#f0fdf4; border:1px solid #bbf7d0;
    padding:.65rem .9rem; border-radius:.6rem; margin-bottom:1.1rem;
    display: flex; align-items: center; gap: .5rem;
}

/* ── Mobile ── */
@media (max-width: 768px) {
    html, body { overflow: auto !important; height: auto !important; }
    .bg-photo, .bg-dim { position: fixed !important; }
    .page {
        position: relative !important;
        flex-direction: column !important;
        min-height: 100vh; overflow: visible !important;
    }
    .side-info {
        width: 100% !important;
        min-height: 44vw; max-height: 260px;
        padding: 1.2rem 1.2rem 1.5rem;
    }
    .img-intro { display: none; }
    .side-glass {
        width: 100% !important;
        height: auto; padding: 1.5rem 1rem 3rem;
        border-left: none;
        border-top: 1px solid rgba(255,255,255,0.2);
        box-shadow: 0 -8px 32px rgba(0,0,0,0.2);
        overflow-y: visible;
    }
    .fcard { max-width: 100%; padding: 1.75rem 1.35rem; border-radius: 1rem; }
    .logo img { height: 1.9rem; }
    .logo-text { font-size: 1.1rem; }
}

@keyframes fadeDown {
    from { opacity:0; transform:translateY(-16px); }
    to   { opacity:1; transform:translateY(0); }
}
@keyframes fadeUp {
    from { opacity:0; transform:translateY(20px); }
    to   { opacity:1; transform:translateY(0); }
}
</style>

<div class="bg-photo"></div>
<div class="bg-dim"></div>

<div class="page">
    {{-- Info side --}}
    <div class="side-info">
        <a href="{{ route('login') }}" class="logo">
            <img src="{{ asset('storage/img/logo/filterpedialastfilterpedia.png') }}" alt="Filterpedia">
            <span class="logo-text">filterpedia</span>
        </a>
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
                <div><div class="stat-n">500+</div><div class="stat-l">Produk</div></div>
                <div><div class="stat-n">10+</div><div class="stat-l">Tahun</div></div>
                <div><div class="stat-n">1K+</div><div class="stat-l">Klien</div></div>
            </div>
        </div>
    </div>

    {{-- Glass side --}}
    <div class="side-glass">
        <div class="fcard">
            <div class="fcard-accent"></div>

            <div class="eyebrow">Reset Akses</div>
            <div class="ftitle">Lupa Kata Sandi?</div>
            <div class="fsub">
                Tidak masalah. Masukkan alamat email Anda dan kami akan mengirimkan
                tautan untuk membuat kata sandi baru.
            </div>

            @if(session('status'))
                <div class="session-ok">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:16px;height:16px;flex-shrink:0;color:#16a34a"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="fg">
                    <label class="flabel" for="email">Alamat Email</label>
                    <input id="email" class="finput" type="email" name="email"
                        value="{{ old('email') }}" placeholder="nama@email.com"
                        required autofocus />
                    @error('email') <div class="ferr">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn">Kirim Tautan Reset</button>
            </form>

            <div class="ffoot">
                <a href="{{ route('login') }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Kembali ke halaman masuk
                </a>
            </div>
        </div>
    </div>
</div>
</x-guest-layout>