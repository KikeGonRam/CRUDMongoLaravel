<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Disco de Sistema de Archivos Predeterminado
    |--------------------------------------------------------------------------
    |
    | Aquí puedes especificar el disco de sistema de archivos predeterminado que
    | debe ser utilizado por el framework. El disco "local", así como una
    | variedad de discos basados en la nube están disponibles para tu aplicación.
    | ¡Simplemente almacena!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'), // Disco predeterminado (local, public, s3, etc.)

    /*
    |--------------------------------------------------------------------------
    | Discos de Sistema de Archivos
    |--------------------------------------------------------------------------
    |
    | Aquí puedes configurar tantos "discos" de sistema de archivos como desees,
    | e incluso puedes configurar múltiples discos del mismo controlador. Se han
    | configurado valores predeterminados para cada controlador como ejemplo de los
    | valores requeridos.
    |
    | Controladores Soportados: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local', // Usar el almacenamiento local del servidor.
            'root' => storage_path('app'), // Directorio raíz dentro de `storage/app`.
                                           // Los archivos aquí generalmente no son accesibles públicamente.
            'throw' => false, // Si se deben lanzar excepciones en caso de error.
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'), // Directorio raíz para archivos públicos.
                                                 // Debes ejecutar `php artisan storage:link` para hacerlos accesibles desde la web.
            'url' => env('APP_URL').'/storage', // URL base para acceder a estos archivos.
            'visibility' => 'public', // Visibilidad predeterminada para los archivos almacenados en este disco.
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3', // Para almacenar archivos en Amazon S3.
            'key' => env('AWS_ACCESS_KEY_ID'), // Clave de acceso de AWS.
            'secret' => env('AWS_SECRET_ACCESS_KEY'), // Clave secreta de AWS.
            'region' => env('AWS_DEFAULT_REGION'), // Región de AWS (ej. 'us-east-1').
            'bucket' => env('AWS_BUCKET'), // Nombre del bucket de S3.
            'url' => env('AWS_URL'), // URL personalizada para S3 (opcional).
            'endpoint' => env('AWS_ENDPOINT'), // Endpoint personalizado para S3 (ej. para MinIO).
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false), // Usar estilo de endpoint de ruta (útil para MinIO).
            'throw' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Enlaces Simbólicos
    |--------------------------------------------------------------------------
    |
    | Aquí puedes configurar los enlaces simbólicos que serán creados cuando
    | se ejecute el comando Artisan `storage:link`. Las claves del array deben ser
    | las ubicaciones de los enlaces y los valores deben ser sus destinos.
    |
    */

    'links' => [
        // Por defecto, `public/storage` enlaza a `storage/app/public`.
        public_path('storage') => storage_path('app/public'),
        // Puedes añadir más enlaces simbólicos aquí si es necesario.
        // Ejemplo: public_path('avatars') => storage_path('app/avatars'),
    ],

];
