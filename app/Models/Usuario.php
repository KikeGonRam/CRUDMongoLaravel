<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as EloquentMongoModel;

class Usuario extends EloquentMongoModel
{
    protected $connection = 'mongodb';
    protected $collection = 'usuarios';

    protected $fillable = ['nombre', 'apellido', 'email', 'telefono', 'fecha_nacimiento'];
}
