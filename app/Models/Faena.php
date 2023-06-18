<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faena extends Model
{
    use HasFactory;

    protected $primaryKey  = 'fae_codigo';
    protected $table = 'faena_app';

    protected $fillable =
            ['fae_nro_lote', 'fae_fecha', 'prov_codigo',
             'loc_codigo', 'fae_entregado_por', 'fae_hecho_por', 'fae_destino',
             'com_nro_comprobante', 'com_codigo', 'user_id','origen'
            ];


    //relacionamos el producto a la categoria
    //public function categoria(){
    //    return $this->belongsTo(Categoria::class,'categoria_id');  //post->category->name
        //return $this->belongsTo('App\Models\Categoria', 'categoria_id', 'categoria_id');
    //}

    //definimos una relacion uno a mucho
    //cuando recuperamos un producto, con ella recuperamos todas los detalles asociadas
    public function FaenaDetalles()
    {
        return $this->hasMany(FaenaDetalles::class,'fae_codigo');
    }



    // de esta forma indicamos que no queremos usar el create_at y update_at
   // public $timestamps = false;

}
