<?php

namespace App\Models;

// Descomentar la siguiente línea si se requiere que los usuarios verifiquen su correo electrónico.
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Modelo User.
 *
 * Representa un usuario en el sistema, comúnmente utilizado para la autenticación.
 * Este modelo es el predeterminado de Laravel para la gestión de usuarios y
 * utiliza el sistema de autenticación de Laravel (Authenticatable).
 */
class User extends Authenticatable // Si se usa MustVerifyEmail, sería: class User extends Authenticatable implements MustVerifyEmail
{
    // Traits utilizados por el modelo:
    // HasApiTokens: Para la autenticación basada en tokens API (Sanctum).
    // HasFactory: Para permitir la creación de factorías para este modelo.
    // Notifiable: Para permitir que el modelo envíe notificaciones.
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Los atributos que son asignables masivamente.
     *
     * Define qué campos pueden ser llenados mediante asignación masiva
     * (por ejemplo, al usar `User::create([...])`).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',         // Nombre del usuario.
        'email',        // Dirección de correo electrónico del usuario (debe ser única).
        'password',     // Contraseña del usuario (se almacena hasheada).
    ];

    /**
     * Los atributos que deben ocultarse durante la serialización.
     *
     * Estos atributos no se incluirán cuando el modelo se convierta a un array o JSON,
     * lo cual es útil para proteger información sensible como contraseñas.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',         // La contraseña del usuario.
        'remember_token',   // Token utilizado para la funcionalidad "recordarme".
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * Esto permite que ciertos atributos se conviertan automáticamente a un tipo de dato específico
     * cuando se accede a ellos (por ejemplo, 'email_verified_at' a un objeto Carbon).
     *
     * @var array<string, string>
     */
    protected $casts = [
        // Convierte el atributo 'email_verified_at' a una instancia de Carbon (objeto de fecha/hora).
        'email_verified_at' => 'datetime',
        // Se podría añadir 'password' => 'hashed' si se usa Laravel 9+ para el hasheo automático,
        // aunque el hasheo usualmente se maneja en el `AuthController` o al definir el mutator.
        // 'password' => 'hashed', (Asegurarse de que el hasheo se maneje correctamente en la lógica de registro/actualización)
    ];
}
