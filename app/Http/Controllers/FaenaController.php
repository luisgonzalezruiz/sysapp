<?php

namespace App\Http\Controllers;

use App\Models\Faena;
use App\Models\FaenaDetalles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class FaenaController extends Controller
{

    public function index(Request $request)
    {
        // aqui recibimos un json con el elemento a buscar
        $buscar = $request->buscar;

        

        if ($buscar==''){
            //$faenas = Faena::orderBy('fae_codigo', 'desc')->get();

            $faenas = Faena::join('proveedores as c','c.prov_codigo','faena_app.prov_codigo')
                            ->select('faena_app.*','c.prov_descripcion as prov_descripcion')->get();

        }
        else{

            //$faenas = Faena::where('fae_hecho_por', 'like', '%'. $buscar . '%')
            //                ->orderBy('fae_codigo', 'desc')->get();

            $faenas = Faena::join('proveedores as c','c.prov_codigo','faena_app.prov_codigo')
                            ->select('faena_app.*','c.prov_descripcion as prov_descripcion')
                            ->where('faena_app.fae_codigo', 'like','%'. $buscar . '%')->get();
        }
        return response()->json([
            'data'=>$faenas,
            'mensaje'=>'Successfully Retrieved Faenas'
        ],200);

    }

    // este metodo devuel la lista de lotes de faenas que esta disponible
    public function faenaLotes(Request $request)
    {
        // aqui recibimos un json con el elemento a buscar
        $buscar = $request->buscar;

        if ($buscar==''){
            $faenas = DB::select('SELECT * 
                                  FROM vfaena_master 
                                  order by fae_fecha desc , fae_nro_lote  limit 200');  
        }else{
            $buscar = $buscar . "%";
            $faenas = DB::select('SELECT * 
                                  FROM vfaena_master 
                                  WHERE fae_nro_lote like ?
                                  order by fae_fecha desc limit 200', [$buscar]);        
        }        

        return response()->json([
            'data'=>$faenas,
            'mensaje'=>'Successfully Retrieved Faenas'
        ],200);
        
    }

    public function faenaTarjetas($nroLote)
    {
        $tarjetas =[];
        //$tarjetas = DB::select("SELECT * FROM vdetalles_faena where fae_nro_lote = '$nroLote'");
        if ($nroLote != ''){
            //$tarjetas = DB::select('SELECT * 
            //                        FROM vdetalles_faena 
            //                        WHERE fae_nro_lote = (?)
            //                        ORDER BY det_fae_tarjeta', [$nroLote]);        

            $tarjetas = DB::select('SELECT * 
                                    FROM fn_recuperadetallesfaena(?)',[$nroLote]);                                     


        }

        return response()->json([
            'data'=>$tarjetas,
            'mensaje'=>'Successfully Retrieved Tarjetas'
        ],200);
        
    }

    public function create()
    {
        //
    }

    // dejamos de usar este metod por que solo usamos saveFaena
    public function store(Request $request)
    {

        // deserializamos el objeto JSON que viene desde la aplicacion
        $data  = json_decode($request->datos);
        $detalles  = json_decode($request->detalles);
        $mensaje = '';

        // de esta forma recupero los detalles que viene en formato json
        //$data = $request->get("datos");
        //$fae_codigo = $request->get("fae_codigo");
        DB::beginTransaction();

        try {
            $faena = Faena::create([
                'fae_codigo' => $data->fae_codigo,
                'fae_nro_lote' => $data->fae_nro_lote,
                'fae_fecha' => Carbon::parse($data->fae_fecha),
                'prov_codigo' => $data->prov_codigo,
                'loc_codigo' => $data->loc_codigo,
                'fae_entregado_por' => $data->fae_entregado_por,
                'fae_hecho_por' => $data->fae_hecho_por,
                'fae_destino' => $data->fae_destino,
                'com_nro_comprobante' => $data->com_nro_comprobante,
                'com_codigo' => $data->com_codigo,
                'user_id' => $data->user_id
            ]);

            //$c=0;
            if ($faena){
                foreach($detalles as $item)
                {
                    // si el item = 0 =, insertaremos el detall, sino lo actualizamos
                    if ( $item->fd_item == 0 ){
                        $detalle = new FaenaDetalles();
                    }else{
                        $detalle = FaenaDetalles::find($item->fd_item);
                    }
                    $detalle->fae_nro_lote = $faena->fae_nro_lote;
                    $detalle->fae_codigo = $faena->fae_codigo;
                    $detalle->fd_tarjeta = $item->fd_tarjeta;
                    $detalle->fd_kilos = $item->fd_kilos;
                    $detalle->pro_codigo = $item->pro_codigo;
                    $detalle->cla_codigo = $item->cla_codigo;
                    $detalle->save();

                    // array comun no asociativo
                    //$c =  $item['fd_item'];
                }

                DB::commit();
                // si llega aqui es por que fue exitoso el registro
                $mensaje='Registro insertado correctamente';
            }else{
                $mensaje='No se pudo insertar el registro';
            }
        } catch (\Exception $exp) {
            DB::rollBack();
            $mensaje = $exp->getMessage();
            $this->emit('sale-error', $exp->getMessage());
        }


        return response()->json([
            'data'=>$faena,
            'mensaje'=> $mensaje
        ],200);

    }

    public function saveFaena(Request $request)
    {

        // deserializamos el objeto JSON que viene desde la aplicacion
        $data  = json_decode($request->datos);
        $detalles  = json_decode($request->detalles);
        $mensaje = '';

        // de esta forma recupero los detalles que viene en formato json
        //$data = $request->get("datos");
        //$fae_codigo = $request->get("fae_codigo");
        DB::beginTransaction();

        try {
            if ( $data->fae_codigo == 0 ){
                $faena = new Faena();

            }else{
                $faena = Faena::all()->find($data->fae_codigo);
                //solamente si es edicion entra aqui
                $faena->fae_codigo = $data->fae_codigo;
            }

            $faena->fae_nro_lote = $data->fae_nro_lote;
            $faena->fae_fecha = Carbon::parse($data->fae_fecha);
            $faena->prov_codigo = $data->prov_codigo;
            $faena->loc_codigo = $data->loc_codigo;
            $faena->fae_entregado_por = $data->fae_entregado_por;
            $faena->fae_hecho_por = $data->fae_hecho_por;
            $faena->fae_destino = $data->fae_destino;
            $faena->com_nro_comprobante = $data->com_nro_comprobante;
            $faena->com_codigo = $data->com_codigo;
            $faena->user_id = $data->user_id;
            $faena->save();

            //$c=0;
            if ($faena){
                foreach($detalles as $item)
                {
                    // si el item = 0 =, insertaremos el detall, sino lo actualizamos
                    if ( $item->fd_item == 0 ){
                        $detalle = new FaenaDetalles();
                    }else{
                        $detalle = FaenaDetalles::find($item->fd_item);
                    }
                    $detalle->fae_nro_lote = $faena->fae_nro_lote;
                    $detalle->fae_codigo = $faena->fae_codigo;
                    $detalle->fd_tarjeta = $item->fd_tarjeta;
                    $detalle->fd_kilos = $item->fd_kilos;
                    $detalle->pro_codigo = $item->pro_codigo;
                    $detalle->cla_codigo = $item->cla_codigo;
                    $detalle->save();

                    // array comun no asociativo
                    //$c =  $item['fd_item'];
                }

                DB::commit();
                // si llega aqui es por que fue exitoso el registro
                $mensaje='Registro grabado con existo';
            }else{
                $mensaje='No se pudo grabar el registro';
            }
        } catch (\Exception $exp) {
            DB::rollBack();
            $mensaje = $exp->getMessage();
            $this->emit('sale-error', $exp->getMessage());
        }

        // esto normalmente debemos traer de la DB
        $faena->prov_descripcion = $data->prov_descripcion;;   // solo es una prueba

        return response()->json([
            'data'=>$faena,
            'mensaje'=> $mensaje
        ],200);

    }



    public function show($id)
    {
        //$faena = Faena::all()->find($id);

        $faena = Faena::join('proveedores as c','c.prov_codigo','faena_app.prov_codigo')
        ->select('faena_app.*','c.prov_descripcion as prov_descripcion')
        ->where('faena_app.fae_codigo', '=', $id )->get();

        // de esta forma al recuperar un producto recupero la categoria y las imagenes relacionadas
        //$producto = $this->producto->with(['categoria', 'productos_imagen'])->findOrFail($id);

        return response()->json([
            'data'=> $faena,
            'mensaje'=>'Successfully Retrieved by Id'
        ],200);

    }



    public function update(Request $request,$id)
    {

    }


    public function destroy(Faena $faena)
    {
        //
    }
}
