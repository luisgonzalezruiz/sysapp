<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Producto extends Model
{
    use HasFactory;
    protected $primaryKey  = 'producto_id';
    protected $table = 'productos';

    protected $fillable = ['nombre','descripcion','precio','categoria_id','activo'];

    //relacionamos el producto a la categoria
    public function categoria(){
        return $this->belongsTo(Categoria::class,'categoria_id');  //post->category->name
        //return $this->belongsTo('App\Models\Categoria', 'categoria_id', 'categoria_id');
    }

    //definimos una relacion uno a mucho
    //cuando recuperamos un producto, con ella recuperamos todas las fotos asociadas
    public function productos_imagen()
    {
        return $this->hasMany(ProductoImagen::class,'producto_id');
    }

}
