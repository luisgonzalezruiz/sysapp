<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Producto extends Model
{
    use HasFactory;
    protected $primaryKey  = 'pro_codigo';
    protected $table = 'productos';

    protected $fillable = ['pro_descripcion_local',
                            'pro_descripcion_origen',
                            'pro_precio_costo', 'pro_imagen',
                            'categoria_id','pro_activo'];

    /*
    //relacionamos el producto a la categoria
    public function rubro(){
        return $this->belongsTo(Rubro::class,'rub_codigo');  //post->category->name
        //return $this->belongsTo('App\Models\Categoria', 'categoria_id', 'categoria_id');
    }
    */

    //definimos una relacion uno a mucho
    //cuando recuperamos un producto, con ella recuperamos todas las fotos asociadas
    public function productos_imagen()
    {
        return $this->hasMany(ProductoImagen::class,'producto_id');
    }

}
