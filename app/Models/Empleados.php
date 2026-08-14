<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    use HasFactory;

    protected $primaryKey = 'idEmpleados';

    protected $fillable = [
        'nombreEmpleados',
        'apellidoEmpleados',
        'tipodocumentoEmpleados',
        'numerodocumentoEmpleados',
        'telefonoEmpleados',
        'direccionEmpleados',
        'profesionEmpleados',
        'fechanacimientoEmpleados',
        'sexoEmpleados',
        'avatarEmpleados',
        'estadoEmpleados',
        'usuarioid'
    ];

    protected $casts = [
        'fechanacimientoEmpleados' => 'date'
    ];

    public function getAvatarEmpleadosAttribute($value)
    {
        if (empty($value)) {
            return null;
        }
        $value = str_replace('.storage.supabase.co/storage/v1/s3/', '.supabase.co/storage/v1/object/public/', $value);

        return $value;
    }

    protected $append = ['nombreCompletoEmpleados'];

    /*
        Obtener nombre completo del empleado
    */
    public function getNombreCompletoEmpleadosAttribute(){
        return $this->nombreEmpleados . ' ' . $this->apellidoEmpleados;
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'usuarioid', 'id');
    }

    public function cronogramas(){
        return $this->hasMany(Cronogramas::class, 'empleadoid', 'idEmpleados');
    }

    public function ausencias(){
        return $this->hasMany(Ausencias::class, 'empleadoid', 'idEmpleados');
    }
}
