<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin – @yield('title','Dashboard') | RasaNusantara</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
    *{margin:0;padding:0;box-sizing:border-box;}
    :root{--gold:#c9a84c;--dark:#1a0f00;--dark-lighter:#2a1b08;--cream:#f5ead5;--cream-semi:rgba(245,234,213,.7);--glass:rgba(26,15,0,.9);--glass-border:rgba(201,168,76,.15);--sidebar-w:240px;}
    body{font-family:'Lato',sans-serif;background:#111;color:var(--cream);display:flex;min-height:100vh;}
    a{text-decoration:none;color:inherit;}
    /* SIDEBAR */
    .sidebar{width:var(--sidebar-w);background:var(--dark);border-right:1px solid var(--glass-border);display:flex;flex-direction:column;position:fixed;top:0;bottom:0;left:0;z-index:100;overflow-y:auto;}
    .sidebar-brand{padding:24px 20px;border-bottom:1px solid var(--glass-border);}
    .sidebar-brand .brand{font-family:'Playfair Display',serif;font-size:18px;color:var(--gold);}
    .sidebar-brand .sub{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--cream-semi);}
    .sidebar-nav{padding:16px 0;flex:1;}
    .sidebar-section{font-size:9px;letter-spacing:3px;text-transform:uppercase;color:rgba(201,168,76,.5);padding:16px 20px 6px;}
    .sidebar-link{display:flex;align-items:center;gap:10px;padding:10px 20px;font-size:13px;color:var(--cream-semi);transition:all .2s;}
    .sidebar-link:hover,.sidebar-link.active{background:rgba(201,168,76,.1);color:var(--gold);border-left:2px solid var(--gold);}
    .sidebar-link .icon{width:18px;text-align:center;}
    .sidebar-footer{padding:16px 20px;border-top:1px solid var(--glass-border);font-size:12px;color:var(--cream-semi);}
    /* MAIN */
    .main{margin-left:var(--sidebar-w);flex:1;display:flex;flex-direction:column;}
    .topbar{background:var(--dark);border-bottom:1px solid var(--glass-border);padding:0 24px;height:56px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:50;}
    .topbar-title{font-family:'Playfair Display',serif;font-size:18px;}
    .topbar-user{font-size:13px;color:var(--cream-semi);display:flex;align-items:center;gap:14px;}
    .content{padding:28px 24px;flex:1;}
    /* COMPONENTS */
    .card{background:var(--dark-lighter);border:1px solid var(--glass-border);padding:24px;margin-bottom:20px;}
    .card-title{font-family:'Playfair Display',serif;font-size:16px;color:var(--gold);margin-bottom:16px;padding-bottom:10px;border-bottom:1px solid var(--glass-border);}
    .stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:28px;}
    .stat-box{background:var(--dark-lighter);border:1px solid var(--glass-border);padding:20px;text-align:center;}
    .stat-box .num{font-family:'Playfair Display',serif;font-size:36px;color:var(--gold);}
    .stat-box .lbl{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--cream-semi);margin-top:4px;}
    table{width:100%;border-collapse:collapse;}
    th{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--gold);padding:10px 12px;border-bottom:2px solid var(--glass-border);text-align:left;}
    td{padding:10px 12px;border-bottom:1px solid var(--glass-border);font-size:13px;color:var(--cream-semi);}
    tr:hover td{background:rgba(201,168,76,.04);}
    .btn{display:inline-block;padding:6px 14px;font-size:11px;letter-spacing:1.5px;text-transform:uppercase;font-weight:700;cursor:pointer;border:none;transition:all .2s;}
    .btn-gold{background:var(--gold);color:var(--dark);}
    .btn-gold:hover{background:#e5c364;}
    .btn-outline{background:transparent;border:1.5px solid var(--gold);color:var(--gold);}
    .btn-outline:hover{background:var(--gold);color:var(--dark);}
    .btn-red{background:#c0392b;color:#fff;}
    .btn-red:hover{background:#e74c3c;}
    .badge{display:inline-block;padding:3px 8px;font-size:10px;letter-spacing:1px;text-transform:uppercase;}
    .badge-gold{background:rgba(201,168,76,.2);border:1px solid var(--gold);color:var(--gold);}
    .badge-green{background:rgba(39,174,96,.2);border:1px solid #27ae60;color:#27ae60;}
    .badge-red{background:rgba(192,57,43,.2);border:1px solid #c0392b;color:#c0392b;}
    .form-group{margin-bottom:16px;}
    .form-label{display:block;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--gold);margin-bottom:6px;}
    .form-input{width:100%;padding:10px 14px;background:rgba(0,0,0,.3);border:1px solid var(--glass-border);color:var(--cream);font-size:13px;font-family:'Lato',sans-serif;}
    .form-input:focus{outline:none;border-color:var(--gold);}
    .flash{padding:12px 16px;border-radius:3px;margin-bottom:16px;font-size:13px;}
    .flash.success{background:rgba(39,174,96,.15);border:1px solid #27ae60;color:#2ecc71;}
    .flash.error{background:rgba(192,57,43,.15);border:1px solid #c0392b;color:#e74c3c;}
    @media(max-width:768px){.stats-grid{grid-template-columns:repeat(2,1fr)}.sidebar{transform:translateX(-100%)}.main{margin-left:0}}
    </style>
    @yield('styles')
</head>
<body>
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand">RasaNusantara</div>
        <div class="sub">Panel Admin</div>
    </div>
    <nav class="sidebar-nav">
        <div class="sidebar-section">Utama</div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active':'' }}"><span class="icon">📊</span> Dashboard</a>

        <div class="sidebar-section">Konten</div>
        <a href="{{ route('admin.resep.index') }}" class="sidebar-link {{ request()->routeIs('admin.resep.*') ? 'active':'' }}"><span class="icon">🍽</span> Kelola Resep</a>
        <a href="{{ route('admin.kategori.index') }}" class="sidebar-link {{ request()->routeIs('admin.kategori.*') ? 'active':'' }}"><span class="icon">🏷</span> Kelola Kategori</a>

        <div class="sidebar-section">Pengguna</div>
        <a href="{{ route('admin.pengguna.index') }}" class="sidebar-link {{ request()->routeIs('admin.pengguna.*') ? 'active':'' }}"><span class="icon">👥</span> Kelola Pengguna</a>
        <a href="{{ route('admin.ulasan.index') }}" class="sidebar-link {{ request()->routeIs('admin.ulasan.*') ? 'active':'' }}"><span class="icon">💬</span> Kelola Ulasan</a>

        <div class="sidebar-section">Laporan</div>
        <a href="{{ route('admin.statistik') }}" class="sidebar-link {{ request()->routeIs('admin.statistik') ? 'active':'' }}"><span class="icon">📈</span> Statistik</a>
    </nav>
    <div class="sidebar-footer">
        <div style="font-weight:700;margin-bottom:4px;">{{ auth()->user()->name }}</div>
        <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" style="background:none;border:none;color:var(--cream-semi);cursor:pointer;font-size:12px;padding:0;">→ Logout</button></form>
        <a href="{{ route('beranda') }}" style="font-size:12px;color:var(--cream-semi);display:block;margin-top:6px;">← Ke Beranda</a>
    </div>
</aside>
<div class="main">
    <div class="topbar">
        <div class="topbar-title">@yield('title','Dashboard')</div>
        <div class="topbar-user"><span>Halo, {{ auth()->user()->name }}</span><span class="badge badge-gold">Admin</span></div>
    </div>
    <div class="content">
        @if(session('success'))<div class="flash success">✓ {{ session('success') }}</div>@endif
        @if(session('error'))<div class="flash error">✗ {{ session('error') }}</div>@endif
        @yield('content')
    </div>
</div>
</body>
</html>
