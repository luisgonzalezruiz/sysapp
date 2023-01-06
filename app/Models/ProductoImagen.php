<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoImagen extends Model
{
    use HasFactory;
    protected $primaryKey  = 'id';
    protected $table = 'productos_imagen';

    protected $fillable = ['producto_id','url'];

    

}
