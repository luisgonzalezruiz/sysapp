<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntradaMercaderia extends Model
{
    use HasFactory;

    protected $primaryKey='em_codigo';
    protected $table='entradas_mercaderias_app';

    public $timestamps = false;


    protected $fillable=['em_codigo', 'loc_codigo', 'tmv_codigo', 'tcp_codigo', 'em_nro_comprobante', 
        'em_fecha_entrada', 'mon_codigo', 'em_tipo_cambio', 'asiento_id', 'em_codigo_doc', 
        'em_estado', 'dep_codigo', 'fun_codigo_creador', 'fun_codigo_modificador', 
        'fec_creacion', 'fec_modificacion', 'em_observacion', 'em_tipo_cambio_sys', 
        'em_novillo', 'em_vaquilla', 'em_vaca', 'em_toro', 'em_total_kilos', 
        'em_cantidad_reses', 'user_id'
        ];


    //definimos una relacion uno a mucho
    public function EntradaMercaderiaDetalle()
    {
        return $this->hasMany(EntradaMercaderiaDetalle::class,'em_codigo');
    }

}
