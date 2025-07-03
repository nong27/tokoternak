<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jenishewan extends Model
{
    protected $table = 'jenishewan';
    protected $primaryKey = 'jenishewan_id';
    public $incrementing = true;
    public $timestamps = false;
    public $guarded = ['jenishewan_id'];

    function hewan(): HasMany
    {
        return $this->hasMany(Hewan::class, 'jenishewan_id', 'jenishewan_id');
    }
}
