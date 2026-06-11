@extends('layouts.app')
@section('title','Kontak')
@section('content')
<div class="container" style="padding:60px 24px;">
    <div style="max-width:600px;margin:0 auto;">
        <div class="section-title">Hubungi <span>Kami</span></div>
        <div class="gold-line"></div>
        <p style="color:var(--cream-semi);font-size:15px;margin-bottom:32px;">Ada pertanyaan, saran, atau ingin berkolaborasi? Kami senang mendengar dari Anda.</p>
        <div style="background:var(--dark-lighter);border:1px solid var(--glass-border);padding:32px;">
            <div style="display:grid;gap:16px;margin-bottom:24px;">
                <div style="display:flex;gap:14px;align-items:center;"><div style="font-size:24px;">📧</div><div><div style="font-size:12px;letter-spacing:2px;text-transform:uppercase;color:var(--gold);">Email</div><div style="font-size:14px;">halo@rasanusantara.id</div></div></div>
                <div style="display:flex;gap:14px;align-items:center;"><div style="font-size:24px;">📍</div><div><div style="font-size:12px;letter-spacing:2px;text-transform:uppercase;color:var(--gold);">Lokasi</div><div style="font-size:14px;">Surabaya, Jawa Timur, Indonesia</div></div></div>
            </div>
            <form style="display:grid;gap:16px;">
                <div><label style="font-size:11px;letter-spacing:2px;text-transform:uppercase;color:var(--gold);display:block;margin-bottom:6px;">Nama</label><input type="text" class="filter-input" style="width:100%;" placeholder="Nama Anda"></div>
                <div><label style="font-size:11px;letter-spacing:2px;text-transform:uppercase;color:var(--gold);display:block;margin-bottom:6px;">Email</label><input type="email" class="filter-input" style="width:100%;" placeholder="email@anda.com"></div>
                <div><label style="font-size:11px;letter-spacing:2px;text-transform:uppercase;color:var(--gold);display:block;margin-bottom:6px;">Pesan</label><textarea rows="5" class="filter-input" style="width:100%;resize:vertical;" placeholder="Tulis pesan Anda..."></textarea></div>
                <button type="button" class="btn btn-gold">Kirim Pesan</button>
            </form>
        </div>
    </div>
</div>
<style>.filter-input{background:rgba(0,0,0,.3);border:1px solid var(--glass-border);color:var(--cream);padding:10px 14px;font-size:13px;font-family:'Lato',sans-serif;}.filter-input:focus{outline:none;border-color:var(--gold);}</style>
@endsection
