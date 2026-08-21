<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ausencias extends Model
{
    use HasFactory;

    protected $primaryKey = 'idAusencias';

    protected $fillable = [
        'empleadoid',
        'fechaInicio',
        'fechaFin',
        'tipoAusencias',
        'estadoAusencias',
        'documentoAdjuntoAusencias',
        'observacionesAusencias'
    ];

    protected $appends = ['diasAusencias'];
    
    protected $casts = [
        'fechaInicio' => 'date',
        'fechaFin' => 'date'
    ];

    /*
        Cantidad de dias que dura la ausencia
    */
    public function getDiasAusenciasAttribute(){
        return $this->fechaInicio->diffInDays($this->fechaFin) + 1;
    }

    public function empleado(){
        return $this->belongsTo(Empleados::class, 'empleadoid', 'idEmpleados');
    }
    
}
