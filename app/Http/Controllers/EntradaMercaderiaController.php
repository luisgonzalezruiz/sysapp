<?php

namespace App\Http\Controllers;

use App\Models\EntradaMercaderia;
use App\Models\EntradaMercaderiaDetalle;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class EntradaMercaderiaController extends Controller
{

    public function index(Request $request)
    {
        // aqui recibimos un json con el elemento a buscar
        $buscar = $request->buscar;

        if ($buscar==''){

            $entradas = EntradaMercaderia::select('*')
                                    //->where('em_codigo','=',2410)
                                    ->orderBy('em_codigo', 'desc')->get();
        }
        else{
            $entradas = EntradaMercaderia::whereRaw('LOWER(em_nro_comprobante) like (?)', ["%{$buscar}%"])
                              ->orderBy('em_codigo', 'desc')->get();
        }

        return response()->json([
            'data'=>$entradas,
            'mensaje'=>'Successfully Retrieved ventas'
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
    public function saveEntrada(Request $request)
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
            if ( $data->em_codigo == 0 ){
                $entrada = new EntradaMercaderia();
                $entrada->fec_creacion = Carbon::now()->toDateTimeString();  
            }else{
                $entrada = EntradaMercaderia::all()->find($data->rom_codigo);
                $entrada->fec_modificacion = Carbon::now()->toDateTimeString();  
            }

            //$entrada->em_codigo = $data->em_codigo;
            $entrada->loc_codigo = $data->loc_codigo;
            $entrada->tmv_codigo = $data->tmv_codigo;
            $entrada->tcp_codigo = $data->tcp_codigo;
            $entrada->em_nro_comprobante = $data->em_nro_comprobante;
            $entrada->em_fecha_entrada = Carbon::parse($data->rom_fecha)->format('m/d/Y');
            $entrada->mon_codigo = $data->mon_codigo; 
            $entrada->em_tipo_cambio = $data->em_tipo_cambio; 
            $entrada->asiento_id = $data->asiento_id; 
            $entrada->em_codigo_doc = $data->em_codigo_doc; 
            $entrada->em_estado = $data->em_estado; 
            $entrada->dep_codigo = $data->dep_codigo; 
            $entrada->fun_codigo_creador = $data->fun_codigo_creador; 
            $entrada->fun_codigo_modificador = $data->fun_codigo_modificador;
            $entrada->em_observacion = $data->em_observacion; 
            $entrada->em_tipo_cambio_sys = $data->em_tipo_cambio_sys; 
            $entrada->em_novillo = $data->em_novillo; 
            $entrada->em_vaquilla = $data->em_vaquilla; 
            $entrada->em_vaca = $data->em_vaca; 
            $entrada->em_toro = $data->em_toro; 
            $entrada->em_total_kilos = $data->em_total_kilos; 
            $entrada->em_cantidad_reses = $data->em_cantidad_reses; 
            $entrada->user_id = $data->user_id;
            $entrada->origen = $data->origen;

            $entrada->save();

            if ($entrada){

                foreach($detalles as $ep=>$item)
                {
                    // si el item = 0 =, insertaremos el detall, sino lo actualizamos
                    if ( $item['emd_item'] == 0 ){
                        $detalle = new EntradaMercaderiaDetalle();
                    }else{
                        $detalle = EntradaMercaderiaDetalle::find($item['emd_item']);
                    }

                    $detalle->em_codigo = $entrada->em_codigo;
                    //$detalle->emd_item = $item['emd_item']; 
                    $detalle->pro_codigo = $item['pro_codigo']; 
                    $detalle->emd_cantidad = $item['emd_cantidad']; 
                    $detalle->emd_precio_unitario = $item['emd_precio_unitario']; 
                    $detalle->dep_codigo = $item['dep_codigo']; 
                    $detalle->cuenta_contable = $item['cuenta_contable']; 
                    $detalle->ca_codigo = $item['ca_codigo']; 
                    $detalle->em_costo_mercaderia = $item['em_costo_mercaderia']; 
                    $detalle->emd_cantidad_res = $item['emd_cantidad_res']; 
                    $detalle->emd_kilos = $item['emd_kilos']; 
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
            'data'=>$entrada,
            'mensaje'=> $mensaje
        ],200);

    }


    public function show($id)
    {
        //$entrada = EntradaMercaderia::join('locales as c','c.loc_codigo','entradas_mercaderias_app.loc_codigo')
        //->select('entradas_mercaderias_app.*','c.loc_descripcion')
       // ->where('entradas_mercaderias_app.em_codigo', '=', $id )->get();

        // de esta forma al recuperar la entrada recupero los detalles relacionados
        $entrada = EntradaMercaderia::orderBy('em_codigo', 'desc')
                                    ->with('entrada_detalles')->get();
        return response()->json([
            'data'=> $entrada,
            'mensaje'=>'Successfully Retrieved by Id'
        ],200);       
        

    }

    public function edit(EntradaMercaderia $entradaMercaderia)
    {
        //
    }


    public function update(Request $request, EntradaMercaderia $entradaMercaderia)
    {
        //
    }


    public function destroy(EntradaMercaderia $entradaMercaderia)
    {
        //
    }

}
