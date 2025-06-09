<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as EloquentMongoModel;

/**
 * Modelo Carro.
 *
 * Representa un carro en la colección 'carros' de la base de datos MongoDB.
 * Utiliza el driver MongoDB para Laravel.
 */
class Carro extends EloquentMongoModel
{
    /**
     * La conexión de base de datos que debe ser utilizada por el modelo.
     *
     * @var string
     */
    protected $connection = 'mongodb';

    /**
     * El nombre de la colección asociada con el modelo.
     *
     * @var string
     */
    protected $collection = 'carros';

    /**
     * Los atributos que se pueden asignar masivamente.
     * Estos son los campos que se pueden llenar usando métodos como `create()` o `update()`.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'marca',        // Ejemplo: Toyota, Ford, Honda
        'modelo',       // Ejemplo: Corolla, Mustang, Civic
        'anio',         // Ejemplo: 2023
        'precio'        // Ejemplo: 25000.50
    ];

    // Aquí se podrían añadir relaciones, accessors, mutators, etc. si fueran necesarios.
    // Por ejemplo:
    // public function propietario() {
    //     return $this->belongsTo(Usuario::class, 'usuario_id');
    // }
}
