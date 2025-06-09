<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Mailer Predeterminado (Default Mailer)
    |--------------------------------------------------------------------------
    |
    | Esta opción controla el mailer predeterminado que se utiliza para enviar
    | cualquier mensaje de correo electrónico enviado por tu aplicación. Se pueden
    | configurar y utilizar mailers alternativos según sea necesario; sin embargo,
    | este mailer se utilizará de forma predeterminada.
    |
    */

    'default' => env('MAIL_MAILER', 'smtp'), // Mailer a usar: smtp, sendmail, log, etc.

    /*
    |--------------------------------------------------------------------------
    | Configuraciones de Mailer
    |--------------------------------------------------------------------------
    |
    | Aquí puedes configurar todos los mailers utilizados por tu aplicación además
    | de sus respectivas configuraciones. Se han configurado varios ejemplos para
    | ti y eres libre de agregar los tuyos propios según lo requiera tu aplicación.
    |
    | Laravel soporta una variedad de controladores de "transporte" de correo para ser
    | utilizados al enviar un correo electrónico. Especificarás cuál estás utilizando
    | para tus mailers a continuación. Eres libre de agregar mailers adicionales según sea necesario.
    |
    | Soportados: "smtp", "sendmail", "mailgun", "ses",
    |            "postmark", "log", "array", "failover"
    |
    */

    'mailers' => [
        'smtp' => [
            'transport' => 'smtp', // Protocolo de transporte.
            'host' => env('MAIL_HOST', 'smtp.mailgun.org'), // Host del servidor SMTP.
            'port' => env('MAIL_PORT', 587), // Puerto SMTP (587 para TLS, 465 para SSL).
            'encryption' => env('MAIL_ENCRYPTION', 'tls'), // Encriptación (tls, ssl, o null).
            'username' => env('MAIL_USERNAME'), // Nombre de usuario SMTP.
            'password' => env('MAIL_PASSWORD'), // Contraseña SMTP.
            'timeout' => null, // Tiempo de espera en segundos para la conexión SMTP.
            'local_domain' => env('MAIL_EHLO_DOMAIN'), // Nombre de dominio para el comando EHLO/HELO (opcional).
        ],

        'ses' => [
            'transport' => 'ses', // Para Amazon SES (Simple Email Service).
                                  // Requiere configuración adicional de AWS SDK.
        ],

        'mailgun' => [
            'transport' => 'mailgun', // Para Mailgun.
                                      // Requiere configurar las credenciales de Mailgun en services.php o .env.
            // 'client' => [ // Configuración opcional del cliente HTTP.
            //     'timeout' => 5,
            // ],
        ],

        'postmark' => [
            'transport' => 'postmark', // Para Postmark.
                                       // Requiere configurar el token de Postmark.
            // 'client' => [ // Configuración opcional del cliente HTTP.
            //     'timeout' => 5,
            // ],
        ],

        'sendmail' => [
            'transport' => 'sendmail', // Para usar el comando sendmail del servidor.
            'path' => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs -i'), // Ruta al ejecutable de sendmail.
        ],

        'log' => [
            'transport' => 'log', // Escribe los correos en los archivos de log en lugar de enviarlos.
                                  // Útil para desarrollo y pruebas.
            'channel' => env('MAIL_LOG_CHANNEL'), // Canal de log a utilizar (definido en logging.php).
        ],

        'array' => [
            'transport' => 'array', // "Envía" los correos a un array en memoria. Útil para pruebas.
        ],

        'failover' => [
            'transport' => 'failover', // Permite definir una lista de mailers de respaldo.
                                       // Intentará enviar con cada uno en orden hasta que uno tenga éxito.
            'mailers' => [
                'smtp', // Primero intenta con smtp.
                'log',  // Si smtp falla, usa log.
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Dirección Global "From" (Remitente)
    |--------------------------------------------------------------------------
    |
    | Es posible que desees que todos los correos electrónicos enviados por tu aplicación
    | se envíen desde la misma dirección. Aquí, puedes especificar un nombre y una
    | dirección que se utiliza globalmente para todos los correos electrónicos que son
    | enviados por tu aplicación.
    |
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hola@example.com'), // Dirección de correo del remitente.
        'name' => env('MAIL_FROM_NAME', 'Ejemplo Laravel'), // Nombre del remitente.
    ],

    /*
    |--------------------------------------------------------------------------
    | Configuración de Correo Markdown
    |--------------------------------------------------------------------------
    |
    | Si estás utilizando la renderización de correo basada en Markdown, puedes
    | configurar tus rutas de tema y componentes aquí, lo que te permite
    | personalizar el diseño de los correos electrónicos. O, ¡simplemente puedes
    | apegarte a los valores predeterminados de Laravel!
    |
    */

    'markdown' => [
        'theme' => 'default', // Tema de Markdown a utilizar (ej. 'default', o uno personalizado).

        'paths' => [
            // Rutas donde buscar componentes de correo Markdown.
            resource_path('views/vendor/mail'),
        ],
    ],

];
