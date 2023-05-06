<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;
    protected $primaryKey  = 'fun_codigo';
    protected $table = 'funcionarios';

    //protected $fillable = ['nombres','apellidos','ruc','direccion','telefonos','email'];

}
