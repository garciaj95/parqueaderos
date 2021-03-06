<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use SoftDeletes;

    protected $table = 'persona';

    protected $fillable = [
        'identificacion',
        'nombres',
        'email'
    ];

    public function vehiculos() : HasMany
    {
        return $this->hasMany(Vehiculo::class, 'propietario_id', 'identificacion');
    }
}
