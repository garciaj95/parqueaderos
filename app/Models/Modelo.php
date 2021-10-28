<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modelo extends Model
{
    use SoftDeletes;

    protected $table = 'modelo';

    protected $fillable = [
        'descripcion',
        'marca_id',
    ];

    public function marca() : BelongsTo
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }
}
