<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $primaryKey  = 'prov_codigo';

    // tener en cuenta que estamo apuntando a una vista que esta vinculado
    // al servidor principal
    protected $table = 'v_proveedores_master';

    //protected $fillable = ['nombres','apellidos','ruc','direccion','telefonos','email'];

}
