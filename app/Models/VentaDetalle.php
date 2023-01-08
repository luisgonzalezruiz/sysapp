<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaDetalle extends Model
{
    use HasFactory;
    protected $primaryKey  = 'dv_item';
    protected $table = 'ventas_detalles';

    public $timestamps = false;

    protected $fillable = ['rom_det_item', 'rom_nro_lote',
    'rom_det_kilos', 'rom_precio_venta', 'fae_nro_lote', 'det_fae_tarjeta', 'rom_codigo'];



    public function Venta(){
        return $this->belongsTo(Venta::class,'vta_codigo');
    }

}
