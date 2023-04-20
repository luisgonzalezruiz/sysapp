<?php

namespace App\Models;      

use Illuminate\Database\Eloquent\Factories\HasFactor;     
use Illuminate\Database\Eloquent\Model;      

class FacturaElectronica extends Model
{
    use HasFactory;      
    protected $primaryKey  = 'pk_fac';      
    protected $table = 't_factura_cab';      

}





