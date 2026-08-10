<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursales extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombreSucursales',
        'direccionSucursales'
    ];

    public function cronogramas(){
        return $this->hasMany(Cronogramas::class, 'sucursalesid', 'idSucursales');
    }

}
