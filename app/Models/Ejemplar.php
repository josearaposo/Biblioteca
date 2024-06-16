<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejemplar extends Model
{
    use HasFactory;

    protected $table = 'ejemplares';

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }

    public function libro()
    {
        return $this->belongsTo(Libro::class);
    }

    public function prestamosVigentes()
    {
        return $this->prestamos()->where('devolucion', null);
    }
}
