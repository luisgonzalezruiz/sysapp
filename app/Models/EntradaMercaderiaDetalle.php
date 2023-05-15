<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntradaMercaderiaDetalle extends Model
{
    use HasFactory;
    protected $primaryKey  = 'emd_item';
    protected $table = 'entradas_mercaderias_app_detalles';

    public $timestamps = false;

    protected $fillable = [
                'em_codigo', 'emd_item', 'pro_codigo', 'emd_cantidad', 
                'emd_precio_unitario', 'dep_codigo', 'cuenta_contable', 
                'ca_codigo', 'em_costo_mercaderia', 'emd_cantidad_res', 'emd_kilos'
                ];
    
    public function EntradaMercaderia(){
        return $this->belongsTo(EntradaMercaderia::class,'em_codigo');
    }

}
