<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaenaDetalles extends Model
{
    use HasFactory;
    protected $primaryKey  = 'fd_item';
    protected $table = 'faena_app_detalles';

    protected $fillable = ['fae_nro_lote','fae_codigo','fd_tarjeta','fd_kilos', 'pro_codigo', 'cla_codigo'];


    //relacionamos el producto a la categoria
    public function faena(){
        return $this->belongsTo(Faena::class,'fae_codigo');
    }

    public function producto(){
        return $this->belongsTo(Producto::class,'pro_codigo','pro_codigo');
    }




    // de esta forma indicamo que no queremos usar el create_at y update_at
   // public $timestamps = false;
}
