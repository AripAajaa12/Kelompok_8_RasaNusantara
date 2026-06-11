<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login – RasaNusantara</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;}
:root{--gold:#c9a84c;--dark:#1a0f00;--dark-lighter:#2a1b08;--cream:#f5ead5;--cream-semi:rgba(245,234,213,.7);--glass-border:rgba(201,168,76,.15);}
body{font-family:'Lato',sans-serif;background:var(--dark);color:var(--cream);min-height:100vh;display:flex;align-items:center;justify-content:center;background-image:radial-gradient(circle at 20% 50%,rgba(201,168,76,.06) 0%,transparent 50%),radial-gradient(circle at 80% 20%,rgba(139,26,26,.1) 0%,transparent 40%);}
.auth-box{width:420px;max-width:95vw;background:var(--dark-lighter);border:1px solid var(--glass-border);padding:40px;}
.auth-brand{text-align:center;margin-bottom:32px;}
.auth-brand .logo{font-family:'Playfair Display',serif;font-size:26px;color:var(--gold);border:1.5px solid var(--gold);display:inline-block;padding:8px 20px;}
.auth-brand .sub{font-size:10px;letter-spacing:3px;text-transform:uppercase;color:var(--cream-semi);margin-top:6px;}
.auth-title{font-family:'Playfair Display',serif;font-size:22px;margin-bottom:4px;}
.auth-sub{font-size:13px;color:var(--cream-semi);margin-bottom:28px;}
.form-group{margin-bottom:18px;}
.form-label{display:block;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--gold);margin-bottom:7px;}
.form-input{width:100%;padding:11px 14px;background:rgba(0,0,0,.3);border:1px solid var(--glass-border);color:var(--cream);font-size:14px;font-family:'Lato',sans-serif;transition:border-color .2s;}
.form-input:focus{outline:none;border-color:var(--gold);}
.form-error{color:#e74c3c;font-size:12px;margin-top:4px;}
.btn-full{width:100%;padding:13px;background:var(--gold);color:var(--dark);font-weight:700;font-size:13px;letter-spacing:2px;text-transform:uppercase;border:none;cursor:pointer;transition:background .2s;}
.btn-full:hover{background:#e5c364;}
.auth-footer{text-align:center;margin-top:20px;font-size:13px;color:var(--cream-semi);}
.auth-footer a{color:var(--gold);}
.divider{border:none;border-top:1px solid var(--glass-border);margin:24px 0;}
.flash{padding:10px 14px;border-radius:3px;margin-bottom:16px;font-size:13px;}
.flash.error{background:rgba(192,57,43,.15);border:1px solid #c0392b;color:#e74c3c;}
</style>
</head>
<body>
<div class="auth-box">
    <div class="auth-brand">
        <div class="logo">RasaNusantara</div>
        <div class="sub">Warisan Kuliner Nusantara</div>
    </div>
    <div class="auth-title">Selamat Datang</div>
    <div class="auth-sub">Masuk untuk menyimpan resep favorit dan memberi ulasan</div>

    @if($errors->any())
    <div class="flash error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="email@anda.com" required autofocus>
        </div>
        <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-input" placeholder="••••••••" required>
        </div>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
            <label style="display:flex;align-items:center;gap:8px;font-size:13px;color:var(--cream-semi);cursor:pointer;">
                <input type="checkbox" name="remember"> Ingat saya
            </label>
        </div>
        <button type="submit" class="btn-full">Masuk</button>
    </form>

    <hr class="divider">
    <div class="auth-footer">
        Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
    </div>
    <div class="auth-footer" style="margin-top:10px;">
        <a href="{{ route('beranda') }}" style="font-size:12px;color:var(--cream-semi);">← Kembali ke Beranda</a>
    </div>
</div>
</body>
</html>
