<?php

namespace App\Http\Controllers;

use App\Models\Sucursales;
use Illuminate\Http\Request;

class SucursalesController extends Controller
{
    public function index()
    {
        $sucursales = Sucursales::orderBy('idSucursales', 'asc')->paginate(10);
        return view('sucursales.index', compact('sucursales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreSucursales' => 'required|string|max:150|unique:sucursales,nombreSucursales',
            'direccionSucursales' => 'required|string|max:150|unique:sucursales,direccionSucursales',
        ], [
            'nombreSucursales.required' => 'El nombre de la sucursal es obligatorio.',
            'nombreSucursales.unique'   => 'Ya existe una sucursal con ese nombre.',
            'nombreSucursales.max'      => 'El nombre no puede superar los 150 caracteres.',
            'direccionSucursales.required' => 'La dirección de la sucursal es obligatoria.',
            'direccionSucursales.unique'   => 'Ya existe una sucursal con esa dirección.',
            'direccionSucursales.max'      => 'La dirección no puede superar los 150 caracteres.',
        ]);

        Sucursales::create([
            'nombreSucursales' => $request->nombreSucursales,
            'direccionSucursales' => $request->direccionSucursales,
        ]);

        return redirect()->route('sucursales.index')->with('success', 'Sucursal creada exitosamente.');
    }

    public function update(Request $request, $idSucursales)
    {
        $sucursales = Sucursales::findOrFail($idSucursales);

        $request->validate([
            'nombreSucursales' => 'required|string|max:150|unique:sucursales,nombreSucursales,' . $idSucursales . ',idSucursales',
            'direccionSucursales' => 'required|string|max:150|unique:sucursales,direccionSucursales,' . $idSucursales . ',idSucursales',
        ], [
            'nombreSucursales.required' => 'El nombre de la sucursal es obligatorio.',
            'nombreSucursales.unique'   => 'Ya existe una sucursal con ese nombre.',
            'nombreSucursales.max'      => 'El nombre no puede superar los 150 caracteres.',
            'direccionSucursales.required' => 'La dirección de la sucursal es obligatoria.',
            'direccionSucursales.unique'   => 'Ya existe una sucursal con esa dirección.',
            'direccionSucursales.max'      => 'La dirección no puede superar los 150 caracteres.',
        ]);

        $sucursales->update([
            'nombreSucursales' => $request->nombreSucursales,
            'direccionSucursales' => $request->direccionSucursales,
        ]);

        return redirect()->route('sucursales.index')->with('success', 'Sucursal actualizada exitosamente.');
    }

    public function destroy($idSucursales)
    {
        $sucursales = Sucursales::findOrFail($idSucursales);
        $sucursales->delete();

        return redirect()->route('sucursales.index')->with('success', 'Sucursal eliminada exitosamente.');
    }
}
