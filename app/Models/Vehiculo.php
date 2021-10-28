<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehiculo extends Model
{
    use SoftDeletes;

    protected $table = 'vehiculo';

    protected $fillable = [
        'placa',
        'modelo_id',
        'tipo_id',
        'anio',
        'color',
        'detalle',
        'propietario_id',
    ];

    public function modelo() : HasOne
    {
        return $this->hasOne(Modelo::class, 'modelo_id')->with('marca');
    }

    public function propietario() : HasOne
    {
        return $this->hasOne(Persona::class, 'propietario_id', 'identificacion');
    }
}
