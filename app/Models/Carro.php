<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as EloquentMongoModel;

class Carro extends EloquentMongoModel
{
    protected $connection = 'mongodb';
    protected $collection = 'carros';

    protected $fillable = ['marca', 'modelo', 'anio', 'precio'];
}
