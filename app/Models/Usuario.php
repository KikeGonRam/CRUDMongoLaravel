<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as EloquentMongoModel;
// Considerar si este modelo debe implementar alguna interfaz de autenticación si se usa para login,
// o si interactúa con el modelo User.php de Laravel.
// use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
// use Illuminate\Auth\Authenticatable; // Trait

/**
 * Modelo Usuario.
 *
 * Representa un usuario de la aplicación en la colección 'usuarios' de MongoDB.
 * Este modelo es distinto del modelo User.php predeterminado de Laravel y se utiliza
 * para la lógica de negocio específica de la aplicación relacionada con los usuarios.
 */
class Usuario extends EloquentMongoModel // Implementar AuthenticatableContract si es necesario
{
    // use Authenticatable; // Usar trait si se implementa AuthenticatableContract

    /**
     * La conexión de base de datos que debe ser utilizada por el modelo.
     *
     * @var string
     */
    protected $connection = 'mongodb';

    /**
     * El nombre de la colección asociada con el modelo en MongoDB.
     *
     * @var string
     */
    protected $collection = 'usuarios';

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',           // Nombre del usuario.
        'apellido',         // Apellido del usuario.
        'email',            // Dirección de correo electrónico del usuario (considerar validación de unicidad).
        'telefono',         // Número de teléfono del usuario.
        'fecha_nacimiento'  // Fecha de nacimiento del usuario.
        // Si este modelo maneja contraseñas, el campo 'password' debería estar aquí y en $hidden.
        // 'password',
    ];

    /**
     * Los atributos que deben ocultarse durante la serialización.
     * Útil para información sensible como contraseñas.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    // 'password', // Descomentar si se añade un campo de contraseña.
    // ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_nacimiento' => 'date', // Convertir a objeto Carbon o similar (depende de la configuración de MongoDB driver).
                                      // Para MongoDB, a veces se usa 'datetime' o se maneja la conversión manualmente
                                      // si el formato almacenado no es estándar ISO8601.
                                      // 'date' asume 'Y-m-d'. Si incluye hora, usar 'datetime'.
        'email_verified_at' => 'datetime', // Ejemplo si se añade verificación de email.
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Aquí se pueden definir relaciones, como por ejemplo, si un usuario tiene carros:
    // public function carros()
    // {
    //     return $this->hasMany(Carro::class, 'usuario_id', '_id'); // Asumiendo que Carro tiene usuario_id
    // }
}
