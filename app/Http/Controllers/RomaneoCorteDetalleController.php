<?php

namespace App\Http\Controllers;

use App\Models\RomaneoCorteDetalle;
use Illuminate\Http\Request;

class RomaneoCorteDetalleController extends Controller
{

    public function index(Request $request)
    {
        // aqui recibimos un json con el elemento a buscar
        $buscar = $request->buscar;

        if ($buscar==''){
            $romaneos = RomaneoCorteDetalle::orderBy('rc_codigo', 'desc')->get();
        }
        else{
            $romaneos = RomaneoCorteDetalle::where('rc_codigo', 'like', '%'. $buscar . '%')
                            ->orderBy('rc_codigo', 'desc')->get();
        }

        return response()->json([
            'data'=>$romaneos,
            'mensaje'=>'Successfully Retrieved romaneos'
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


    public function show(RomaneoDetalle $romaneoDetalle)
    {
        //
    }

    // recuperamos los detalles de la faena
    public function showByID($rc_codigo)
    {


        //$faena_detalles = FaenaDetalles::join('productos as c','c.producto_id','faena_detalles.pro_codigo')
        //        ->select('faena_detalles.*','c.descripcion as pro_descripcion_local')
        //        ->where('faena_detalles.fae_codigo', '=', $fae_codigo )
        //        ->orderBy('fd_item', 'desc')->get();

        $romaneo_detalles = RomaneoCorteDetalle::where('rc_codigo', '=', $rc_codigo)
                ->orderBy('rcd_item','asc')->get();

        return response()->json([
            'data'=>$romaneo_detalles,
            'mensaje'=>'Successfully Retrieved cortes'
        ],200);

    }


    public function edit(RomaneoDetalle $romaneoDetalle)
    {
        //
    }


    public function update(Request $request, RomaneoDetalle $romaneoDetalle)
    {
        //
    }


    public function destroy($id)
    {
        $romaneo_detalle = RomaneoCorteDetalle::all()->find($id);
        $romaneo_detalle->delete();

        return response()->json([
            'data'=> $romaneo_detalle,
            'mensaje'=>'Successfully Deleted'
        ],200);
        
    }
}
