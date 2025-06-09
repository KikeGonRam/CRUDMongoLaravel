<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Controlador Base.
 * Esta clase sirve como controlador base para todos los demás controladores de la aplicación.
 * Proporciona acceso a traits útiles como AuthorizesRequests y ValidatesRequests.
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // Este es el controlador base.
    // Proporciona funcionalidades comunes como la autorización de solicitudes y la validación.
    // Los otros controladores en la aplicación deben extender esta clase para heredar estas capacidades.
}
