<?php

namespace App\Http\Controllers;

use App\Models\FacturaElectronica;
use Illuminate\Http\Request;

class FacturaElectronicaController extends Controller
{

    public function index(Request $request)
    {
        $buscar = $request->buscar;
        //$clientes = Cliente::all();

        $fe = FacturaElectronica::orderBy('pk_fac', 'desc')->get();

        return response()->json([
            'data'=>$fe,
            'mensaje'=>'Successfully Retrieved Cliente'
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


    public function show(Cliente $cliente)
    {
        //
    }


    public function edit(Cliente $cliente)
    {
        //
    }


    public function update(Request $request, Cliente $cliente)
    {
        //
    }


    public function destroy(Cliente $cliente)
    {
        //
    }
}
