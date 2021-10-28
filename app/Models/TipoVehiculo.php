<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoVehiculo extends Model
{
    use SoftDeletes;

    protected $table = 'tipos';

    protected $fillable = [
        'descripcion'
    ];
}
