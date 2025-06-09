<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carro; // Asegúrate de que el modelo Carro está importado

class CarroController extends Controller
{
    /**
     * Muestra una lista del recurso (carros).
     * Permite la búsqueda por marca o modelo y pagina los resultados.
     *
     * @param  \Illuminate\Http\Request  $request La solicitud HTTP actual.
     * @return \Illuminate\View\View La vista con la lista de carros.
     */
    public function index(Request $request)
    {
        // Inicia la construcción de la consulta para el modelo Carro
        $query = Carro::query();

        // Si se proporciona un término de búsqueda en la solicitud, filtra los resultados.
        // Busca coincidencias parciales en los campos 'marca' o 'modelo'.
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('marca', 'like', "%{$search}%")
                  ->orWhere('modelo', 'like', "%{$search}%");
        }

        // Obtiene los carros, ordenados por los más recientes primero, y pagina los resultados (10 por página).
        $carros = $query->latest()->paginate(10);

        // Devuelve la vista 'carros.index' y pasa la colección de carros.
        return view('carros.index', compact('carros'));
    }

    /**
     * Muestra el formulario para crear un nuevo carro.
     *
     * @return \Illuminate\View\View La vista del formulario de creación.
     */
    public function create()
    {
        // Devuelve la vista 'carros.create' que contiene el formulario.
        return view('carros.create');
    }

    /**
     * Almacena un carro recién creado en la base de datos.
     * Valida los datos de entrada antes de la creación.
     *
     * @param  \Illuminate\Http\Request  $request La solicitud HTTP con los datos del carro.
     * @return \Illuminate\Http\RedirectResponse Redirige al listado de carros con un mensaje de éxito.
     */
    public function store(Request $request)
    {
        // Valida los datos de la solicitud.
        // 'marca', 'modelo', 'anio', 'precio' son campos obligatorios.
        // 'anio' y 'precio' deben ser numéricos.
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'anio' => 'required|integer|min:1900|max:' . (date('Y') + 1), // Año entre 1900 y el próximo año
            'precio' => 'required|numeric|min:0',
        ]);

        // Crea un nuevo registro de Carro con todos los datos validados de la solicitud.
        Carro::create($request->all());

        // Redirige a la ruta 'carros.index' con un mensaje flash de éxito.
        return redirect()->route('carros.index')->with('success', 'Carro creado correctamente.');
    }

    /**
     * Muestra los detalles de un carro específico.
     *
     * @param  string  $id El ID del carro a mostrar.
     * @return \Illuminate\View\View La vista con los detalles del carro.
     */
    public function show($id)
    {
        // Encuentra el carro por su ID; si no se encuentra, lanza una excepción ModelNotFoundException (404).
        $carro = Carro::findOrFail($id);
        // Devuelve la vista 'carros.show' y pasa el carro encontrado.
        return view('carros.show', compact('carro'));
    }

    /**
     * Muestra el formulario para editar un carro existente.
     *
     * @param  string  $id El ID del carro a editar.
     * @return \Illuminate\View\View La vista del formulario de edición con los datos del carro.
     */
    public function edit($id)
    {
        // Encuentra el carro por su ID.
        $carro = Carro::findOrFail($id);
        // Devuelve la vista 'carros.edit' y pasa el carro encontrado.
        return view('carros.edit', compact('carro'));
    }

    /**
     * Actualiza un carro existente en la base de datos.
     * Valida los datos de entrada antes de la actualización.
     *
     * @param  \Illuminate\Http\Request  $request La solicitud HTTP con los datos actualizados.
     * @param  string  $id El ID del carro a actualizar.
     * @return \Illuminate\Http\RedirectResponse Redirige al listado de carros con un mensaje de éxito.
     */
    public function update(Request $request, $id)
    {
        // Encuentra el carro por su ID.
        $carro = Carro::findOrFail($id);

        // Valida los datos de la solicitud (similar a store).
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'anio' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'precio' => 'required|numeric|min:0',
        ]);

        // Actualiza el carro con todos los datos validados de la solicitud.
        $carro->update($request->all());

        // Redirige a la ruta 'carros.index' con un mensaje flash de éxito.
        return redirect()->route('carros.index')->with('success', 'Carro actualizado correctamente.');
    }

    /**
     * Elimina un carro específico de la base de datos.
     *
     * @param  string  $id El ID del carro a eliminar.
     * @return \Illuminate\Http\RedirectResponse Redirige al listado de carros con un mensaje de éxito.
     */
    public function destroy($id)
    {
        // Encuentra el carro por su ID.
        $carro = Carro::findOrFail($id);
        // Elimina el carro de la base de datos.
        $carro->delete();

        // Redirige a la ruta 'carros.index' con un mensaje flash de éxito.
        return redirect()->route('carros.index')->with('success', 'Carro eliminado correctamente.');
    }
}
