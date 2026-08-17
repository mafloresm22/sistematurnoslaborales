<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Turnos extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombreTurnos',
        'horaInicio',
        'horaFin',
        'colorFondo',
        'colorTexto',
        'categoriaid'
    ];

    protected $casts = [
        'horaInicio' => 'datetime:H:i',
        'horaFin' => 'datetime:H:i'
    ];

    protected $appends = ['duracionTurnos', 'descripcionHorariosTurnos'];

    /*
        Calcula la duracion del turno en minutos.
    */
    public function getDuracionTurnosAttribute()
    {
        $horaInicio = Carbon::parse($this->getRawOriginal('horaInicio'));
        $horaFin = Carbon::parse($this->getRawOriginal('horaFin'));
        
        // Si la hora de fin es menor a la de inicio, significa que cruza la medianoche
        if ($horaFin->lt($horaInicio)) {
            $horaFin->addDay();
        }
        
        return $horaInicio->diffInMinutes($horaFin);
    }

    /*
        Devuelve la descripcion de los horarios del turno.
    */

    public function getDescripcionHorariosTurnosAttribute()
    {
        return $this->horaInicio . ' - ' . $this->horaFin;
    }

    public function categoria(){
        return $this->belongsTo(Categorias::class, 'categoriaid', 'idCategorias');
    }

    public function cronogramas(){
        return $this->hasMany(Cronogramas::class, 'turnoid', 'idTurno');
    }
}
