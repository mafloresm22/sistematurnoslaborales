<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index()
    {
        $categorias = Categorias::orderBy('idCategorias', 'asc')->paginate(10);
        return view('categorias.index', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreCategorias' => 'required|string|max:150|unique:categorias,nombreCategorias',
        ], [
            'nombreCategorias.required' => 'El nombre de la categoría es obligatorio.',
            'nombreCategorias.unique'   => 'Ya existe una categoría con ese nombre.',
            'nombreCategorias.max'      => 'El nombre no puede superar los 150 caracteres.',
        ]);

        Categorias::create([
            'nombreCategorias' => $request->nombreCategorias,
        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoría creada exitosamente.');
    }

    public function update(Request $request, $idCategorias)
    {
        $categoria = Categorias::findOrFail($idCategorias);

        $request->validate([
            'nombreCategorias' => 'required|string|max:150|unique:categorias,nombreCategorias,' . $idCategorias . ',idCategorias',
        ], [
            'nombreCategorias.required' => 'El nombre de la categoría es obligatorio.',
            'nombreCategorias.unique'   => 'Ya existe una categoría con ese nombre.',
            'nombreCategorias.max'      => 'El nombre no puede superar los 150 caracteres.',
        ]);

        $categoria->update([
            'nombreCategorias' => $request->nombreCategorias,
        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    public function destroy($idCategorias)
    {
        $categoria = Categorias::findOrFail($idCategorias);
        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}
