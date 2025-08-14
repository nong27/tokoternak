<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kecamatan extends Model
{
    //
    protected $table = 'kecamatan';
    protected $primaryKey = 'kecamatan_id';
    public $incrementing = true;
    public $timestamps = false;
    public $guarded = ['kecamatan_id'];

    function peternak(): HasMany
    {
        return $this->hasMany(Peternak::class, 'kecamatan_id', 'kecamatan_id');
    }
}
