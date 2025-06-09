<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Importar Log
use Illuminate\Support\Facades\Storage; // Importar Storage para posible eliminación de archivos

class ProductoController extends Controller
{
    /**
     * Muestra una lista de los productos.
     * Permite la búsqueda y ordenamiento de los productos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        try {
            $query = Producto::query();
            $search = $request->input('search'); // Obtener el término de búsqueda una vez

            // Búsqueda por nombre o descripción
            if ($search) { // Si hay un término de búsqueda
                $query->where(function ($q) use ($search) {
                    $q->where('nombre', 'like', "%{$search}%")
                      ->orWhere('descripcion', 'like', "%{$search}%");
                });
            }

            // Ordenamiento
            $sort = $request->input('sort', 'created_at'); // Columna por defecto para ordenar
            $direction = $request->input('direction', 'desc'); // Dirección por defecto
            $validSorts = ['nombre', 'precio', 'created_at']; // Columnas válidas para ordenar

            // Validar que la columna de ordenamiento sea una de las permitidas
            $sort = in_array($sort, $validSorts) ? $sort : 'created_at';
            // Validar que la dirección sea 'asc' o 'desc'
            $direction = in_array(strtolower($direction), ['asc', 'desc']) ? strtolower($direction) : 'desc';

            // Aplicar la paginación DESPUÉS de los filtros y ordenamiento
            // y añadir query string a la paginación para que los filtros/orden se mantengan
            $productos = $query->orderBy($sort, $direction)->paginate(10)->appends($request->query());

            // Pasar el término de búsqueda y los productos a la vista
            return view('productos.index', compact('productos', 'search'));
        } catch (\Exception $e) {
            Log::error('Error al obtener productos: ' . $e->getMessage());
            // Redirigir con un mensaje de error genérico para el usuario
            return redirect()->route('productos.index')->with('error', 'No se pudieron cargar los productos. Intente más tarde.');
        }
    }

    /**
     * Muestra el formulario para crear un nuevo producto.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Almacena un producto recién creado en la base de datos.
     * Maneja la carga de archivos para la foto del producto.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validación de los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string|max:1000',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Máximo 2MB
        ]);

        $data = $request->only(['nombre', 'precio', 'descripcion']);

        // Manejo de la carga del archivo de foto
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $file = $request->file('foto');
            // Almacenar en 'public/productos' y obtener la ruta
            $path = $file->store('productos', 'public');
            $data['foto'] = $path;
        } else {
            // Usar una imagen por defecto si no se sube ninguna o no es válida
            $data['foto'] = 'productos/default.png';
        }

        try {
            Producto::create($data); // Crear el producto con los datos preparados
        } catch (\Exception $e) {
            Log::error('Error al crear producto: ' . $e->getMessage());
            // Redirigir de vuelta al formulario de creación con un mensaje de error específico
            return redirect()->route('productos.create')
                             ->withInput() // Mantener los datos del formulario
                             ->with('error', 'No se pudo guardar el producto. Verifique los datos e intente de nuevo.');
        }

        return redirect()->route('productos.index')->with('success', 'Producto creado con éxito.');
    }

    /**
     * Muestra los detalles de un producto específico.
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $producto = Producto::findOrFail($id); // Lanza 404 si no se encuentra
        return view('productos.show', compact('producto'));
    }

    /**
     * Muestra el formulario para editar un producto existente.
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    /**
     * Actualiza un producto existente en la base de datos.
     * Maneja la carga de archivos si se proporciona una nueva foto.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string|max:1000',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['nombre', 'precio', 'descripcion']);

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            // Opcional: Eliminar la foto anterior si existe y no es la de por defecto
            if ($producto->foto && $producto->foto !== 'productos/default.png' && Storage::disk('public')->exists($producto->foto)) {
                Storage::disk('public')->delete($producto->foto);
            }
            $data['foto'] = $request->file('foto')->store('productos', 'public');
        } else {
            // Mantener la foto existente si no se sube una nueva.
            // Si $producto->foto es null o vacío, se podría asignar 'productos/default.png'
            $data['foto'] = $producto->foto ?? 'productos/default.png';
        }

        try {
            $producto->update($data); // Actualizar el producto con los datos preparados
        } catch (\Exception $e) {
            Log::error('Error al actualizar producto: ' . $e->getMessage());
            return redirect()->route('productos.edit', $id)
                             ->withInput()
                             ->with('error', 'No se pudo actualizar el producto. Verifique los datos e intente de nuevo.');
        }

        return redirect()->route('productos.index')->with('success', 'Producto actualizado con éxito.');
    }

    /**
     * Elimina un producto específico de la base de datos.
     * Opcionalmente, también elimina su foto asociada del almacenamiento.
     *
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);

        // Opcional: Eliminar la foto del almacenamiento si no es la de por defecto
        if ($producto->foto && $producto->foto !== 'productos/default.png' && Storage::disk('public')->exists($producto->foto)) {
            Storage::disk('public')->delete($producto->foto);
        }

        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado con éxito.');
    }
}
