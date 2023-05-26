<?php

namespace App\Http\Controllers;

use App\Models\RomaneoCorte;
use App\Models\RomaneoCorteDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class RomaneoCorteController extends Controller
{

    public function index(Request $request)
    {
        // aqui recibimos un json con el elemento a buscar
        $buscar = $request->buscar;

        if ($buscar==''){
            //$faenas = Romaneo::orderBy('fae_codigo', 'desc')->get();
            $romaneos = RomaneoCorte::join('clientes as c','c.cli_codigo','romaneo_cortes_app.cli_codigo')
                            //->where('rc_codigo','=',12256)
                            ->select('romaneo_cortes_app.*','c.cli_nombres as cli_nombres')->get();
        }
        else{
            $romaneos = RomaneoCorte::join('clientes as c','c.cli_codigo','romaneo_cortes_app.cli_codigo')
                            ->select('romaneo_cortes_app.*','c.cli_nombres as cli_nombres')
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

    public function saveCorte(Request $request)
    {
        $data = $request;
        // de esta forma sacamos los detalles
        $detalles  = $data->detalles;
        $mensaje = '';

        DB::beginTransaction();
        try {
            if ( $data->rom_codigo == 0 ){
                $romaneo = new RomaneoCorte();
                //$romaneo->fecha_carga = Carbon::now()->toDateTimeString();  //Carbon::now('America/Asuncion');
            }else{
                $romaneo = RomaneoCorte::all()->find($data->rom_codigo);
                //$romaneo->fecha_modifica = Carbon::now()->toDateTimeString();  //Carbon::now('America/Asuncion');
            }

            //$romaneo->rc_codigo = $data->rc_codigo;
            $romaneo->loc_codigo = $data->loc_codigo;
            $romaneo->rc_lote = $data->rc_lote;
            $romaneo->rc_fecha = Carbon::parse($data->rom_fecha)->format('m/d/Y');
            $romaneo->rc_cantidad = $data->rc_cantidad;
            $romaneo->rc_total_kilos = $data->rc_total_kilos;
            $romaneo->rc_responsable = $data->rc_responsable;
            $romaneo->rc_obs = $data->rc_obs;
            $romaneo->cli_codigo = $data->cli_codigo;
            $romaneo->rc_nro_comprobante = $data->rc_nro_comprobante;
            $romaneo->rc_cantidad_kilos = $data->rc_cantidad_kilos;
            $romaneo->rep_codigo = $data->rep_codigo;
            $romaneo->user_id = $data->user_id;
            $romaneo->save();

            if ($romaneo){
                foreach($detalles as $ep=>$item)
                {
                    // si el item = 0 =, insertaremos el detall, sino lo actualizamos
                    if ( $item['rcd_item'] == 0 ){
                        $detalle = new RomaneoCorteDetalle();
                    }else{
                        $detalle = RomaneoCorteDetalle::find($item['rcd_item']);
                    }
                    $detalle->rc_codigo = $romaneo->rc_codigo;
                    //$detalle->rcd_item = $item['rcd_item'];    // se autogenera
                    $detalle->pro_codigo = $item['pro_codigo'];
                    $detalle->rcd_cantidad = $item['rcd_cantidad'];
                    $detalle->rcd_precio = $item['rcd_precio'];
                    $detalle->em_codigo = $item['em_codigo'];
                    $detalle->rcd_kilos = $item['rcd_kilos'];
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

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $romaneo = RomaneoCorte::join('clientes as c','c.cli_codigo','romaneo_cortes_app.cli_codigo')
        ->select('romaneo_cortes_app.*','c.cli_nombres as cli_nombres')
        ->where('romaneo_cortes_app.rc_codigo', '=', $id )->get();

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
