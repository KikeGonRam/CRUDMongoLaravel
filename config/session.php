<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Controlador de Sesión Predeterminado (Default Session Driver)
    |--------------------------------------------------------------------------
    |
    | Esta opción controla el "controlador" de sesión predeterminado que se
    | utilizará en las solicitudes. Por defecto, utilizaremos el controlador
    | nativo ligero, pero puedes especificar cualquiera de los otros
    | maravillosos controladores proporcionados aquí.
    |
    | Soportados: "file", "cookie", "database", "apc",
    |            "memcached", "redis", "dynamodb", "array"
    |
    */

    'driver' => env('SESSION_DRIVER', 'file'), // Controlador: file, cookie, database, redis, etc.

    /*
    |--------------------------------------------------------------------------
    | Duración de la Sesión (Session Lifetime)
    |--------------------------------------------------------------------------
    |
    | Aquí puedes especificar el número de minutos que deseas que la sesión
    | pueda permanecer inactiva antes de que expire. Si deseas que expiren
    | inmediatamente al cerrar el navegador, configura esa opción.
    |
    */

    'lifetime' => env('SESSION_LIFETIME', 120), // Duración en minutos.

    'expire_on_close' => false, // true para expirar la sesión cuando se cierra el navegador.

    /*
    |--------------------------------------------------------------------------
    | Cifrado de Sesión (Session Encryption)
    |--------------------------------------------------------------------------
    |
    | Esta opción te permite especificar fácilmente que todos los datos de tu
    | sesión deben ser cifrados antes de ser almacenados. Todo el cifrado
    | se ejecutará automáticamente por Laravel y puedes usar la Sesión
    | como de costumbre.
    |
    */

    'encrypt' => false, // true para cifrar los datos de la sesión.

    /*
    |--------------------------------------------------------------------------
    | Ubicación de Archivos de Sesión (Session File Location)
    |--------------------------------------------------------------------------
    |
    | Cuando se utiliza el controlador de sesión nativo ("file"), necesitamos una
    | ubicación donde se puedan almacenar los archivos de sesión. Se ha establecido
    | una predeterminada para ti, pero se puede especificar una ubicación diferente.
    | Esto solo es necesario para las sesiones de archivo.
    |
    */

    'files' => storage_path('framework/sessions'), // Ruta donde se guardan los archivos de sesión.

    /*
    |--------------------------------------------------------------------------
    | Conexión de Base de Datos de Sesión (Session Database Connection)
    |--------------------------------------------------------------------------
    |
    | Cuando se utilizan los controladores de sesión "database" o "redis", puedes
    | especificar una conexión que debe usarse para administrar estas sesiones.
    | Esto debe corresponder a una conexión en tus opciones de configuración
    | de base de datos.
    |
    */

    'connection' => env('SESSION_CONNECTION'), // Nombre de la conexión de BD/Redis (null para usar la predeterminada).

    /*
    |--------------------------------------------------------------------------
    | Tabla de Base de Datos de Sesión (Session Database Table)
    |--------------------------------------------------------------------------
    |
    | Cuando se utiliza el controlador de sesión "database", puedes especificar la
    | tabla que debemos usar para administrar las sesiones. Por supuesto, se
    | proporciona un valor predeterminado sensible para ti; sin embargo, eres
    | libre de cambiar esto según sea necesario.
    |
    */

    'table' => 'sessions', // Nombre de la tabla para el controlador "database".

    /*
    |--------------------------------------------------------------------------
    | Almacén de Caché de Sesión (Session Cache Store)
    |--------------------------------------------------------------------------
    |
    | Mientras utilizas uno de los backends de sesión controlados por caché del
    | framework, puedes listar un almacén de caché que debe usarse para estas
    | sesiones. Este valor debe coincidir con uno de los "almacenes" de caché
    | configurados de la aplicación.
    |
    | Afecta a: "apc", "dynamodb", "memcached", "redis"
    |
    */

    'store' => env('SESSION_STORE'), // Nombre del almacén de caché a usar (ej. 'redis', 'memcached').

    /*
    |--------------------------------------------------------------------------
    | Lotería de Limpieza de Sesiones (Session Sweeping Lottery)
    |--------------------------------------------------------------------------
    |
    | Algunos controladores de sesión deben barrer manualmente su ubicación de
    | almacenamiento para deshacerse de las sesiones antiguas. Aquí están las
    | probabilidades de que suceda en una solicitud dada. Por defecto, las
    | probabilidades son de 2 sobre 100.
    |
    */

    'lottery' => [2, 100], // Probabilidad [numerador, denominador] para la recolección de basura de sesiones.

    /*
    |--------------------------------------------------------------------------
    | Nombre de la Cookie de Sesión (Session Cookie Name)
    |--------------------------------------------------------------------------
    |
    | Aquí puedes cambiar el nombre de la cookie utilizada para identificar una
    | instancia de sesión por ID. El nombre especificado aquí se usará cada vez
    | que el framework cree una nueva cookie de sesión para cada controlador.
    |
    */

    'cookie' => env(
        'SESSION_COOKIE',
        // Genera un nombre de cookie basado en el nombre de la app, reemplazando espacios con guiones bajos.
        Str::slug(env('APP_NAME', 'laravel'), '_').'_session'
    ),

    /*
    |--------------------------------------------------------------------------
    | Ruta de la Cookie de Sesión (Session Cookie Path)
    |--------------------------------------------------------------------------
    |
    | La ruta de la cookie de sesión determina la ruta para la cual la cookie
    | se considerará disponible. Normalmente, esta será la ruta raíz de
    | tu aplicación, pero eres libre de cambiar esto cuando sea necesario.
    |
    */

    'path' => '/', // Ruta para la cookie de sesión (generalmente '/' para todo el sitio).

    /*
    |--------------------------------------------------------------------------
    | Dominio de la Cookie de Sesión (Session Cookie Domain)
    |--------------------------------------------------------------------------
    |
    | Aquí puedes cambiar el dominio de la cookie utilizada para identificar una
    | sesión en tu aplicación. Esto determinará a qué dominios estará
    | disponible la cookie en tu aplicación. Se ha establecido un valor
    | predeterminado sensible.
    |
    */

    'domain' => env('SESSION_DOMAIN'), // Dominio para la cookie (ej. '.example.com' para subdominios).

    /*
    |--------------------------------------------------------------------------
    | Cookies Solo HTTPS (HTTPS Only Cookies)
    |--------------------------------------------------------------------------
    |
    | Al configurar esta opción en true, las cookies de sesión solo se enviarán
    | de vuelta al servidor si el navegador tiene una conexión HTTPS. Esto
    | evitará que la cookie se te envíe cuando no se pueda hacer de forma segura.
    |
    */

    'secure' => env('SESSION_SECURE_COOKIE'), // true para enviar cookies solo sobre HTTPS.

    /*
    |--------------------------------------------------------------------------
    | Solo Acceso HTTP (HTTP Access Only)
    |--------------------------------------------------------------------------
    |
    | Configurar este valor en true evitará que JavaScript acceda al valor
    | de la cookie y la cookie solo será accesible a través del protocolo HTTP.
    | Eres libre de modificar esta opción si es necesario.
    |
    */

    'http_only' => true, // true para restringir el acceso a la cookie solo a HTTP (no JavaScript).

    /*
    |--------------------------------------------------------------------------
    | Cookies Same-Site
    |--------------------------------------------------------------------------
    |
    | Esta opción determina cómo se comportan tus cookies cuando tienen lugar
    | solicitudes entre sitios, y se puede utilizar para mitigar ataques CSRF.
    | Por defecto, estableceremos este valor en "lax", ya que es un valor
    | predeterminado seguro.
    |
    | Soportados: "lax", "strict", "none", null
    |
    */

    'same_site' => 'lax', // Configuración SameSite para cookies ('lax', 'strict', 'none').

];
