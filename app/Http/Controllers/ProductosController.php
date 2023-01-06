<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

use App\Models\Image;
use App\Models\ProductoImagen;

use Illuminate\Support\Facades\Storage;

use App\Events\ListingViewed;

class ProductosController extends Controller
{

    protected $producto = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Producto $producto)
    {
        //$this->middleware('auth:api');
        $this->producto = $producto;

    }

    public function index(Request $request)
    {
        // aqui recibimos un json con el elemento a buscar
        $buscar = $request->buscar;
        //$productos = Producto::all();


        //return response()->json([
        //    'data'=>$otro,
        //    'mensaje'=>'Successfully Retrieved Productos'
        //],200);

        //>with('categoria','productos_imagen') -> estas son las relaciones definidas en el modelo Producto
        if ($buscar==''){
            //$productos = Producto::orderBy('producto_id', 'desc')->with('categoria','productos_imagen')->get();
            $productos = Producto::orderBy('producto_id', 'desc')->get();
        }
        else{
            //$productos = Producto::where('nombre', 'like', '%'. $buscar . '%')
            //                ->orderBy('producto_id', 'desc')->with('categoria','productos_imagen')->get();

            $productos = Producto::whereRaw('LOWER(nombre) like (?)', ["%{$buscar}%"])
                              ->orderBy('producto_id', 'desc')->get();
            //$productos = Producto::where('nombre', 'like', '%'. $buscar . '%')
        }

        return response()->json([
            'data'=>$productos,
            'mensaje'=>'Successfully Retrieved Productos'
        ],200);

/*
        if ($buscar==''){
            $productos = Producto::orderBy('nombre', 'desc')->paginate(3);
        }
        else{
            $productos = Producto::where('nombre', 'like', '%'. $buscar . '%')
                            ->orderBy('nombre', 'desc')->paginate(3);
        }
        return response()->json([
            'data'=>$productos,
            'mensaje'=>'Successfully Retrieved Productos'
        ],200);
*/

    }

    public function store(Request $request)
    {
        $errors = [];

        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->categoria_id = $request->categoria_id;
        $producto->activo = $request->activo;
        $producto->save();

        //aqui guardaremos las imagenes relacionadas al producto
        if($request->hasFile('fileName')){
            $allowedfileExtension=['pdf','jpg','png'];
            //$allowedfileExtension=['pdf'];
            $misdoc = $request->file('fileName');

            //$err=0;
            foreach ($misdoc as $qdoc => $eldocu) {
                $nombre = $eldocu->getClientOriginalName();
                $extension = $eldocu->getClientOriginalExtension();
                $customFileName = uniqid() . '_.' . $eldocu->extension();
                $check = in_array($extension,$allowedfileExtension);

                if($check) {
                    //*************************************************//
                    //Esto es para ir directo a la carpeta publica
                    //*************************************************//
                    //$path = public_path() . '/uploads/images/store/';
                    //$url = $image->move($path, $customFileName);
                    //*************************************************//
                    $url = $eldocu->storeAs('uploads/images/productos',$customFileName);
                    // insertamos el registro en la tabla de productos_images
                    $save = new ProductoImagen();
                    $save->producto_id = $producto->producto_id;
                    $save->url = $url;
                    $save->save();
                } else {
                    $errors[] ='El archivo ' . $nombre . ' tiene formato incorrecto';
                }
             }

        }

        // emitimos el evento
        event(new ListingViewed($producto));

        if (count($errors)==0){
            //$msg_img = 'Error en la extension';
            $errors[] = 'Todos los archivos fueron insertados';
        }
        return response()->json([
            'data'=> $producto,
            'msg_img'=> $errors,
            'mensaje'=>'Successfully Created'
        ],200);

    }


    public function show($id)
    {
        //$producto = Producto::all()->find($id);
        // de esta forma al recuperar un producto recupero la categoria y las imagenes relacionadas
        $producto = $this->producto->with(['categoria', 'productos_imagen'])->findOrFail($id);

        return response()->json([
            'data'=> $producto,
            'mensaje'=>'Successfully Retrieved by Id'
        ],200);
    }


    public function update(Request $request, $id)
    {
        $producto = Producto::all()->find($id);

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->categoria_id = $request->categoria_id;
        $producto->activo = $request->activo;

        $producto->save();

        return response()->json([
            'data'=> $producto,
            'mensaje'=>'Successfully Updated'
        ],200);
    }


    public function destroy($id)
    {
        $producto = Producto::all()->find($id);
        $producto->delete();

        return response()->json([
            'data'=> $producto,
            'mensaje'=>'Successfully Deleted'
        ],200);
    }



}
