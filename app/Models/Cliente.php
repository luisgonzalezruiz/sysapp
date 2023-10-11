<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $primaryKey  = 'cli_codigo';
    protected $table = 'v_clientes_master';
    //protected $table = 'clientes';

}
