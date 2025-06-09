<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carro;

class CarroController extends Controller
{
    public function index(Request $request)
    {
        $query = Carro::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('marca', 'like', "%{$search}%")
                ->orWhere('modelo', 'like', "%{$search}%");
        }

        $carros = $query->latest()->paginate(10);

        return view('carros.index', compact('carros'));
    }

    public function create()
    {
        return view('carros.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'marca' => 'required',
            'modelo' => 'required',
            'anio' => 'required|numeric',
            'precio' => 'required|numeric',
        ]);

        Carro::create($request->all());

        return redirect()->route('carros.index')->with('success', 'Carro creado correctamente.');
    }

    public function show($id)
    {
        $carro = Carro::findOrFail($id);
        return view('carros.show', compact('carro'));
    }

    public function edit($id)
    {
        $carro = Carro::findOrFail($id);
        return view('carros.edit', compact('carro'));
    }

    public function update(Request $request, $id)
    {
        $carro = Carro::findOrFail($id);
        $carro->update($request->all());

        return redirect()->route('carros.index')->with('success', 'Carro actualizado correctamente.');
    }

    public function destroy($id)
    {
        $carro = Carro::findOrFail($id);
        $carro->delete();

        return redirect()->route('carros.index')->with('success', 'Carro eliminado correctamente.');
    }
}
