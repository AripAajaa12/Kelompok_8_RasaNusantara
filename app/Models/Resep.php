<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Resep extends Model {
    protected $fillable = ['kategori_id','user_id','judul','slug','deskripsi','bahan','langkah','gambar','asal_daerah','waktu_memasak','porsi','tingkat_kesulitan','views','published'];
    protected $casts = ['bahan'=>'array','langkah'=>'array','published'=>'boolean'];

    protected static function boot() {
        parent::boot();
        static::creating(fn($m) => $m->slug = $m->slug ?: Str::slug($m->judul).'-'.Str::random(4));
    }

    public function kategori() { return $this->belongsTo(Kategori::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function ratings() { return $this->hasMany(Rating::class); }
    public function favoritUsers() { return $this->belongsToMany(User::class,'favorit_reseps_new'); }
    public function getRatingRataAttribute() { return $this->ratings->avg('nilai') ?? 0; }
}
