<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $primaryKey = 'idCategorias';

    protected $fillable = [
        'nombreCategorias',
    ];

    public function turnos(){
        return $this->hasMany(Turnos::class, 'categoriaid', 'idCategorias');
    }
}
