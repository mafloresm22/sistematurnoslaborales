<?php

namespace App\Http\Controllers;

use App\Models\Ausencias;
use App\Models\Empleados;
use Illuminate\Http\Request;

class AusenciasController extends Controller
{
    public function index()
    {
        $ausencias = Ausencias::orderBy('idAusencia', 'asc')->paginate(9);
        $hoy = now()->toDateString();
        $ausenciasHoy = Ausencias::whereDate('fechaInicio', '<=', $hoy)
                            ->whereDate('fechaFin', '>=', $hoy)
                            ->count();

        $ausenciasPendientes = Ausencias::where('estadoAusencias', 'Pendiente')->count();
        $totalAusencias = $ausencias->count();
        $listaEmpleados = Empleados::all();
        return view('ausencias.index', compact('ausencias', 'listaEmpleados','ausenciasHoy', 'ausenciasPendientes', 'totalAusencias'));
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
    public function show(Ausencias $ausencias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ausencias $ausencias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ausencias $ausencias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ausencias $ausencias)
    {
        //
    }
}
