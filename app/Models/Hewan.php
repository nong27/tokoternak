<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hewan extends Model
{
    protected $table = 'hewan';
    protected $primaryKey = 'hewan_id';
    public $incrementing = true;
    public $timestamps = false;
    public $guarded = ['hewan_id'];

    function jenishewan(): BelongsTo
    {
        return $this->belongsTo(Jenishewan::class, 'jenishewan_id', 'jenishewan_id');
    }
    function peternak(): BelongsTo
    {
        return $this->belongsTo(Peternak::class, 'peternak_id', 'peternak_id');
    }
}
