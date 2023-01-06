<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RomaneoDetalle extends Model
{
    use HasFactory;
    protected $primaryKey  = 'rom_det_item';
    protected $table = 'romaneo_detalle';

    public $timestamps = false;

    protected $fillable = ['rom_det_item', 'rom_nro_lote',
    'rom_det_kilos', 'rom_precio_venta', 'fae_nro_lote', 'det_fae_tarjeta', 'rom_codigo'];


    //relacionamos el producto a la categoria
    public function romaneo(){
        return $this->belongsTo(Romaneo::class,'rom_codigo');
    }

    //public function producto(){
    //    return $this->belongsTo(Producto::class,'pro_codigo','producto_id');
    //}

}
