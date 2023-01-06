<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $primaryKey  = 'proveedor_id';
    protected $table = 'proveedores';

    //protected $fillable = ['nombres','apellidos','ruc','direccion','telefonos','email'];

}
