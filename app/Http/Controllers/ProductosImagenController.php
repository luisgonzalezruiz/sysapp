<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductoImagen;
use Illuminate\Http\Request;

class ProductosImagenController extends Controller
{

    public function index()
    {
        $productos_imagen= ProductoImagen::all();
        return response()->json([
            'data'=>$productos_imagen,
            'mensaje'=>'Successfully Retrieved imagenes'
        ],200);
    }

    public function ImagenByProducto($producto_id)
    {
        $productos_imagen = ProductoImagen::where('producto_id', '=', $producto_id)
                             ->orderBy('id', 'desc')->get();    

        return response()->json([
            'data'=>$productos_imagen,
            'mensaje'=>'Successfully Retrieved imagenes'
        ],200);
    }

    public function storeImage(Request $request)
    {
        $errors = [];
    
        if($request->hasFile('fileName')){
            $allowedfileExtension=['pdf','jpg','png'];
            $image = $request->file('fileName');

            $nombre = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $customFileName = uniqid() . '_.' . $image->extension();

            $check = in_array($extension,$allowedfileExtension);
      
            // esto almacena en el storage de la app es decir hay que manejar link
            // de esta forma especificamos con que nombre queremos almacenar la info

            if($check) {
                //*************************************************//
                //Esto es para ir directo a la carpeta publica
                //*************************************************//
                //$path = public_path() . '/uploads/imbesosages/store/';
                //$url = $image->move($path, $customFileName);
                //*************************************************//
                $url = $eldocu->storeAs('uploads/images/productos',$customFileName);
                // insertamos el registro en la tabla de productos_images
                $prod_img = new ProductoImagen();
                $prod_img->producto_id = $request->producto_id;
                $prod_img->url = $url;
                $prod_img->save();
            } else {
                $errors[] ='El archivo ' . $nombre . ' tiene formato incorrecto';
            }
        }

        if (count($errors)==0){
            //$msg_img = 'Error en la extension';
            $errors[] = 'Todos los archivos fueron insertados';
        }
        return response()->json([
            'data'=> $prod_img,
            'msg_img'=> $errors,
            'mensaje'=>'Successfully Created'
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

    public function show(ProductoImagen $productoImagen)
    {
        //
    }


    public function edit(ProductoImagen $productoImagen)
    {
        //
    }


    public function update(Request $request, ProductoImagen $productoImagen)
    {
        //
    }


    public function destroy(ProductoImagen $productoImagen)
    {
        //
    }
}
