<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RomaneoCorte extends Model
{
    use HasFactory;

    protected $primaryKey='rc_codigo';
    protected $table='romaneo_cortes_app';

    public $timestamps = false;

    protected $fillable=[
        'rc_codigo', 'loc_codigo', 'rc_lote', 'rc_fecha', 'rc_cantidad', 
        'rc_total_kilos', 'rc_responsable', 'rc_obs', 'cli_codigo', 'rc_nro_comprobante', 
        'rc_cantidad_kilos', 'rep_codigo', 'user_id'
        ];


    //definimos una relacion uno a mucho
    public function romaneo_detalles()
    {
        return $this->hasMany(RomaneoCorteDetalle::class,'rc_codigo');
    }
}
