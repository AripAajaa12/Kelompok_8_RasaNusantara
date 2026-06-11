<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','RasaNusantara') – Warisan Kuliner Nusantara</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Dancing+Script:wght@700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;}
        :root{--gold:#c9a84c;--gold-bright:#e5c364;--dark:#1a0f00;--dark-lighter:#2a1b08;--cream:#f5ead5;--cream-semi:rgba(245,234,213,.7);--red:#8b1a1a;--green:#27ae60;--glass:rgba(26,15,0,.85);--glass-border:rgba(201,168,76,.15);}
        body{font-family:'Lato',sans-serif;background:var(--dark);color:var(--cream);min-height:100vh;overflow-x:hidden;}
        a{text-decoration:none;color:inherit;}
        /* NAV */
        nav.main-nav{position:sticky;top:0;z-index:200;background:var(--glass);border-bottom:1px solid var(--glass-border);backdrop-filter:blur(12px);}
        .nav-inner{max-width:1280px;margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:space-between;height:64px;}
        .nav-brand{font-family:'Playfair Display',serif;font-size:20px;font-weight:700;color:var(--gold);letter-spacing:2px;border:1.5px solid var(--gold);padding:6px 14px;}
        .nav-brand span{font-size:9px;display:block;letter-spacing:3px;color:var(--cream);font-family:'Lato',sans-serif;font-weight:300;}
        .nav-links{display:flex;align-items:center;gap:28px;list-style:none;}
        .nav-links a{font-size:11px;letter-spacing:2.5px;text-transform:uppercase;color:var(--cream-semi);transition:color .2s;}
        .nav-links a:hover,.nav-links a.active{color:var(--gold);}
        .nav-btn{background:var(--gold);color:var(--dark)!important;padding:7px 16px;font-weight:700;font-size:11px;letter-spacing:2px;}
        .nav-btn:hover{background:var(--gold-bright)!important;}
        /* FLASH */
        .flash-wrap{max-width:1280px;margin:0 auto;padding:0 24px;}
        .flash{padding:12px 18px;border-radius:4px;margin-top:14px;font-size:14px;}
        .flash.success{background:rgba(39,174,96,.15);border:1px solid #27ae60;color:#5dade2;}
        .flash.success{color:#2ecc71;}
        .flash.error{background:rgba(192,57,43,.15);border:1px solid #c0392b;color:#e74c3c;}
        .flash.info{background:rgba(201,168,76,.12);border:1px solid var(--gold);color:var(--gold);}
        /* FOOTER */
        footer{background:rgba(0,0,0,.6);border-top:1px solid var(--glass-border);padding:40px 24px 20px;margin-top:80px;}
        .footer-inner{max-width:1280px;margin:0 auto;display:grid;grid-template-columns:2fr 1fr 1fr;gap:40px;}
        .footer-brand{font-family:'Playfair Display',serif;font-size:22px;color:var(--gold);margin-bottom:10px;}
        .footer-desc{font-size:13px;color:var(--cream-semi);line-height:1.7;}
        .footer-heading{font-size:11px;letter-spacing:3px;text-transform:uppercase;color:var(--gold);margin-bottom:14px;}
        .footer-links{list-style:none;display:flex;flex-direction:column;gap:8px;}
        .footer-links a{font-size:13px;color:var(--cream-semi);transition:color .2s;}
        .footer-links a:hover{color:var(--gold);}
        .footer-copy{text-align:center;color:var(--cream-semi);font-size:12px;margin-top:30px;padding-top:20px;border-top:1px solid var(--glass-border);}
        /* UTILS */
        .container{max-width:1280px;margin:0 auto;padding:0 24px;}
        .btn{display:inline-block;padding:10px 24px;font-size:12px;letter-spacing:2px;text-transform:uppercase;font-weight:700;cursor:pointer;border:none;transition:all .2s;}
        .btn-gold{background:var(--gold);color:var(--dark);}
        .btn-gold:hover{background:var(--gold-bright);}
        .btn-outline{background:transparent;border:1.5px solid var(--gold);color:var(--gold);}
        .btn-outline:hover{background:var(--gold);color:var(--dark);}
        .btn-red{background:#c0392b;color:#fff;}
        .btn-red:hover{background:#e74c3c;}
        .btn-sm{padding:6px 14px;font-size:11px;}
        .badge{display:inline-block;padding:3px 10px;font-size:10px;letter-spacing:1.5px;text-transform:uppercase;font-weight:700;}
        .badge-gold{background:rgba(201,168,76,.2);border:1px solid var(--gold);color:var(--gold);}
        .badge-green{background:rgba(39,174,96,.2);border:1px solid #27ae60;color:#27ae60;}
        .badge-red{background:rgba(192,57,43,.2);border:1px solid #c0392b;color:#c0392b;}
        .section-title{font-family:'Playfair Display',serif;font-size:32px;color:var(--cream);}
        .section-title span{color:var(--gold);}
        .gold-line{width:60px;height:2px;background:var(--gold);margin:12px 0 24px;}
        .stars{color:var(--gold);font-size:14px;}
        /* MOBILE */
        .nav-toggle{display:none;background:none;border:none;color:var(--cream);font-size:22px;cursor:pointer;}
        @media(max-width:768px){
            .nav-links{display:none;position:fixed;top:64px;left:0;right:0;background:var(--glass);flex-direction:column;padding:20px;gap:14px;border-bottom:1px solid var(--glass-border);}
            .nav-links.open{display:flex;}
            .nav-toggle{display:block;}
            .footer-inner{grid-template-columns:1fr;}
        }
    </style>
    @yield('styles')
</head>
<body>
<nav class="main-nav">
    <div class="nav-inner">
        <a href="{{ route('beranda') }}" class="nav-brand">RasaNusantara<span>Warisan Kuliner Bangsa</span></a>
        <ul class="nav-links" id="navLinks">
            <li><a href="{{ route('beranda') }}" class="{{ request()->routeIs('beranda') ? 'active' : '' }}">Beranda</a></li>
            <li><a href="{{ route('resep.index') }}" class="{{ request()->routeIs('resep.*') ? 'active' : '' }}">Resep</a></li>
            <li><a href="{{ route('kategori.index') }}" class="{{ request()->routeIs('kategori.*') ? 'active' : '' }}">Kategori</a></li>
            <li><a href="{{ route('pencarian') }}" class="{{ request()->routeIs('pencarian') ? 'active' : '' }}">Pencarian</a></li>
            @auth
                <li><a href="{{ route('favorit.index') }}" class="{{ request()->routeIs('favorit.*') ? 'active' : '' }}">Favorit</a></li>
                <li><a href="{{ route('profil.show') }}" class="{{ request()->routeIs('profil.*') ? 'active' : '' }}">Profil</a></li>
                @if(auth()->user()->isAdmin())
                    <li><a href="{{ route('admin.dashboard') }}" style="color:var(--gold)">⚙ Admin</a></li>
                @endif
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline">
                        @csrf
                        <button type="submit" class="btn btn-outline btn-sm">Logout</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="btn btn-outline btn-sm">Masuk</a></li>
                <li><a href="{{ route('register') }}" class="btn btn-gold btn-sm nav-btn">Daftar</a></li>
            @endauth
        </ul>
        <button class="nav-toggle" onclick="document.getElementById('navLinks').classList.toggle('open')">☰</button>
    </div>
</nav>

<div class="flash-wrap">
    @if(session('success'))<div class="flash success">✓ {{ session('success') }}</div>@endif
    @if(session('error'))<div class="flash error">✗ {{ session('error') }}</div>@endif
    @if(session('info'))<div class="flash info">ℹ {{ session('info') }}</div>@endif
</div>

@yield('content')

<footer>
    <div class="footer-inner">
        <div>
            <div class="footer-brand">RasaNusantara</div>
            <p class="footer-desc">Platform resep masakan Indonesia terlengkap. Temukan kekayaan kuliner Nusantara dari Sabang sampai Merauke.</p>
        </div>
        <div>
            <div class="footer-heading">Jelajahi</div>
            <ul class="footer-links">
                <li><a href="{{ route('resep.index') }}">Semua Resep</a></li>
                <li><a href="{{ route('pencarian') }}">Cari Berdasarkan Bahan</a></li>
                <li><a href="{{ route('tentang') }}">Tentang Kami</a></li>
                <li><a href="{{ route('kontak') }}">Kontak</a></li>
            </ul>
        </div>
        <div>
            <div class="footer-heading">Akun</div>
            <ul class="footer-links">
                @auth
                    <li><a href="{{ route('profil.show') }}">Profil Saya</a></li>
                    <li><a href="{{ route('favorit.index') }}">Favorit</a></li>
                @else
                    <li><a href="{{ route('login') }}">Masuk</a></li>
                    <li><a href="{{ route('register') }}">Daftar</a></li>
                @endauth
            </ul>
        </div>
    </div>
    <div class="footer-copy">© {{ date('Y') }} RasaNusantara. Dibuat dengan ❤ untuk Kuliner Indonesia.</div>
</footer>
</body>
</html>
