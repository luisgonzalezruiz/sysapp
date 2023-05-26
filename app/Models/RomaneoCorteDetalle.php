<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RomaneoCorteDetalle extends Model
{
    use HasFactory;
    protected $primaryKey  = 'rcd_item';
    protected $table = 'romaneo_cortes_app_detalles';

    public $timestamps = false;

    protected $fillable = [
                 'rc_codigo', 'rcd_item', 'pro_codigo', 
                 'rcd_cantidad', 'rcd_precio', 'em_codigo', 'rcd_kilos'
                ];
    
    // pertenece a un romaneo de corte
    public function romaneo_corte(){
        return $this->belongsTo(RomaneoCorte::class,'rc_codigo');
    }

    // un detalle de producto corresponde a un producto
    public function producto(){
        return $this->belongsTo(Producto::class,'pro_codigo');
    }

}
