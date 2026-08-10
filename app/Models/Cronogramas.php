<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cronogramas extends Model
{
    use HasFactory;

    protected $fillable = [
        'empleadoid',
        'sucursalesid',
        'turnoid',
        'fechaCronograma',
        'notaCronograma'
    ];

    protected $casts = [
        'fechaCronograma' => 'date'
    ];

    protected $appends = ['diaSemana'];

    /*
        Obtener dia de la semana segun la fecha del
        cronograma
    */
    public function getDiasSemanaAttribute(){
        $diasSemana = ['Domingo', 'Lunes', 'Martes', 
                       'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
        return $diasSemana[$this->fechaCronograma->dayOfWeek];
    }
    
    public function empleado(){
        return $this->belongsTo(Empleados::class, 'empleadoid', 'idEmpleados');
    }

    public function sucursales(){
        return $this->belongsTo(Sucursales::class, 'sucursalesid', 'idSucursales');
    }

    public function turno(){
        return $this->belongsTo(Turnos::class, 'turnoid', 'idTurno');
    }
}
