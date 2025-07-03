<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'transaksi_id';
    public $incrementing = true;
    public $timestamps = false;
    public $guarded = ['transaksi_id'];

    function detailtransaksi(): HasMany
    {
        return $this->hasMany(Detailtransaksi::class, 'transaksi_id', 'transaksi_id');
    }
    function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'pelanggan_id');
    }
}
