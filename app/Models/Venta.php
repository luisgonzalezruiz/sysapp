<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $primaryKey='vta_codigo';
    protected $table='ventas_app';

    public $timestamps = false;

    protected $fillable=['loc_codigo', 'vta_codigo', 'tmv_codigo', 'tcp_codigo', 'cli_codigo', 'vta_nro_comprobante',
                         'vta_fecha_venta', 'vta_fecha_vencimiento', 'vta_total_gravadas', 'vta_total_exentas',
                         'per_codigo', 'mon_codigo', 'vta_tipo_cambio', 'vta_total_factura',
                         'vta_anulado', 'vta_nro_remision', 'vta_fecha_remision', 'fun_codigo',
                         'vta_porcentaje_descuento', 'vta_monto_descuento', 'vta_nro_timbrado',
                         'asiento_id', 'codigo_doc', 'loc_codigo_fiscal', 'punto_emision', 'vta_nro_factura',
                         'cuenta_contable', 'vta_tipo', 'vta_saldo', 'vta_estado', 'rom_nro_lote', 'vta_serie',
                         'lp_codigo', 'dep_codigo', 'vta_doc_base', 'vta_tipo_cambio_sys', 'fun_codigo_creador',
                         'fun_codigo_modificador', 'fec_creacion', 'fec_modificacion', 'vta_observacion',
                         'vta_iva5', 'vta_iva10', 'vta_exenta', 'cf_codigo', 'rc_codigo', 'com_codigo_interno',
                         'tipo_documento', 'origen','user_id','vta_codigo_master','vta_migrado'
                        ];

    //definimosunarelacionunoamucho
    //cuandorecuperamosunproducto,conellarecuperamostodaslosdetallesasociadas
    public function VentaDetalles()
    {
        return$this->hasMany(VentaDetalle::class,'vta_codigo');
    }

}
