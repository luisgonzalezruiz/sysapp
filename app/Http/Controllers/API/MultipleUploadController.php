<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\Image;
use App\Models\ProductoImagen;

//use Validator;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class MultipleUploadController extends Controller
{

public function store(Request $request)
{
    $mensaje="";

    // validamos el tamaño del archivo
    $validator = Validator::make($request->all(), [
        'fileName' => 'max:2048',
    ]);

    // ejecutamos la validacion
    //$this->validate($rules,$messages);  
 
 
    if ( $validator->fails() ) {
        $prod_img = new ProductoImagen();
        $prod_img->producto_id = 0;  
        $prod_img->url = '';

        $data = $prod_img ; 
        $mensaje = 'Supera el tamaño permitido.';
    } else {

        if($request->hasFile('fileName')){
            // deserializamos el objeto JSON que viene desde la aplicacion
            $data  = json_decode($request->datos, true);

            $image = $request->file('fileName');
            //$name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];

            $customFileName = uniqid()  . '_.' . $image->extension();

            //$url= Image::make($request->file('fileName'))->save(public_path('uploads/images/store/').$customFileName);

            // esto almacena en el storage de la app es decir hay que manejar link
            // de esta forma especificamos con que nombre queremos almacenar la info
            //$url = $image->storeAs('uploads/images/store',$customFileName);

            $url = $image->storeAs('uploads/images/productos',$customFileName);

            // de esta forma el facade Storage se encarga de asignar el nombre al file
            //$url = Storage::put('productos', $image);

            // esto almacena a la ubicacion publica, en teoria no tan recomendada
            //$path = public_path() . '/uploads/images/store/';
            //$url = $image->move($path, $customFileName);
        
            $prod_img = new ProductoImagen();
            $prod_img->producto_id = $request->producto_id; //$data['producto_id'];   
            $prod_img->url = $url;
            $prod_img->save();

            $data = $prod_img;

            $mensaje = "Archivo almacenado correctamente";

            //return response()->json(['success' => 'You have successfully uploaded an image'], 200);

        }else{
            $prod_img = new ProductoImagen();
            $prod_img->producto_id = 0;  
            $prod_img->url = '';
            $data = $prod_img ; 
            $mensaje = "No se pudo almacenar el archivo";
        }

    }

    return response()->json([
        'data'=> $data,
        'mensaje'=> $mensaje
    ],200);

}


public function uploadTest(Request $request) {

    if(!$request->hasFile('image')) {
        return response()->json(['upload_file_not_found'], 400);
    }
    $file = $request->file('image');
    if(!$file->isValid()) {
        return response()->json(['invalid_file_upload'], 400);
    }
    $path = public_path() . '/uploads/images/store/';
    $file->move($path, $file->getClientOriginalName());
    return response()->json(compact('path'));

 }

}



/*
    if(!$request->hasFile('fileName')) {
        return response()->json(['upload_file_not_found'], 400);
    }

    $allowedfileExtension=['pdf','jpg','png'];
    $files = $request->file('fileName');
    $errors = [];

    foreach ($files as $file) {

        $extension = $file->getClientOriginalExtension();

        $check = in_array($extension,$allowedfileExtension);

        if($check) {
            foreach($request->fileName as $mediaFiles) {

                $path = $mediaFiles->store('public/images');
                $name = $mediaFiles->getClientOriginalName();

                //store image file into directory and db
                $save = new Image();
                $save->title = $name;
                $save->path = $path;
                $save->save();
            }
        } else {
            return response()->json(['invalid_file_format'], 422);
        }

        return response()->json(['file_uploaded'], 200);
     }
*/