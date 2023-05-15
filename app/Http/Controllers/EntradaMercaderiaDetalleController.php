<?php

namespace App\Http\Controllers;

use App\Models\EntradaMercaderiaDetalle;
use Illuminate\Http\Request;

class EntradaMercaderiaDetalleController extends Controller
{
    public function index(Request $request)
    {
        // aqui recibimos un json con el elemento a buscar
        $buscar = $request->buscar;

        if ($buscar==''){
            $entradaDetalles = EntradaMercaderiaDetalle::orderBy('em_codigo', 'desc')
                                ->where('em_codigo','=',2410)
                                ->get();
        }
        else{
            $entradaDetalles = EntradaMercaderiaDetalle::where('em_codigo', 'like', '%'. $buscar . '%')
                            ->orderBy('em_codigo', 'desc')->get();
        }

        return response()->json([
            'data'=>$entradaDetalles,
            'mensaje'=>'Successfully Retrieved ventas'
        ],200);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(VentasDetalles $ventasDetalles)
    {
        //
    }

     // recuperamos los detalles de la faena
     public function showByID($em_codigo)
     {       

        $entrada_detalles = EntradaMercaderiaDetalle::join('productos as c','c.pro_codigo',
                                              'entradas_mercaderias_app_detalles.pro_codigo')
                 ->select('entradas_mercaderias_app_detalles.*','c.pro_descripcion_local')
                 ->where('entradas_mercaderias_app_detalles.em_codigo', '=', $em_codigo )
                 ->orderBy('emd_item', 'asc')->get();

        return response()->json([
             'data'=>$entrada_detalles,
             'mensaje'=>'Successfully Retrieved Faenas'
         ],200);         

     }


    public function edit(VentasDetalles $ventasDetalles)
    {
        //
    }


    public function update(Request $request, VentasDetalles $ventasDetalles)
    {
        //
    }


    public function destroy(VentasDetalles $ventasDetalles)
    {
        //
    }

}
