<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoritResep extends Model
{
    protected $table = 'favorit_resep';

    protected $fillable = [
        'user_id',
        'nama_resep',
        'asal_daerah',
        'catatan',
    ];

    /**
     * Get the user that owns the favorit resep.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
