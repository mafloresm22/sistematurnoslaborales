<?php

namespace App\Http\Controllers\Security;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermission extends Controller
{
    /**
     * Módulos del sistema con sus permisos según las rutas de web.php
     */
    protected function getModules(): array
    {
        return [
            'inicio' => [
                'label' => 'Inicio / Dashboard',
                'icon'  => 'home',
                'perms' => ['inicio.ver'],
            ],
            'roles_permisos' => [
                'label' => 'Roles y Permisos',
                'icon'  => 'shield',
                'perms' => ['roles.ver', 'roles.crear', 'roles.editar', 'roles.eliminar',
                            'permisos.ver', 'permisos.crear', 'permisos.editar', 'permisos.eliminar'],
            ],
            'usuarios' => [
                'label' => 'Usuarios',
                'icon'  => 'users',
                'perms' => ['usuarios.ver', 'usuarios.crear', 'usuarios.editar', 'usuarios.eliminar',
                            'usuarios.reset-password', 'usuarios.cambiar-rol'],
            ],
            'empleados' => [
                'label' => 'Empleados',
                'icon'  => 'person',
                'perms' => ['empleados.ver', 'empleados.crear', 'empleados.editar', 'empleados.eliminar'],
            ],
            'categorias' => [
                'label' => 'Categorías',
                'icon'  => 'tag',
                'perms' => ['categorias.ver', 'categorias.crear', 'categorias.editar', 'categorias.eliminar'],
            ],
            'sucursales' => [
                'label' => 'Sucursales',
                'icon'  => 'building',
                'perms' => ['sucursales.ver', 'sucursales.crear', 'sucursales.editar', 'sucursales.eliminar'],
            ],
            'turnos' => [
                'label' => 'Turnos',
                'icon'  => 'clock',
                'perms' => ['turnos.ver', 'turnos.crear', 'turnos.editar', 'turnos.eliminar'],
            ],
            'ausencias' => [
                'label' => 'Ausencias',
                'icon'  => 'calendar',
                'perms' => ['ausencias.ver', 'ausencias.crear', 'ausencias.editar', 'ausencias.eliminar', 'ausencias.cambiar-estado'],
            ],
            'cronogramas' => [
                'label' => 'Cronogramas',
                'icon'  => 'schedule',
                'perms' => ['cronogramas.ver', 'cronogramas.crear', 'cronogramas.editar', 'cronogramas.eliminar'],
            ],
        ];
    }

    /**
     * Sincroniza los permisos del sistema con la base de datos
     */
    protected function syncPermissions(): void
    {
        $allPerms = collect($this->getModules())
            ->flatMap(fn($m) => $m['perms'])
            ->unique()
            ->values();

        foreach ($allPerms as $permName) {
            $title = collect(explode('.', $permName))
                ->map(fn($w) => ucfirst($w))
                ->join(' ');

            Permission::firstOrCreate(
                ['name' => $permName, 'guard_name' => 'web'],
                ['title' => $title]
            );
        }
    }

    public function index(Request $request)
    {
        $this->syncPermissions();

        $roles   = Role::with('permissions')->get();
        $modules = $this->getModules();

        // Reconstruir los permisos desde la BD para asegurar IDs correctos
        $allPermNames = collect($modules)->flatMap(fn($m) => $m['perms'])->unique()->values();
        $permissions  = Permission::whereIn('name', $allPermNames)->get()->keyBy('name');

        return view('role-permission.permissions', compact('roles', 'modules', 'permissions'));
    }

    public function store(Request $request)
    {
        $this->syncPermissions();

        $data = $request->input('permissions', []);
        $roles = Role::all();

        DB::transaction(function () use ($data, $roles) {
            foreach ($roles as $role) {
                $permissionsForRole = $data[$role->name] ?? [];
                // Solo sync los permisos del sistema (los definidos en módulos)
                $allModulePerms = collect($this->getModules())
                    ->flatMap(fn($m) => $m['perms'])
                    ->unique()
                    ->values()
                    ->toArray();

                $toSync = Permission::whereIn('name', $permissionsForRole)
                                    ->whereIn('name', $allModulePerms)
                                    ->pluck('id')
                                    ->toArray();

                // Sync solo los permisos del módulo (no toca otros permisos que pueda tener el rol)
                $currentModulePermIds = Permission::whereIn('name', $allModulePerms)->pluck('id');
                $role->permissions()->detach($currentModulePermIds);
                if (!empty($toSync)) {
                    $role->permissions()->attach($toSync);
                }
            }
        });

        // Limpiar caché de permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect()->route('role.permission.list')
                         ->with('success', 'Permisos actualizados correctamente.');
    }
}
