<?php

namespace App\Http\Controllers;

use App\Models\Usuario; // Asegúrate de que el modelo Usuario está importado
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Importar Log para el manejo de errores

class UsuarioController extends Controller
{
    /**
     * Muestra una lista de los usuarios.
     * Permite la búsqueda por nombre o correo electrónico.
     *
     * @param  \Illuminate\Http\Request  $request La solicitud HTTP actual.
     * @return \Illuminate\View\View La vista con la lista de usuarios.
     */
    public function index(Request $request)
    {
        // Inicia la construcción de la consulta para el modelo Usuario
        $query = Usuario::query();

        // Si se proporciona un término de búsqueda, filtra por 'nombre' o 'email'
        if ($search = $request->input('search')) {
            $query->where('nombre', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('apellido', 'like', "%{$search}%"); // Añadido apellido a la búsqueda
        }

        // Obtiene los usuarios, ordenados por los más recientes primero, y pagina los resultados.
        $usuarios = $query->latest()->paginate(10);

        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     *
     * @return \Illuminate\View\View La vista del formulario de creación.
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Almacena un usuario recién creado en la base de datos.
     * Valida los datos de entrada antes de la creación.
     *
     * @param  \Illuminate\Http\Request  $request La solicitud HTTP con los datos del usuario.
     * @return \Illuminate\Http\RedirectResponse Redirige al listado de usuarios con un mensaje de éxito.
     */
    public function store(Request $request)
    {
        // Validación de los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            // Asumiendo que el email debe ser único en la tabla 'usuarios'
            'email' => 'required|email|max:255|unique:usuarios,email',
            'telefono' => 'required|string|max:20', // Ajustar max según formato esperado
            'fecha_nacimiento' => 'required|date|before_or_equal:today',
            // Considerar añadir validación para contraseña si se maneja aquí
            // 'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            Usuario::create($request->all());
            return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al crear usuario: ' . $e->getMessage());
            return redirect()->route('usuarios.create')
                             ->withInput()
                             ->with('error', 'No se pudo crear el usuario. Por favor, verifique los datos.');
        }
    }

    /**
     * Muestra el formulario para editar un usuario existente.
     * Se utiliza Route Model Binding para inyectar la instancia de Usuario.
     *
     * @param  \App\Models\Usuario  $usuario La instancia del usuario a editar.
     * @return \Illuminate\View\View La vista del formulario de edición con los datos del usuario.
     */
    public function edit(Usuario $usuario) // Route Model Binding
    {
        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Actualiza un usuario existente en la base de datos.
     * Se utiliza Route Model Binding. Valida los datos antes de la actualización.
     *
     * @param  \Illuminate\Http\Request  $request La solicitud HTTP con los datos actualizados.
     * @param  \App\Models\Usuario  $usuario La instancia del usuario a actualizar.
     * @return \Illuminate\Http\RedirectResponse Redirige al listado de usuarios con un mensaje de éxito.
     */
    public function update(Request $request, Usuario $usuario) // Route Model Binding
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            // Validar unicidad del email, ignorando el email del usuario actual
            'email' => 'required|email|max:255|unique:usuarios,email,' . $usuario->_id . ',_id',
            'telefono' => 'required|string|max:20',
            'fecha_nacimiento' => 'required|date|before_or_equal:today',
        ]);

        try {
            $usuario->update($request->all());
            return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al actualizar usuario: ' . $e->getMessage());
            return redirect()->route('usuarios.edit', $usuario->_id)
                             ->withInput()
                             ->with('error', 'No se pudo actualizar el usuario. Por favor, verifique los datos.');
        }
    }

    /**
     * Elimina un usuario específico de la base de datos.
     * Se utiliza Route Model Binding.
     *
     * @param  \App\Models\Usuario  $usuario La instancia del usuario a eliminar.
     * @return \Illuminate\Http\RedirectResponse Redirige al listado de usuarios con un mensaje de éxito.
     */
    public function destroy(Usuario $usuario) // Route Model Binding
    {
        try {
            $usuario->delete();
            return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar usuario: ' . $e->getMessage());
            return redirect()->route('usuarios.index')->with('error', 'No se pudo eliminar el usuario.');
        }
    }

    /**
     * Muestra los detalles de un usuario específico.
     * Se utiliza Route Model Binding.
     *
     * @param  \App\Models\Usuario  $usuario La instancia del usuario a mostrar.
     * @return \Illuminate\View\View La vista con los detalles del usuario.
     */
    public function show(Usuario $usuario) // Route Model Binding
    {
        return view('usuarios.show', compact('usuario'));
    }
}
