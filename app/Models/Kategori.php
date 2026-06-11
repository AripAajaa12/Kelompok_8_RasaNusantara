<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kategori extends Model {
    protected $fillable = ['nama','slug','icon','deskripsi','gambar'];

    protected static function boot() {
        parent::boot();
        static::creating(fn($m) => $m->slug = $m->slug ?: Str::slug($m->nama));
    }

    public function reseps() { return $this->hasMany(Resep::class); }
}
