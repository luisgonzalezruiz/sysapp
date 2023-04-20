<?php

namespace App\Http\Controllers;

use App\Models\Romaneo;
use App\Models\RomaneoDetalle;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class RomaneoController extends Controller
{

    public function index(Request $request)
    {
        // aqui recibimos un json con el elemento a buscar
        $buscar = $request->buscar;

        if ($buscar==''){
            //$faenas = Romaneo::orderBy('fae_codigo', 'desc')->get();

            $romaneos = Romaneo::join('clientes as c','c.cli_codigo','romaneo_app.cli_codigo')
                            ->select('romaneo_app.*','c.cli_nombres as cli_nombres')->get();
        }
        else{
            $romaneos = Romaneo::join('clientes as c','c.cli_codigo','romaneo_app.cli_codigo')
                            ->select('romaneo_app.*','c.cli_nombres as cli_nombres')
                            ->where('c.cli_nombres', 'like','%'. $buscar . '%')->get();
        }
        return response()->json([
            'data'=>$romaneos,
            'mensaje'=>'Successfully Retrieved romaneo'
        ],200);

    }


    public function create()
    {
        //
    }

    public function saveRomaneo(Request $request)
    {
        $data = $request;
        // de esta forma sacamos los detalles
        $detalles  = $data->detalles;
        $mensaje = '';
        // de esta forma recupero los detalles que viene en formato json
        //$data = $request->get("datos");
        //$fae_codigo = $request->get("fae_codigo");

        DB::beginTransaction();
        try {
            if ( $data->rom_codigo == 0 ){
                $romaneo = new Romaneo();
                $romaneo->fecha_carga = Carbon::now()->toDateTimeString();  //Carbon::now('America/Asuncion');
            }else{
                $romaneo = Romaneo::all()->find($data->rom_codigo);
                $romaneo->fecha_modifica = Carbon::now()->toDateTimeString();  //Carbon::now('America/Asuncion');
            }

            //$romaneo->rom_codigo = $data->rom_codigo;
            $romaneo->rom_nro_lote = $data->rom_nro_lote;
            $romaneo->rom_fecha = Carbon::parse($data->rom_fecha)->format('m/d/Y');
            $romaneo->rom_entregado_por = $data->rom_entregado_por;
            $romaneo->rom_hecho_por = $data->rom_hecho_por;
            $romaneo->rom_nro_boleta = $data->rom_nro_boleta;
            $romaneo->loc_codigo = $data->loc_codigo;
            $romaneo->cli_codigo = $data->cli_codigo;
            $romaneo->rom_nro_remision = $data->rom_nro_remision;
            $romaneo->rom_nota_credito = $data->rom_nota_credito;
            $romaneo->rom_nota_debito = $data->rom_nota_debito;
            $romaneo->rom_nd_nov = $data->rom_nd_nov;
            $romaneo->rom_nd_vac = $data->rom_nd_vac;
            $romaneo->rom_nd_tor = $data->rom_nd_tor;
            $romaneo->rom_nc_nov = $data->rom_nc_nov;
            $romaneo->rom_nc_vac = $data->rom_nc_vac;
            $romaneo->rom_nc_tor = $data->rom_nc_tor;
            $romaneo->rep_codigo = $data->rep_codigo;
            $romaneo->usuario_carga = $data->usuario_carga;
            $romaneo->usuario_modifica = $data->usuario_modifica;
            $romaneo->cod_entregado_por = $data->cod_entregado_por;
            $romaneo->cod_hecho_por = $data->cod_hecho_por;
            $romaneo->user_id = $data->user_id;

            $romaneo->save();

            if ($romaneo){

                foreach($detalles as $ep=>$item)
                {
                    // si el item = 0 =, insertaremos el detall, sino lo actualizamos
                    if ( $item['rom_det_item'] == 0 ){
                        $detalle = new RomaneoDetalle();
                    }else{
                        $detalle = RomaneoDetalle::find($item['rom_det_item']);
                    }
                    $detalle->rom_nro_lote = $romaneo['rom_nro_lote'];
                    $detalle->rom_codigo = $romaneo['rom_codigo'];
                    $detalle->rom_det_kilos = $item['rom_det_kilos'];
                    $detalle->rom_precio_venta = $item['rom_precio_venta'];
                    $detalle->fae_nro_lote = $item['fae_nro_lote'];
                    $detalle->det_fae_tarjeta = $item['det_fae_tarjeta'];
                    $detalle->save();
                }

                DB::commit();
                // si llega aqui es por que fue exitoso el registro
                $mensaje='Registro grabado con existo';
            }else{
                $mensaje='No se pudo grabar el registro';
            }

        } catch (\Exception $exp) {
            $romaneo='';
            $mensaje=$exp->getMessage();

            DB::rollBack();
            //$mensaje = $exp->getMessage();
            //$this->emit('sale-error', $exp->getMessage());
        }

        // esto normalmente debemos traer de la DB
        //$romaneo->cli_nombres = $data->cli_nombres;   // solo es una prueba

        return response()->json([
            'data'=>$romaneo,
            'mensaje'=> $mensaje
        ],200);

    }

    public function saveRomaneo1(Request $request)
    {

        // deserializamos el objeto JSON que viene desde la aplicacion
        $data  = json_decode($request->datos);
        $rom_codigo= $request->input("rom_codigo");
        //$data = $request->input("datos");

        $detalles  = json_decode($request->detalles);
        //$detalles = $request->get("detalles");

        $mensaje = '';

        // de esta forma recupero los detalles que viene en formato json
        //$data = $request->get("datos");
        //$fae_codigo = $request->get("fae_codigo");


        DB::beginTransaction();

        try {

            if ( $data->rom_codigo == 0 ){
                $romaneo = new Romaneo();
                $romaneo->fecha_carga = Carbon::now()->toDateTimeString();  //Carbon::now('America/Asuncion');
            }else{
                $romaneo = Romaneo::all()->find($data->rom_codigo);
                $romaneo->fecha_modifica = Carbon::now()->toDateTimeString();  //Carbon::now('America/Asuncion');
            }

            //$romaneo->rom_codigo = $data->rom_codigo;
            $romaneo->rom_nro_lote = $data->rom_nro_lote;
            $romaneo->rom_fecha = Carbon::parse($data->rom_fecha)->format('m/d/Y');
            $romaneo->rom_entregado_por = $data->rom_entregado_por;
            $romaneo->rom_hecho_por = $data->rom_hecho_por;
            $romaneo->rom_nro_boleta = $data->rom_nro_boleta;
            $romaneo->loc_codigo = $data->loc_codigo;
            $romaneo->cli_codigo = $data->cli_codigo;
            $romaneo->rom_nro_remision = $data->rom_nro_remision;
            $romaneo->rom_nota_credito = $data->rom_nota_credito;
            $romaneo->rom_nota_debito = $data->rom_nota_debito;
            $romaneo->rom_nd_nov = $data->rom_nd_nov;
            $romaneo->rom_nd_vac = $data->rom_nd_vac;
            $romaneo->rom_nd_tor = $data->rom_nd_tor;
            $romaneo->rom_nc_nov = $data->rom_nc_nov;
            $romaneo->rom_nc_vac = $data->rom_nc_vac;
            $romaneo->rom_nc_tor = $data->rom_nc_tor;
            $romaneo->rep_codigo = $data->rep_codigo;
            $romaneo->usuario_carga = $data->usuario_carga;
            $romaneo->usuario_modifica = $data->usuario_modifica;
            $romaneo->cod_entregado_por = $data->cod_entregado_por;
            $romaneo->cod_hecho_por = $data->cod_hecho_por;
            $romaneo->user_id = $data->user_id;

            $romaneo->save();

            //$c=0;

            if ($romaneo){
                foreach($detalles as $item)
                {
                    // si el item = 0 =, insertaremos el detall, sino lo actualizamos
                    if ( $item->rom_det_item == 0 ){
                        $detalle = new RomaneoDetalle();
                    }else{
                        $detalle = RomaneoDetalle::find($item->rom_det_item);
                    }
                    $detalle->rom_nro_lote = $romaneo->rom_nro_lote;
                    $detalle->rom_codigo = $romaneo->rom_codigo;
                    $detalle->rom_det_kilos = $item->rom_det_kilos;
                    $detalle->rom_precio_venta = $item->rom_precio_venta;
                    $detalle->fae_nro_lote = $item->fae_nro_lote;
                    $detalle->det_fae_tarjeta = $item->det_fae_tarjeta;

                    $detalle->save();
                }

                DB::commit();
                // si llega aqui es por que fue exitoso el registro
                $mensaje='Registro grabado con existo';
            }else{
                $mensaje='No se pudo grabar el registro';
            }


        } catch (\Exception $exp) {
            $romaneo='';
            $mensaje=$exp->getMessage();

            DB::rollBack();
            //$mensaje = $exp->getMessage();
            //$this->emit('sale-error', $exp->getMessage());
        }


        // esto normalmente debemos traer de la DB
        $romaneo->cli_nombres = $data->cli_nombres;   // solo es una prueba

        //foreach($detalles as $ep=>$det)
        //{
        //    $test= $det['rom_det_kilos'];
        //}

        return response()->json([
            'data'=>$romaneo,
            'mensaje'=> $mensaje
        ],200);

    }

    public function saveRomaneo2(Request $request)
    {

        // deserializamos el objeto JSON que viene desde la aplicacion
        //$data  = json_decode($request->datos);
        //$rom_codigo= $request->input("rom_codigo");
        //$data = $request->input("datos");

        //$detalles  = json_decode($request->detalles);
        //$detalles = $request->get("detalles");

        $req = $request->all(); // recuperamos todo lo que viene del formulario
        $datos = $req['datos'];
        $detalles = $req['detalles'];

        $mensaje = '';

        // de esta forma recupero los detalles que viene en formato json
        //$data = $request->get("datos");
        //$fae_codigo = $request->get("fae_codigo");


        DB::beginTransaction();

        try {
            if ( $data['rom_codigo'] == 0 ){
                $romaneo = new Romaneo();
                $romaneo->fecha_carga = Carbon::now()->toDateTimeString();  //Carbon::now('America/Asuncion');
            }else{
                $romaneo = Romaneo::all()->find($data['rom_codigo']);
                $romaneo->fecha_modifica = Carbon::now()->toDateTimeString();  //Carbon::now('America/Asuncion');
            }

            //$romaneo->rom_codigo = $data->rom_codigo;
            $romaneo->rom_nro_lote = $data['rom_nro_lote'];
            $romaneo->rom_fecha = Carbon::parse($data['rom_fecha'])->format('m/d/Y');
            $romaneo->rom_entregado_por = $data['rom_entregado_por'];
            $romaneo->rom_hecho_por = $data['rom_hecho_por'];
            $romaneo->rom_nro_boleta = $data['rom_nro_boleta'];
            $romaneo->loc_codigo = $data['loc_codigo'];
            $romaneo->cli_codigo = $data['cli_codigo'];
            $romaneo->rom_nro_remision = $data['rom_nro_remision'];
            $romaneo->rom_nota_credito = $data['rom_nota_credito'];
            $romaneo->rom_nota_debito = $data['rom_nota_debito'];
            $romaneo->rom_nd_nov = $data['rom_nd_nov'];
            $romaneo->rom_nd_vac = $data['rom_nd_vac'];
            $romaneo->rom_nd_tor = $data['rom_nd_tor'];
            $romaneo->rom_nc_nov = $data['rom_nc_nov'];
            $romaneo->rom_nc_vac = $data['rom_nc_vac'];
            $romaneo->rom_nc_tor = $data['rom_nc_tor'];
            $romaneo->rep_codigo = $data['rep_codigo'];
            $romaneo->usuario_carga = $data['usuario_carga'];
            $romaneo->usuario_modifica = $data['usuario_modifica'];
            $romaneo->cod_entregado_por = $data['cod_entregado_por'];
            $romaneo->cod_hecho_por = $data['cod_hecho_por'];
            $romaneo->user_id = $data['user_id'];

            $romaneo->save();

            //$c=0;

            if ($romaneo){
                foreach($detalles as $ep=>$item)
                {
                    // si el item = 0 =, insertaremos el detall, sino lo actualizamos
                    if ( $item['rom_det_item'] == 0 ){
                        $detalle = new RomaneoDetalle();
                    }else{
                        $detalle = RomaneoDetalle::find($item['rom_det_item']);
                    }

                    $detalle->rom_nro_lote = $romaneo['rom_nro_lote'];
                    $detalle->rom_codigo = $romaneo['rom_codigo'];
                    $detalle->rom_det_kilos = $item['rom_det_kilos'];
                    $detalle->rom_precio_venta = $item['rom_precio_venta'];
                    $detalle->fae_nro_lote = $item['fae_nro_lote'];
                    $detalle->det_fae_tarjeta = $item['det_fae_tarjeta'];

                    $detalle->save();

                }

                DB::commit();
                // si llega aqui es por que fue exitoso el registro
                $mensaje='Registro grabado con existo';
            }else{
                $mensaje='No se pudo grabar el registro';
            }


        } catch (\Exception $exp) {
            $romaneo='';
            $mensaje=$exp->getMessage();

            DB::rollBack();
            //$mensaje = $exp->getMessage();
            //$this->emit('sale-error', $exp->getMessage());
        }


        // esto normalmente debemos traer de la DB
        //$romaneo->cli_nombres = $data['cli_nombres'];   // solo es una prueba

        //foreach($detalles as $ep=>$det)
        //{
        //    $test= $det['rom_det_kilos'];
        //}

        return response()->json([
            'data'=>$romaneo,
            'mensaje'=> $mensaje
        ],200);

    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $romaneo = Romaneo::join('clientes as c','c.cli_codigo','romaneo_app.cli_codigo')
        ->select('romaneo_app.*','c.cli_nombres as cli_nombres')
        ->where('romaneo_app.rom_codigo', '=', $id )->get();

        // de esta forma al recuperar un producto recupero la categoria y las imagenes relacionadas
        //$producto = $this->producto->with(['categoria', 'productos_imagen'])->findOrFail($id);

        return response()->json([
            'data'=> $romaneo,
            'mensaje'=>'Successfully Retrieved by Id'
        ],200);

    }


    public function edit(Romaneo $romaneo)
    {
        //
    }


    public function update(Request $request, Romaneo $romaneo)
    {
        //
    }


    public function destroy(Romaneo $romaneo)
    {
        //
    }
}
