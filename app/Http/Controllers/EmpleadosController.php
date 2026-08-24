<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EmpleadosController extends Controller
{
    public function index()
    {
        $this->authorize('empleados.ver');
        $empleados = Empleados::orderBy('idEmpleados', 'asc')->get();
        return view('empleados.index', compact('empleados'));
    }

    public function store(Request $request)
    {
        $this->authorize('empleados.crear');
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

    public function update(Request $request, $idEmpleados)
    {
        $this->authorize('empleados.editar');
        $empleado = Empleados::findOrFail($idEmpleados);
        $usuario = User::findOrFail($empleado->usuarioid);

        $tipoDoc = $request->tipodocumentoEmpleados;
        if ($tipoDoc === 'Otro') {
            $tipoDoc = $request->tipodocumentoEmpleados_otro ?? 'Otro';
        }
        $validatedData = $request->validate([
            'nombreEmpleados'          => 'required|string|max:150',
            'apellidoEmpleados'        => 'required|string|max:150',
            'numerodocumentoEmpleados' => 'required|string|max:20',
            'correoEmpleados'          => [
                'nullable',
                'email',
                'max:150',
                Rule::unique('users', 'email')->ignore($usuario->id), // Ignora el email del usuario actual
            ],
            'telefonoEmpleados'        => 'nullable|string|max:9',
            'fechanacimientoEmpleados' => 'required|date',
            'sexoEmpleados'            => 'required|in:Masculino,Femenino,Otros',
            'profesionEmpleados'       => 'required|string|max:150',
            'direccionEmpleados'       => 'nullable|string|max:150',
            'avatarEmpleados'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $avatarPath = $empleado->avatarEmpleados; // Conservar imagen actual por defecto

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
                    ->with('error', 'Error al subir la nueva imagen: ' . $e->getMessage());
            }
        }

        // 5. Iniciar Transacción en Base de Datos
        DB::beginTransaction();

        try {
            // Actualizar Registro en la Tabla USERS
            $usuario->update([
                'first_name'   => $validatedData['nombreEmpleados'],
                'last_name'    => $validatedData['apellidoEmpleados'],
                'email'        => !empty($validatedData['correoEmpleados']) ? $validatedData['correoEmpleados'] : 'Ninguno',
                'phone_number' => !empty($validatedData['telefonoEmpleados']) ? $validatedData['telefonoEmpleados'] : 'Ninguno',
            ]);

            // Actualizar Registro en la Tabla EMPLEADOS
            $empleado->update([
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
            ]);

            DB::commit();

            return redirect()->route('empleados.index')
                ->with('success', "Empleado '{$empleado->nombreEmpleados}' actualizado correctamente.");

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Error en base de datos al actualizar: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request, $idEmpleados)
    {
        $this->authorize('empleados.eliminar');
        $empleado = Empleados::findOrFail($idEmpleados);
        $usuario = User::findOrFail($empleado->usuarioid);

        $validatedData = $request->validate([
            'estadoEmpleados' => 'required|in:Activo,Inactivo,Suspendido',
        ]);

        $nuevoEstado = $validatedData['estadoEmpleados'];

        DB::beginTransaction();

        try {
            $empleado->update([
                'estadoEmpleados' => $nuevoEstado,
            ]);
        
            $estadoUsuario = ($nuevoEstado === 'Activo') ? 'active' : 'inactive'; // Si es Activo, su estado será active, de lo contrario inactive
            $usuario->update([
                'status' => $estadoUsuario,
            ]);

            DB::commit();

            return redirect()->route('empleados.index')
                ->with('success', "El estado de '{$empleado->nombreEmpleados}' ha sido cambiado a {$nuevoEstado}.");

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('empleados.index')
                ->with('error', 'Error al cambiar el estado: ' . $e->getMessage());
        }
    }
}
