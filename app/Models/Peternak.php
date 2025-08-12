<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peternak extends Model
{
    protected $table = 'peternak';
    protected $primaryKey = 'peternak_id';
    public $incrementing = true;
    public $timestamps = false;
    public $guarded = ['peternak_id'];

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id')->withDefault([
            'username' => 'no data'
        ]);
    }
    function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'kecamatan_id')->withDefault([
            'kecamatan_nama' => 'no data'
        ]);
    }
}
