<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    
    public function index()
    {
        $categorias = Categoria::all();
        return response()->json([
            'data'=>$categorias,
            'mensaje'=>'Successfully Retrieved categorias'
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

    
    public function show(Categoria $categoria)
    {
        //
    }

 
    public function edit(Categoria $categoria)
    {
        //
    }

 
    public function update(Request $request, Categoria $categoria)
    {
        //
    }


    public function destroy(Categoria $categoria)
    {
        //
    }
}
