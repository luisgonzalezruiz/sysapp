<?php

namespace App\Http\Controllers;

use App\Models\FaenaDetalles;
use Illuminate\Http\Request;

class FaenaDetallesController extends Controller
{

    public function index(Request $request)
    {
        // aqui recibimos un json con el elemento a buscar
        $buscar = $request->buscar;

        if ($buscar==''){
            $faenas = FaenaDetalles::orderBy('fae_codigo', 'desc')->get();
        }
        else{
            $faenas = FaenaDetalles::where('fae_codigo', 'like', '%'. $buscar . '%')
                            ->orderBy('fae_codigo', 'desc')->get();
        }

        return response()->json([
            'data'=>$faenas,
            'mensaje'=>'Successfully Retrieved Faenas'
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


    public function show(FaenaDetalles $faenaDetalles)
    {
        //
    }

    // recuperamos los detalles de la faena
    public function showByID($fae_codigo)
    {

        // $faena_detalles = FaenaDetalles::where('fae_codigo', '=', $fae_codigo)
        //                 ->orderBy('fd_item', 'desc')->get();

        $faena_detalles = FaenaDetalles::join('productos as c','c.pro_codigo','faena_app_detalles.pro_codigo')
                ->select('faena_app_detalles.*','c.pro_descripcion_local')
                ->where('faena_app_detalles.fae_codigo', '=', $fae_codigo )
                ->orderBy('fd_item', 'desc')->get();

        return response()->json([
            'data'=>$faena_detalles,
            'mensaje'=>'Successfully Retrieved Faenas'
        ],200);

    }

    public function edit(FaenaDetalles $faenaDetalles)
    {
        //
    }


    public function update(Request $request, FaenaDetalles $faenaDetalles)
    {
        //
    }


    public function destroy($id)
    {
        $faena_detalle = FaenaDetalles::all()->find($id);
        $faena_detalle->delete();

        return response()->json([
            'data'=> $faena_detalle,
            'mensaje'=>'Successfully Deleted'
        ],200);
        
    }

}
