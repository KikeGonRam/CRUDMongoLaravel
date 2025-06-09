<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Valores Predeterminados de Autenticación
    |--------------------------------------------------------------------------
    |
    | Esta opción controla el "guard" (guardián) de autenticación predeterminado
    | y las opciones de restablecimiento de contraseña para tu aplicación. Puedes
    | cambiar estos valores predeterminados según sea necesario, pero son un
    | comienzo perfecto para la mayoría de las aplicaciones.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Guardianes de Autenticación (Authentication Guards)
    |--------------------------------------------------------------------------
    |
    | A continuación, puedes definir cada guardián de autenticación para tu aplicación.
    | Por supuesto, se ha definido una excelente configuración predeterminada para ti
    | aquí que utiliza almacenamiento de sesión y el proveedor de usuarios Eloquent.
    |
    | Todos los controladores de autenticación tienen un proveedor de usuarios. Esto define cómo
    | los usuarios son realmente recuperados de tu base de datos u otros mecanismos
    | de almacenamiento utilizados por esta aplicación para persistir los datos de tus usuarios.
    |
    | Soportado: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        // Aquí podrías añadir otros guards, por ejemplo, para API tokens:
        // 'api' => [
        //     'driver' => 'sanctum', // o 'token', 'jwt', etc.
        //     'provider' => 'users',
        //     // 'hash' => false, // Si usas tokens opacos de Sanctum
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Proveedores de Usuarios (User Providers)
    |--------------------------------------------------------------------------
    |
    | Todos los controladores de autenticación tienen un proveedor de usuarios. Esto define cómo
    | los usuarios son realmente recuperados de tu base de datos u otros mecanismos
    | de almacenamiento utilizados por esta aplicación para persistir los datos de tus usuarios.
    |
    | Si tienes múltiples tablas o modelos de usuarios, puedes configurar múltiples
    | fuentes que representen cada modelo/tabla. Estas fuentes pueden luego
    | ser asignadas a cualquier guardián de autenticación adicional que hayas definido.
    |
    | Soportado: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class, // Modelo User estándar de Laravel
        ],

        // Ejemplo de configuración para un proveedor de usuarios personalizado o adicional:
        // 'admins' => [
        //     'driver' => 'eloquent',
        //     'model' => App\Models\Admin::class, // Suponiendo que tienes un modelo Admin
        // ],

        // Ejemplo usando el driver 'database':
        // 'users_table' => [
        //     'driver' => 'database',
        //     'table' => 'users', // Nombre de la tabla de usuarios
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Restablecimiento de Contraseñas
    |--------------------------------------------------------------------------
    |
    | Puedes especificar múltiples configuraciones de restablecimiento de contraseña si tienes más
    | de una tabla o modelo de usuario en la aplicación y deseas tener
    | configuraciones de restablecimiento de contraseña separadas basadas en los tipos de usuario específicos.
    |
    | El tiempo de expiración es el número de minutos que cada token de restablecimiento
    | será considerado válido. Esta característica de seguridad mantiene los tokens
    | de corta duración para que tengan menos tiempo de ser adivinados. Puedes cambiar esto según sea necesario.
    |
    | La configuración de 'throttle' (limitación) es el número de segundos que un usuario debe esperar antes
    | de generar más tokens de restablecimiento de contraseña. Esto evita que el usuario
    | genere rápidamente una cantidad muy grande de tokens de restablecimiento de contraseña.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens', // Tabla para almacenar los tokens
            'expire' => 60, // Minutos para que expire el token
            'throttle' => 60, // Segundos de espera para reintentar la generación del token
        ],
        // Ejemplo para otro tipo de usuario (si existiera):
        // 'admins' => [
        //     'provider' => 'admins',
        //     'table' => 'admin_password_reset_tokens',
        //     'expire' => 30,
        //     'throttle' => 60,
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Tiempo de Espera para Confirmación de Contraseña
    |--------------------------------------------------------------------------
    |
    | Aquí puedes definir la cantidad de segundos antes de que una confirmación
    | de contraseña expire y se le solicite al usuario que vuelva a ingresar su
    | contraseña a través de la pantalla de confirmación. Por defecto, el tiempo de espera
    | dura tres horas (10800 segundos).
    |
    */

    'password_timeout' => 10800, // 3 horas en segundos

];
