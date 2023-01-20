<?php

namespace App\Http\Controllers;

use App\Models\VentaDetalle;
use Illuminate\Http\Request;

class VentaDetalleController extends Controller
{

    public function index()
    {
        // aqui recibimos un json con el elemento a buscar
        $buscar = $request->buscar;

        if ($buscar==''){
            $ventas = VentaDetalle::orderBy('vta_codigo', 'desc')->get();
        }
        else{
            $ventas = VentaDetalle::where('vta_codigo', 'like', '%'. $buscar . '%')
                            ->orderBy('vta_codigo', 'desc')->get();
        }

        return response()->json([
            'data'=>$ventas,
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
     public function showByID($vta_codigo)
     {


         //$faena_detalles = FaenaDetalles::join('productos as c','c.producto_id','faena_detalles.pro_codigo')
         //        ->select('faena_detalles.*','c.descripcion as pro_descripcion_local')
         //        ->where('faena_detalles.fae_codigo', '=', $fae_codigo )
         //        ->orderBy('fd_item', 'desc')->get();

         $venta_detalles = VentaDetalle::where('vta_codigo', '=', $vta_codigo)
                 ->orderBy('dv_item','asc')->get();

         return response()->json([
             'data'=>$venta_detalles,
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
