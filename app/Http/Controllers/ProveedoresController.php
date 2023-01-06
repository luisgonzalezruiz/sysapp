<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{

    public function index(Request $request)
    {
        $buscar = $request->buscar;
        //$proveedores = Proveedor::all();

        if ($buscar==''){
            $proveedores = Proveedor::orderBy('proveedor_id', 'desc')->get();
        }
        else{
            $proveedores = Proveedor::whereRaw('LOWER(nombres) like (?)', ["%{$buscar}%"])
            //$proveedores = Proveedor::where('nombres', 'like', '%'. $buscar . '%')
                            ->orderBy('proveedor_id', 'desc')->get();
        }

        return response()->json([
            'data'=>$proveedores,
            'mensaje'=>'Successfully Retrieved Proveedor'
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


    public function show(Proveedor $proveedor)
    {
        //
    }


    public function edit(Proveedor $proveedor)
    {
        //
    }


    public function update(Request $request, Proveedor $proveedor)
    {
        //
    }


    public function destroy(Proveedor $proveedor)
    {
        //
    }
}
