<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model as EloquentMongoModel;

class Producto extends EloquentMongoModel
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'productos';

    protected $fillable = ['nombre', 'precio', 'descripcion', 'foto'];
}
