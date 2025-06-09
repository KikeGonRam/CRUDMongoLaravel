<?php

use Illuminate\Support\Facades\Facade;

return [

    /*
    |--------------------------------------------------------------------------
    | Nombre de la Aplicación
    |--------------------------------------------------------------------------
    |
    | Este valor es el nombre de tu aplicación. Este valor se utiliza cuando
    | el framework necesita colocar el nombre de la aplicación en una notificación
    | o en cualquier otro lugar según lo requiera la aplicación o sus paquetes.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Entorno de la Aplicación
    |--------------------------------------------------------------------------
    |
    | Este valor determina el "entorno" en el que tu aplicación está
    | actualmente en ejecución. Esto puede determinar cómo prefieres configurar
    | varios servicios que la aplicación utiliza. Configura esto en tu archivo ".env".
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Modo de Depuración de la Aplicación
    |--------------------------------------------------------------------------
    |
    | Cuando tu aplicación está en modo de depuración, se mostrarán mensajes
    | de error detallados con seguimientos de pila en cada error que ocurra
    | dentro de tu aplicación. Si está deshabilitado, se muestra una página
    | de error genérica simple.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | URL de la Aplicación
    |--------------------------------------------------------------------------
    |
    | Esta URL es utilizada por la consola para generar correctamente URLs cuando
    | se utiliza la herramienta de línea de comandos Artisan. Debes configurar esto
    | a la raíz de tu aplicación para que se utilice al ejecutar tareas de Artisan.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL', '/'),

    /*
    |--------------------------------------------------------------------------
    | Zona Horaria de la Aplicación
    |--------------------------------------------------------------------------
    |
    | Aquí puedes especificar la zona horaria predeterminada para tu aplicación,
    | que será utilizada por las funciones de fecha y fecha-hora de PHP.
    | Ya hemos configurado esto con un valor predeterminado sensible para ti.
    |
    */

    'timezone' => 'UTC', // Ejemplo: 'America/Mexico_City'

    /*
    |--------------------------------------------------------------------------
    | Configuración Regional de la Aplicación (Locale)
    |--------------------------------------------------------------------------
    |
    | El locale de la aplicación determina el idioma predeterminado que será
    | utilizado por el proveedor de servicios de traducción. Eres libre de
    | configurar este valor a cualquiera de los locales que serán
    | soportados por la aplicación.
    |
    */

    'locale' => 'es', // Cambiado de 'en' a 'es' como ejemplo para una app en español

    /*
    |--------------------------------------------------------------------------
    | Locale de Respaldo de la Aplicación (Fallback Locale)
    |--------------------------------------------------------------------------
    |
    | El locale de respaldo determina el idioma a utilizar cuando el actual
    | no está disponible. Puedes cambiar el valor para que corresponda a
    | cualquiera de las carpetas de idioma que se proporcionan a través de tu aplicación.
    |
    */

    'fallback_locale' => 'es', // Cambiado de 'en' a 'es'

    /*
    |--------------------------------------------------------------------------
    | Locale de Faker
    |--------------------------------------------------------------------------
    |
    | Este locale será utilizado por la biblioteca Faker PHP al generar datos
    | falsos para tus sembradores (seeds) de base de datos. Por ejemplo, esto se
    | utilizará para obtener números de teléfono localizados, información de
    | direcciones de calles y más.
    |
    */

    'faker_locale' => 'es_MX', // Cambiado de 'en_US' a 'es_MX' para datos de prueba en español de México

    /*
    |--------------------------------------------------------------------------
    | Clave de Cifrado
    |--------------------------------------------------------------------------
    |
    | Esta clave es utilizada por el servicio de cifrado Illuminate y debe ser
    | configurada a una cadena aleatoria de 32 caracteres, de lo contrario estas
    | cadenas cifradas no serán seguras. ¡Por favor, haz esto antes de
    | desplegar una aplicación!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Controlador del Modo de Mantenimiento
    |--------------------------------------------------------------------------
    |
    | Estas opciones de configuración determinan el controlador utilizado para
    | determinar y gestionar el estado del "modo de mantenimiento" de Laravel.
    | El controlador "cache" permitirá controlar el modo de mantenimiento
    | en múltiples máquinas.
    |
    | Controladores soportados: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => 'file',
        // 'store'  => 'redis', // Ejemplo si se usa 'cache' con Redis
    ],

    /*
    |--------------------------------------------------------------------------
    | Proveedores de Servicios Autocargados
    |--------------------------------------------------------------------------
    |
    | Los proveedores de servicios listados aquí serán cargados automáticamente
    | en la solicitud a tu aplicación. Siéntete libre de agregar tus propios
    | servicios a este array para otorgar funcionalidad expandida a tus aplicaciones.
    |
    */

    'providers' => [

        /*
         * Proveedores de Servicios del Framework Laravel...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Proveedores de Servicios de Paquetes...
         * Aquí se registran los proveedores de servicios de paquetes de terceros.
         */

        /*
         * Proveedores de Servicios de la Aplicación...
         * Aquí se registran los proveedores de servicios específicos de tu aplicación.
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class, // Descomentar si se utiliza broadcasting
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Alias de Clases
    |--------------------------------------------------------------------------
    |
    | Este array de alias de clases será registrado cuando esta aplicación
    | sea iniciada. Sin embargo, siéntete libre de registrar tantos como desees
    | ya que los alias son cargados de forma "perezosa" (lazy loaded) para no afectar el rendimiento.
    |
    */

    'aliases' => Facade::defaultAliases()->merge([
        // 'EjemploClase' => App\Ejemplo\EjemploClase::class, // Ejemplo de un alias
    ])->toArray(),

];
