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

        // 1. Añadida la validación del email único en la tabla users
        $validatedData = $request->validate([
            'nombreEmpleados'          => 'required|string|max:150',
            'apellidoEmpleados'        => 'required|string|max:150',
            'numerodocumentoEmpleados' => 'required|string|max:12',
            'correoEmpleados'          => 'required|email|max:150|unique:users,email', // <-- Validación agregada
            'telefonoEmpleados'        => 'nullable|string|max:15',
            'fechanacimientoEmpleados' => 'required|date',
            'sexoEmpleados'            => 'required|in:Masculino,Femenino,Otros',
            'profesionEmpleados'       => 'required|string|max:150',
            'direccionEmpleados'       => 'required|string|max:150',
            'avatarEmpleados'          => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // Lógica para generar el nombre de usuario
            $primerNombre = trim(explode(' ', $request->nombreEmpleados)[0]);
            $primerApellido = trim(explode(' ', $request->apellidoEmpleados)[0]);
        
            $baseUsername = Str::lower(
                substr($primerNombre, 0, 2) . $primerApellido . substr($primerNombre, -1)
            );
            $baseUsername = Str::slug($baseUsername, ''); // Limpiar caracteres especiales / acentos

            // Verificar que sea único el username
            $username = $baseUsername;
            $counter = 1;
            while (User::where('username', $username)->exists()) {
                $username = $baseUsername . $counter;
                $counter++;
            }

            // 2. Crear el Registro de Usuario con el email guardado
            $usuario = User::create([
                'first_name' => $request->nombreEmpleados,
                'last_name'  => $request->apellidoEmpleados,
                'username'   => $username,
                'email'      => $request->correoEmpleados, // <-- Guardado en la tabla USERS
                'password'   => Hash::make($request->numerodocumentoEmpleados),
            ]);

            // C. Procesamiento y Guardado de la Foto / Avatar
            $avatarPath = null;

            if ($request->hasFile('avatarEmpleados')) {
                $file = $request->file('avatarEmpleados');
                $filename = time() . '_' . Str::slug($request->nombreEmpleados) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('empleados', $filename, 's3');
                $avatarPath = Storage::disk('s3')->url($path);
            }

            // D. Crear el Registro de Empleado (Sin modificar sus columnas)
            Empleados::create([
                'nombreEmpleados'          => $request->nombreEmpleados,
                'apellidoEmpleados'        => $request->apellidoEmpleados,
                'tipodocumentoEmpleados'   => $tipoDoc,
                'numerodocumentoEmpleados' => $request->numerodocumentoEmpleados,
                'telefonoEmpleados'        => $request->telefonoEmpleados,
                'direccionEmpleados'       => $request->direccionEmpleados,
                'profesionEmpleados'       => $request->profesionEmpleados,
                'fechanacimientoEmpleados' => $request->fechanacimientoEmpleados,
                'sexoEmpleados'            => $request->sexoEmpleados,
                'avatarEmpleados'          => $avatarPath,
                'estadoEmpleados'          => 'Activo',
                'usuarioid'                => $usuario->id,
            ]);

            DB::commit();

            return redirect()->route('empleados.index')
                ->with('success', "Empleado registrado correctamente. Usuario creado: {$username}");

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Ocurrió un error al registrar el empleado: ' . $e->getMessage());
        }
    }
}
