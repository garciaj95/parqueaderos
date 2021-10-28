<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marca extends Model
{
    use SoftDeletes;

    protected $table = 'marca';

    protected $fillable = [
        'nombre'
    ];

    public function modelos() : HasMany 
    {
        return $this->hasMany(Modelo::class, 'marca_id');
    }
}
