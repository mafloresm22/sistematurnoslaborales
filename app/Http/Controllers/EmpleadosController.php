<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EmpleadosController extends Controller
{
    public function index()
    {
        $empleados = Empleados::orderBy('idEmpleados', 'asc')->get();
        return view('empleados.index', compact('empleados'));
    }

    public function store(Request $request)
    {
        $tipoDoc = $request->tipodocumentoEmpleados;
        if ($tipoDoc === 'Otro') {
            $tipoDoc = $request->tipodocumentoEmpleados_otro ?? 'Otro';
        }

        $validatedData = $request->validate([
            'nombreEmpleados'          => 'required|string|max:150',
            'apellidoEmpleados'        => 'required|string|max:150',
            'numerodocumentoEmpleados' => 'required|string|max:20',
            'correoEmpleados'          => 'nullable|email|max:150|unique:users,email',
            'telefonoEmpleados'        => 'nullable|string|max:9',
            'fechanacimientoEmpleados' => 'required|date',
            'sexoEmpleados'            => 'required|in:Masculino,Femenino,Otros',
            'profesionEmpleados'       => 'required|string|max:150',
            'direccionEmpleados'       => 'nullable|string|max:150',
            'avatarEmpleados'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatarEmpleados')) {
            try {
                $file = $request->file('avatarEmpleados');
                $filename = time() . '_' . Str::slug($validatedData['nombreEmpleados']) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('empleados', $filename, 's3');

                // Construir la URL pública de Supabase Storage
                $bucket = config('filesystems.disks.s3.bucket');
                $baseUrl = rtrim(config('filesystems.disks.s3.url'), '/');
                $avatarPath = "{$baseUrl}/{$bucket}/{$path}";
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Error al subir la imagen: ' . $e->getMessage());
            }
        }

        DB::beginTransaction();

        try {
            // Generar username único
            $primerNombre = trim(explode(' ', $validatedData['nombreEmpleados'])[0]);
            $primerApellido = trim(explode(' ', $validatedData['apellidoEmpleados'])[0]);

            $baseUsername = Str::slug(
                substr($primerNombre, 0, 2) . $primerApellido . substr($primerNombre, -1),
                ''
            );

            $username = $baseUsername;
            $counter = 1;
            while (User::where('username', $username)->exists()) {
                $username = $baseUsername . $counter;
                $counter++;
            }

            // Crear Registro en la Tabla USERS
            $usuario = User::create([
                'first_name'   => $validatedData['nombreEmpleados'],
                'last_name'    => $validatedData['apellidoEmpleados'],
                'username'     => $username,
                'email'        => !empty($validatedData['correoEmpleados']) ? $validatedData['correoEmpleados'] : 'Ninguno',
                'phone_number' => !empty($validatedData['telefonoEmpleados']) ? $validatedData['telefonoEmpleados'] : 'Ninguno',
                'user_type'    => 'user',
                'status'       => 'active',
                'password'     => Hash::make($validatedData['numerodocumentoEmpleados']),
            ]);

            // Crear Registro en la Tabla EMPLEADOS
            Empleados::create([
                'nombreEmpleados'          => $validatedData['nombreEmpleados'],
                'apellidoEmpleados'        => $validatedData['apellidoEmpleados'],
                'tipodocumentoEmpleados'   => $tipoDoc,
                'numerodocumentoEmpleados' => $validatedData['numerodocumentoEmpleados'],
                'telefonoEmpleados'        => !empty($validatedData['telefonoEmpleados']) ? $validatedData['telefonoEmpleados'] : 'Ninguno',
                'direccionEmpleados'       => !empty($validatedData['direccionEmpleados']) ? $validatedData['direccionEmpleados'] : 'Ninguno',
                'profesionEmpleados'       => $validatedData['profesionEmpleados'],
                'fechanacimientoEmpleados' => $validatedData['fechanacimientoEmpleados'],
                'sexoEmpleados'            => $validatedData['sexoEmpleados'],
                'avatarEmpleados'          => $avatarPath,
                'estadoEmpleados'          => 'Activo',
                'usuarioid'                => $usuario->id,
            ]);

            DB::commit();

            return redirect()->route('empleados.index')
                ->with('success', "Empleado y usuario '{$username}' creados correctamente.");

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Error en base de datos: ' . $e->getMessage());
        }
    }
}
