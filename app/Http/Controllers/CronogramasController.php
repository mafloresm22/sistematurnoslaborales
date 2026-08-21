<?php

namespace App\Http\Controllers;

use App\Models\Cronogramas;
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

        $turnos = Turnos::all();
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cronogramas $cronogramas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cronogramas $cronogramas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cronogramas $cronogramas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cronogramas $cronogramas)
    {
        //
    }
}
