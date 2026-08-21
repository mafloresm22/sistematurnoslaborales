<?php

namespace App\Http\Controllers;

use App\Models\Ausencias;
use App\Models\Empleados;
use Illuminate\Http\Request;

class AusenciasController extends Controller
{
    public function index()
    {
        $ausencias = Ausencias::orderBy('idAusencias', 'asc')->paginate(9);
        $hoy = now()->toDateString();
        $ausenciasHoy = Ausencias::whereDate('fechaInicio', '<=', $hoy)
                            ->whereDate('fechaFin', '>=', $hoy)
                            ->count();

        $ausenciasPendientes = Ausencias::where('estadoAusencias', 'Pendiente')->count();
        $totalAusencias = $ausencias->count();
        $listaEmpleados = Empleados::all();
        return view('ausencias.index', compact('ausencias', 'listaEmpleados','ausenciasHoy', 'ausenciasPendientes', 'totalAusencias'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'empleadoid' => 'required|integer|exists:empleados,idEmpleados',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
            'tipoAusencias' => 'required|in:Vacaciones,Enfermedad,Licencia de maternidad/paternidad,Licencia no remunerada,Día libre,Otros',
            'observacionesAusencias' => 'nullable|string',
            'documentoAdjuntoAusencias' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $cruceFechas = Ausencias::where('empleadoid', $validatedData['empleadoid'])
            ->where('estadoAusencias', '!=', 'Rechazado')
            ->where(function ($query) use ($validatedData) {
                $query->where('fechaInicio', '<=', $validatedData['fechaFin'])
                      ->where('fechaFin', '>=', $validatedData['fechaInicio']);
            })
            ->exists();

        if ($cruceFechas) {
            return redirect()->back()
                             ->withInput()
                             ->withErrors(['fechaInicio' => 'El empleado ya cuenta con una ausencia registrada (Pendiente o Aprobada) que se cruza con estas fechas.']);
        }

        if ($request->hasFile('documentoAdjuntoAusencias')) {
            $path = $request->file('documentoAdjuntoAusencias')->store('documentos', 's3');
            $validatedData['documentoAdjuntoAusencias'] = $path;
        }

        if (!isset($validatedData['estadoAusencias'])) {
            $validatedData['estadoAusencias'] = 'Pendiente';
        }

        Ausencias::create($validatedData);
        return redirect()->route('ausencias.index')->with('success', 'Ausencia registrada exitosamente.');
    }

    public function show($idAusencias)
    {
        $ausencia = Ausencias::with('empleado')->findOrFail($idAusencias);
        return view('ausencias.show', compact('ausencia'));
    }

    public function update(Request $request, $idAusencias)
    {
        $ausencia = Ausencias::findOrFail($idAusencias);

        $validatedData = $request->validate([
            'empleadoid' => 'required|integer|exists:empleados,idEmpleados',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
            'tipoAusencias' => 'required|in:Vacaciones,Enfermedad,Licencia de maternidad/paternidad,Licencia no remunerada,Día libre,Otros',
            'observacionesAusencias' => 'nullable|string',
            'documentoAdjuntoAusencias' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $cruceFechas = Ausencias::where('empleadoid', $validatedData['empleadoid'])
            ->where('idAusencias', '!=', $idAusencias)
            ->where('estadoAusencias', '!=', 'Rechazado')
            ->where(function ($query) use ($validatedData) {
                $query->where('fechaInicio', '<=', $validatedData['fechaFin'])
                    ->where('fechaFin', '>=', $validatedData['fechaInicio']);
            })
            ->exists();

        if ($cruceFechas) {
            return redirect()->back()
                            ->withInput()
                            ->withErrors(['fechaInicio' => 'El empleado ya cuenta con otra ausencia registrada que se cruza con estas fechas.']);
        }

        if ($request->hasFile('documentoAdjuntoAusencias')) {
            $path = $request->file('documentoAdjuntoAusencias')->store('documentos', 's3');
            $validatedData['documentoAdjuntoAusencias'] = $path;
        }

        $ausencia->update($validatedData);

        return redirect()->route('ausencias.index')->with('success', 'Ausencia actualizada exitosamente.');
    }
    
    public function cambiarEstado(Request $request, $idAusencias)
    {
        $request->validate([
            'estadoAusencias' => 'required|in:Aprobado,Pendiente,Rechazado',
        ]);

        $ausencia = Ausencias::findOrFail($idAusencias);
        $ausencia->estadoAusencias = $request->estadoAusencias;
        $ausencia->save();

        return redirect()->route('ausencias.index')->with('success', 'Estado de ausencia actualizado a "' . $request->estadoAusencias . '" exitosamente.');
    }
}
