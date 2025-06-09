<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Nombre de Conexión de Base de Datos Predeterminada
    |--------------------------------------------------------------------------
    |
    | Aquí puedes especificar cuál de las conexiones de base de datos de abajo deseas
    | utilizar como tu conexión predeterminada para todo el trabajo de base de datos.
    | Por supuesto, puedes utilizar muchas conexiones a la vez utilizando la biblioteca Database.
    |
    */

    'default' => env('DB_CONNECTION', 'mongodb'), // Cambiado a 'mongodb' para reflejar el proyecto

    /*
    |--------------------------------------------------------------------------
    | Conexiones de Base de Datos
    |--------------------------------------------------------------------------
    |
    | Aquí se configuran cada una de las conexiones de base de datos para tu aplicación.
    | Por supuesto, se muestran ejemplos de configuración de cada plataforma de base de datos
    | soportada por Laravel para simplificar el desarrollo.
    |
    |
    | Todo el trabajo de base de datos en Laravel se realiza a través de las facilidades PDO de PHP,
    | así que asegúrate de tener instalado el controlador para tu base de datos particular
    | en tu máquina antes de comenzar el desarrollo.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public', // Esquema de búsqueda para PostgreSQL
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            // 'encrypt' => env('DB_ENCRYPT', 'yes'), // Descomentar si se usa SQL Server con encriptación
            // 'trust_server_certificate' => env('DB_TRUST_SERVER_CERTIFICATE', 'false'), // Descomentar y ajustar según la configuración del servidor
        ],

        'mongodb' => [
            'driver' => 'mongodb',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', 27017), // Puerto numérico
            'database' => env('DB_DATABASE', 'homestead'), // Nombre de la base de datos
            'username' => env('DB_USERNAME', 'homestead'), // Usuario (si es necesario)
            'password' => env('DB_PASSWORD', 'secret'), // Contraseña (si es necesaria)
            // 'options' => [ // Opciones de conexión para MongoDB
                // 'database' => env('DB_AUTHENTICATION_DATABASE', 'admin'), // Requerido con Mongo 3+ si la autenticación no es en la misma DB
            // ],
            // Nota: La clave 'options' está duplicada abajo. Se comenta una para evitar confusión.
            // La configuración de autenticación usualmente va dentro de un único array 'options'.
            'prefix' => '', // Prefijo para colecciones (generalmente no se usa con MongoDB)
            'prefix_indexes' => true, // Si los prefijos deben aplicarse a los índices
             'options' => [ // Opciones de conexión para MongoDB
                 'database' => env('DB_AUTHENTICATION_DATABASE', null), // Base de datos para autenticación, si es diferente a 'database'
                                                                       // Usar 'null' o no definir si la autenticación es sobre la misma DB.
                                                                       // Requerido con ciertas configuraciones de Mongo 3+.
             ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Tabla del Repositorio de Migraciones
    |--------------------------------------------------------------------------
    |
    | Esta tabla realiza un seguimiento de todas las migraciones que ya se han ejecutado
    | para tu aplicación. Utilizando esta información, podemos determinar cuáles de
    | las migraciones en disco realmente no se han ejecutado en la base de datos.
    |
    */

    'migrations' => 'migrations', // Nombre de la tabla que almacena el historial de migraciones

    /*
    |--------------------------------------------------------------------------
    | Bases de Datos Redis
    |--------------------------------------------------------------------------
    |
    | Redis es un almacén de clave-valor avanzado, rápido y de código abierto que también
    | proporciona un conjunto de comandos más rico que un sistema típico de clave-valor
    | como APC o Memcached. Laravel facilita su uso inmediato.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'), // Cliente de Redis a utilizar ('phpredis' o 'predis')

        'options' => [
            // Opciones específicas del cliente, como el clúster o el prefijo.
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
        ],

        'default' => [
            // Conexión predeterminada de Redis, usada para caché, sesiones, colas, etc.
            'url' => env('REDIS_URL'), // URL de conexión (si se usa)
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'), // Nombre de usuario (para Redis 6 ACLs o similar)
            'password' => env('REDIS_PASSWORD'), // Contraseña
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'), // Número de la base de datos Redis (0-15)
        ],

        'cache' => [
            // Conexión de Redis específica para la caché de la aplicación.
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'), // Usar una base de datos diferente para la caché es una buena práctica
        ],

    ],

];
