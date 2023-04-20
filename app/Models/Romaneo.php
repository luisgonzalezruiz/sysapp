<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Romaneo extends Model
{
    use HasFactory;

    protected $primaryKey='rom_codigo';
    protected $table='romaneo_app';

    public $timestamps = false;


    protected $fillable=['rom_codigo','rom_nro_lote','rom_fecha','rom_entregado_por','rom_hecho_por',
                    'rom_nro_boleta','loc_codigo','cli_codigo','rom_nro_remision','rom_nota_credito',
                    'rom_nota_debito','rom_nd_nov','rom_nd_vac','rom_nd_tor','rom_nc_nov','rom_nc_vac',
                    'rom_nc_tor','rep_codigo','usuario_carga','fecha_carga','usuario_modifica',
                    'fecha_modifica','cod_entregado_por','cod_hecho_por','user_id'
                    ];


    //definimosunarelacionunoamucho
    //cuandorecuperamosunproducto,conellarecuperamostodaslosdetallesasociadas
    public function FaenaDetalles()
    {
        return$this->hasMany(RomaneoDetalle::class,'rom_codigo');
    }



}
