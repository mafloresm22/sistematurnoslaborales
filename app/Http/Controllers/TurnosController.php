<?php

namespace App\Http\Controllers;

use App\Models\Turnos;
use App\Models\Categorias;
use Illuminate\Http\Request;

class TurnosController extends Controller
{
    public function index()
    {
        $turnos = Turnos::orderBy('idTurno', 'asc')->paginate(9);
        $listaCategorias = Categorias::all();
        return view('turnos.index', compact('turnos', 'listaCategorias'));
    }

        public function store(Request $request)
    {
        $request->validate([
            'nombreTurnos' => 'required|string|max:150',
            'categoriaid'  => 'required|exists:categorias,idCategorias',
            'horaInicio'   => 'required|date_format:H:i',
            'horaFin'      => 'required|date_format:H:i',
            'colorFondo'   => 'required|string|max:10',
            'colorTexto'   => 'required|string|max:10',
        ], [
            'nombreTurnos.required' => 'El nombre del turno es obligatorio.',
            'categoriaid.required'  => 'Debe seleccionar una categoría.',
            'categoriaid.exists'    => 'La categoría seleccionada no es válida.',
            'horaInicio.required'   => 'La hora de inicio es requerida.',
            'horaFin.required'      => 'La hora de fin es requerida.',
        ]);

        $existeTurno = Turnos::where('horaInicio', $request->input('horaInicio'))
                             ->where('horaFin', $request->input('horaFin'))
                             ->where('categoriaid', $request->input('categoriaid'))
                             ->exists();

        if ($existeTurno) {
            return redirect()->back()
                             ->withInput()
                             ->withErrors(['horaInicio' => 'Ya existe un turno registrado con este mismo horario.']);
        }

        Turnos::create([
            'nombreTurnos' => $request->input('nombreTurnos'),
            'categoriaid'  => $request->input('categoriaid'),
            'horaInicio'   => $request->input('horaInicio'),
            'horaFin'      => $request->input('horaFin'),
            'colorFondo'   => $request->input('colorFondo'),
            'colorTexto'   => $request->input('colorTexto'),
        ]);

        return redirect()->route('turnos.index')
                         ->with('success', 'El turno se ha registrado correctamente.');
    }

    public function edit(Turnos $turnos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Turnos $turnos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Turnos $turnos)
    {
        //
    }
}
