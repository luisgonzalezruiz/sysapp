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
            $proveedores = Proveedor::select('prov_codigo','prov_descripcion','prov_ruc',
                                             'prov_direccion','prov_telefonos','prov_mail')
                            ->orderBy('prov_codigo', 'desc')->get();

        }
        else{
            //$proveedores = Proveedor::where('nombres', 'like', '%'. $buscar . '%')
            $proveedores = Proveedor::select('prov_codigo','prov_descripcion','prov_ruc',
                                             'prov_direccion','prov_telefonos','prov_mail')
                                     ->whereRaw('LOWER(prov_descripcion) like (?)', ["%{$buscar}%"])
                                     ->orderBy('prov_codigo', 'desc')->get();
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
