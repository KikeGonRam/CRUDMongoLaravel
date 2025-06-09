<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// Se importa EloquentMongoModel, pero se usa Model en la clase.
// Debería ser EloquentMongoModel si es para MongoDB o Model si es para SQL.
// Asumiendo que es para MongoDB como los otros modelos del proyecto.
use MongoDB\Laravel\Eloquent\Model as EloquentMongoModel;

/**
 * Modelo Producto.
 *
 * Representa un producto en la colección 'productos' de la base de datos MongoDB.
 */
class Producto extends EloquentMongoModel // Confirmar si debe ser EloquentMongoModel o Model (de Illuminate\Database\Eloquent\Model)
{
    use HasFactory; // Trait para permitir la creación de factorías para este modelo.

    /**
     * La conexión de base de datos que debe ser utilizada por el modelo.
     * Especifica que este modelo se conecta a la instancia 'mongodb'.
     *
     * @var string
     */
    protected $connection = 'mongodb';

    /**
     * El nombre de la colección asociada con el modelo en MongoDB.
     *
     * @var string
     */
    protected $collection = 'productos';

    /**
     * Los atributos que son asignables masivamente.
     * Define qué campos pueden ser llenados a través de asignación masiva (ej. Producto::create([...])).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',       // Nombre del producto.
        'precio',       // Precio del producto.
        'descripcion',  // Descripción detallada del producto.
        'foto'          // Ruta o URL de la imagen del producto.
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     * Por ejemplo, convertir un string de fecha a un objeto Carbon.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'precio' => 'float', // Asegura que el precio se maneje como un número de punto flotante.
        'created_at' => 'datetime', // Convierte 'created_at' a objeto Carbon.
        'updated_at' => 'datetime', // Convierte 'updated_at' a objeto Carbon.
    ];

    // Ejemplo de cómo definir un accesor para la URL completa de la foto si 'foto' guarda solo la ruta relativa.
    // /**
    //  * Obtiene la URL completa de la foto del producto.
    //  *
    //  * @return string|null
    //  */
    // public function getFotoUrlAttribute(): ?string
    // {
    //     if ($this->foto && strpos($this->foto, 'http') !== 0 && $this->foto !== 'productos/default.png') {
    //         return \Illuminate\Support\Facades\Storage::disk('public')->url($this->foto);
    //     }
    //     // Si ya es una URL completa, o es la imagen por defecto (que podría estar en public directamente)
    //     return $this->foto === 'productos/default.png' ? asset('storage/productos/default.png') : $this->foto;
    // }
}
