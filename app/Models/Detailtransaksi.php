<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Detailtransaksi extends Model
{
    //
    protected $table = 'detailtransaksi';
    protected $primaryKey = 'detailtransaksi_id';
    public $incrementing = true;
    public $timestamps = false;
    public $guarded = ['detailtransaksi_id'];
    static function cartCount($pelanggan_id)
    {
        return self::join('transaksi', 'transaksi.transaksi_id', '=', 'detailtransaksi.transaksi_id')
            ->join('hewan', 'hewan.hewan_id', '=', 'detailtransaksi.hewan_id')
            ->where('status_transaksi', '=', 'in cart')
            ->where('transaksi.pelanggan_id', '=', $pelanggan_id)
            ->count();
    }
    function hewan(): BelongsTo
    {
        return $this->belongsTo(Hewan::class, 'hewan_id', 'hewan_id');
    }
}
