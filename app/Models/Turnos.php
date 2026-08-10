<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        $horaInicio = Carbon::createFromFormat('H:i', $this->getRawOriginal('horaInicio'));
        $horaFin = Carbon::createFromFormat('H:i', $this->getRawOriginal('horaFin'));
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
