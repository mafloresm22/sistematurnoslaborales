<?php

namespace App\Http\Controllers;

use App\Models\Cronogramas;
use App\Models\Empleados;
use App\Models\Sucursales;
use App\Models\Turnos;
use Illuminate\Http\Request;

class CronogramasController extends Controller
{
    public function index()
    {
        $sucursales = Sucursales::withCount([
            'cronogramas as totalEmpleados' => function($q) {
                $q->distinct('empleadoid');
            },
            'cronogramas as totalTurnos',
        ])->get();

        $turnos = Turnos::with('categoria')->get();
        $assets = ['data-table'];
        return view('cronogramas.index', compact('sucursales', 'turnos', 'assets'));
    }

    /**
     * Devuelve los eventos del calendario de una sucursal en formato JSON para FullCalendar.
     */
    public function eventos($idSucursales)
    {
        $cronogramas = Cronogramas::with(['empleado', 'turno'])
            ->where('sucursalesid', $idSucursales)
            ->get();

        $eventos = $cronogramas->map(function ($c) {
            return [
                'id'              => $c->id,
                'title'           => optional($c->empleado)->nombreEmpleados . ' ' . optional($c->empleado)->apellidoEmpleados
                                     . "\n" . optional($c->turno)->nombreTurnos,
                'start'           => $c->fechaCronograma->format('Y-m-d'),
                'backgroundColor' => optional($c->turno)->colorFondo ?? '#0d6efd',
                'borderColor'     => optional($c->turno)->colorFondo ?? '#0d6efd',
                'textColor'       => optional($c->turno)->colorTexto ?? '#ffffff',
                'extendedProps'   => [
                    'empleado' => optional($c->empleado)->nombreEmpleados . ' ' . optional($c->empleado)->apellidoEmpleados,
                    'turno'    => optional($c->turno)->nombreTurnos,
                    'horario'  => optional($c->turno)->descripcionHorariosTurnos,
                    'nota'     => $c->notaCronograma,
                ],
            ];
        });

        return response()->json($eventos);
    }

    public function empleadosPorSucursal($idSucursales)
    {
        $empleados = Empleados::where('estadoEmpleados', 1)
            ->orWhereNull('estadoEmpleados')
            ->get(['idEmpleados', 'nombreEmpleados', 'apellidoEmpleados']);

        return response()->json($empleados);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'empleadoid'      => 'required|integer|exists:empleados,idEmpleados',
            'sucursalesid'    => 'required|integer|exists:sucursales,idSucursales',
            'turnoid'         => 'required|integer|exists:turnos,idTurno',
            'fechaCronograma' => 'required|date',
            'notaCronograma'  => 'nullable|string|max:500',
        ]);

        $existe = Cronogramas::where('empleadoid', $validated['empleadoid'])
            ->whereDate('fechaCronograma', $validated['fechaCronograma'])
            ->exists();

        if ($existe) {
            return response()->json([
                'success' => false,
                'message' => 'Este empleado ya tiene un turno asignado para esa fecha.',
            ], 422);
        }

        if (empty($validated['notaCronograma'])) {
            $validated['notaCronograma'] = 'Ninguno';
        }

        $cronograma = Cronogramas::create($validated);

        return response()->json([
            'success'    => true,
            'message'    => 'Turno asignado correctamente.',
            'cronograma' => $cronograma,
        ], 201);
    }

    public function edit(Cronogramas $cronogramas)
    {
        //
    }

    public function destroy(Cronogramas $cronogramas)
    {
        //
    }
}
