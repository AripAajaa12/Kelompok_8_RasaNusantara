@extends('layouts.app')
@section('title','Tentang Kami')
@section('content')
<div class="container" style="padding:60px 24px;">
    <div style="max-width:800px;margin:0 auto;">
        <div class="section-title">Tentang <span>RasaNusantara</span></div>
        <div class="gold-line"></div>
        <p style="font-size:16px;line-height:1.9;color:var(--cream-semi);margin-bottom:24px;">RasaNusantara adalah platform resep masakan Indonesia terlengkap yang didedikasikan untuk melestarikan dan mempopulerkan kekayaan kuliner Nusantara dari Sabang sampai Merauke.</p>
        <p style="font-size:16px;line-height:1.9;color:var(--cream-semi);margin-bottom:24px;">Dengan fitur pencarian berdasarkan bahan makanan yang dimiliki, kami membantu Anda menemukan resep yang tepat dari apa yang ada di dapur Anda. Bukan hanya resep, tapi juga cerita di balik setiap hidangan tradisional Indonesia.</p>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:40px;">
            <div style="background:var(--dark-lighter);border:1px solid var(--glass-border);padding:24px;text-align:center;">
                <div style="font-size:36px;margin-bottom:10px;">🍽️</div>
                <div style="font-family:'Playfair Display',serif;font-size:18px;color:var(--gold);">Resep Lengkap</div>
                <p style="font-size:13px;color:var(--cream-semi);margin-top:8px;">Ribuan resep dari seluruh penjuru Indonesia</p>
            </div>
            <div style="background:var(--dark-lighter);border:1px solid var(--glass-border);padding:24px;text-align:center;">
                <div style="font-size:36px;margin-bottom:10px;">🔍</div>
                <div style="font-family:'Playfair Display',serif;font-size:18px;color:var(--gold);">Cari Berdasarkan Bahan</div>
                <p style="font-size:13px;color:var(--cream-semi);margin-top:8px;">Fitur unggulan pencarian resep dari bahan yang Anda punya</p>
            </div>
            <div style="background:var(--dark-lighter);border:1px solid var(--glass-border);padding:24px;text-align:center;">
                <div style="font-size:36px;margin-bottom:10px;">⭐</div>
                <div style="font-family:'Playfair Display',serif;font-size:18px;color:var(--gold);">Komunitas Aktif</div>
                <p style="font-size:13px;color:var(--cream-semi);margin-top:8px;">Berbagi pengalaman dan ulasan bersama pecinta kuliner</p>
            </div>
        </div>
    </div>
</div>
@endsection
