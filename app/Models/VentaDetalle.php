<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaDetalle extends Model
{
    use HasFactory;
    protected $primaryKey  = 'dv_item';
    protected $table = 'ventas_app_detalles';

    public $timestamps = false;

    protected $fillable = ['vta_codigo', 'pro_codigo', 'dv_cantidad', 'dv_precio_unitario',
                            'dv_nro_lote', 'dv_vencimiento_lote', 'dv_iva', 'dv_exentas', 'dv_gravadas',
                            'dv_porcentaje_descuento', 'dv_monto_descuento', 'iva_codigo', 'dep_codigo',
                            'dv_impuesto', 'dv_costo_mercaderia', 'cuenta_contable', 'dv_cantidad_res',
                            'lp_codigo', 'dv_impuesto_a_desc', 'dv_total_sin_iva',
                            'dv_impuesto_d_desc', 'dv_total_d_desc', 'dv_item'
                        ];


    public function Venta(){
        return $this->belongsTo(Venta::class,'vta_codigo');
    }

}
