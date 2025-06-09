<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
    {
    public function index(Request $request)
    {
        try {
            $query = Producto::query();

            // Búsqueda por nombre o descripción
            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where(function ($q) use ($search) {
                    $q->where('nombre', 'like', "%{$search}%")
                    ->orWhere('descripcion', 'like', "%{$search}%");
                });
            }

            // Ordenamiento
            $sort = $request->input('sort', 'created_at');
            $direction = $request->input('direction', 'desc');
            $validSorts = ['nombre', 'precio', 'created_at'];
            $sort = in_array($sort, $validSorts) ? $sort : 'created_at';

            $productos = $query->orderBy($sort, $direction)->paginate(10);

            return view('productos.index', compact('productos'));
        } catch (\Exception $e) {
            \Log::error('Error al obtener productos: ' . $e->getMessage());
            return redirect()->route('productos.index')->with('error', 'No se pudieron cargar los productos.');
        }
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable|string|max:1000',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['nombre', 'precio', 'descripcion']);

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $file = $request->file('foto');
            $path = $file->store('productos', 'public');
            $data['foto'] = $path;
        } else {
            $data['foto'] = 'productos/default.png'; // Usar .png para que coincida con la vista
        }

        try {
            Producto::create($data); // Usar $data en lugar de $request->all()
        } catch (\Exception $e) {
            \Log::error('Error al crear producto: ' . $e->getMessage());
            return redirect()->route('productos.create')->with('error', 'No se pudo guardar el producto: ' . $e->getMessage());
        }

        return redirect()->route('productos.index')->with('success', 'Producto creado con éxito.');
    }

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable|string|max:1000',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['nombre', 'precio', 'descripcion']);
        $producto = Producto::findOrFail($id);

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $data['foto'] = $request->file('foto')->store('productos', 'public');
        } else {
            $data['foto'] = $producto->foto ?? 'productos/default.png'; // Mantener la foto existente o usar default.png
        }

        try {
            $producto->update($data); // Usar $data en lugar de $request->all()
        } catch (\Exception $e) {
            \Log::error('Error al actualizar producto: ' . $e->getMessage());
            return redirect()->route('productos.edit', $id)->with('error', 'No se pudo actualizar el producto: ' . $e->getMessage());
        }

        return redirect()->route('productos.index')->with('success', 'Producto actualizado con éxito.');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado con éxito.');
    }
}
