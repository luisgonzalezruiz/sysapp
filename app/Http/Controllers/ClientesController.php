<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClientesController extends Controller
{

    public function index(Request $request)
    {
        $buscar = $request->buscar;
        //$clientes = Cliente::all();

        if ($buscar==''){
            $clientes = Cliente::orderBy('cli_codigo', 'desc')->get();
        }
        else{
            $clientes = Cliente::whereRaw('LOWER(cli_nombres) like (?)', ["%{$buscar}%"])
            //$clientes = Cliente::where('cli_nombres', 'like', '%'. $buscar . '%')
                            ->orderBy('cli_codigo', 'desc')->get();
        }

        return response()->json([
            'data'=>$clientes,
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
