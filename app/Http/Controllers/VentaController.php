<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\VentaDetalle;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class VentaController extends Controller
{

    public function index(Request $request)
    {
        // aqui recibimos un json con el elemento a buscar
        $buscar = $request->buscar;

        if ($buscar==''){
            //$faenas = Ventas::orderBy('fae_codigo', 'desc')->get();

            $ventas = Venta::join('clientes as c','c.cli_codigo','ventas.cli_codigo')
                            ->select('ventas.*','c.cli_nombres as cli_nombres')
                            ->where([
                                ['origen','=','APP'],
                                ['vta_fecha_venta','>=','2023-01-01'],
                            ])->get();
        }
        else{
            $ventas = Venta::join('clientes as c','c.cli_codigo','ventas.cli_codigo')
                            ->select('ventas.*','c.cli_nombres as cli_nombres')
                            ->where([
                                ['origen','=','APP'],
                                ['vta_fecha_venta','>=','2023-01-01'],
                                ['c.cli_nombres', 'like','%'. $buscar . '%']
                            ])->get();
        }
        return response()->json([
            'data'=>$ventas,
            'mensaje'=>'Successfully Retrieved ventas'
        ],200);

    }

    public function create()
    {
        //
    }

    public function saveVenta(Request $request)
    {
        $data = $request;
        // de esta forma sacamos los detalles
        $detalles  = $data->detalles;
        $mensaje = '';
        // de esta forma recupero los detalles que viene en formato json
        //$data = $request->get("datos");
        //$vta_codigo = $request->get("vta_codigo");

        DB::beginTransaction();
        try {
            if ( $data->vta_codigo == 0 ){
                $venta = new Venta();
                $venta->fec_creacion = Carbon::now()->toDateTimeString();  //Carbon::now('America/Asuncion');
            }else{
                $venta = Venta::all()->find($data->vta_codigo);
                $venta->fec_modificacion = Carbon::now()->toDateTimeString();  //Carbon::now('America/Asuncion');
            }

            //$venta->vta_codigo = $data->vta_codigo;
            $venta->loc_codigo = $data->loc_codigo;
            $venta->tmv_codigo = $data->tmv_codigo;
            $venta->tcp_codigo = $data->tcp_codigo;
            $venta->cli_codigo = $data->cli_codigo;
            $venta->vta_nro_comprobante = $data->vta_nro_comprobante;
            $venta->vta_fecha_venta = Carbon::parse($data->vta_fecha_venta)->format('m/d/Y');
            $venta->vta_fecha_vencimiento = Carbon::parse($data->vta_fecha_vencimiento)->format('m/d/Y');
            $venta->vta_total_gravadas = $data->vta_total_gravadas;
            $venta->vta_total_exentas = $data->vta_total_exentas;
            $venta->per_codigo = $data->per_codigo;
            $venta->mon_codigo = $data->mon_codigo;
            $venta->vta_tipo_cambio = $data->vta_tipo_cambio;
            $venta->vta_total_factura = $data->vta_total_factura;
            $venta->vta_anulado = $data->vta_anulado;
            $venta->vta_nro_remision = $data->vta_nro_remision;
            $venta->vta_fecha_remision = Carbon::parse($data->vta_fecha_remision)->format('m/d/Y');
            $venta->fun_codigo = $data->fun_codigo;
            $venta->vta_porcentaje_descuento = $data->vta_porcentaje_descuento;
            $venta->vta_monto_descuento = $data->vta_monto_descuento;
            $venta->vta_nro_timbrado = $data->vta_nro_timbrado;
            $venta->asiento_id = $data->asiento_id;
            $venta->codigo_doc = $data->codigo_doc;
            $venta->loc_codigo_fiscal = $data->loc_codigo_fiscal;
            $venta->punto_emision = $data->punto_emision;
            $venta->vta_nro_factura = $data->vta_nro_factura;
            $venta->cuenta_contable = $data->cuenta_contable;
            $venta->vta_tipo = $data->vta_tipo;
            $venta->vta_saldo = $data->vta_saldo;
            $venta->vta_estado = $data->vta_estado;
            $venta->rom_nro_lote = $data->rom_nro_lote;
            $venta->vta_serie = $data->vta_serie;
            $venta->lp_codigo = $data->lp_codigo;
            $venta->dep_codigo = $data->dep_codigo;
            $venta->vta_doc_base = $data->vta_doc_base;
            $venta->vta_tipo_cambio_sys = $data->vta_tipo_cambio_sys;
            $venta->fun_codigo_creador =  $data->fun_codigo_creador;
            $venta->fun_codigo_modificador =  $data->fun_codigo_modificador;
            //$venta->fec_creacion =  $data->fec_creacion;
            //$venta->fec_modificacion =  $data->fec_modificacion;
            $venta->vta_observacion =  $data->vta_observacion;
            $venta->vta_iva5 =  $data->vta_iva5;
            $venta->vta_iva10 =  $data->vta_iva10;
            $venta->vta_exenta =  $data->vta_exenta;
            $venta->cf_codigo =  $data->cf_codigo;
            $venta->rc_codigo =  $data->rc_codigo;
            $venta->com_codigo_interno =  $data->com_codigo_interno;
            $venta->tipo_documento =  $data->tipo_documento;
            $venta->origen = $data->origen;
            $venta->user_id = $data->user_id;


            $venta->save();

            if ($venta){

                foreach($detalles as $ep=>$item)
                {
                    // si el item = 0 =, insertaremos el detall, sino lo actualizamos
                    if ( $item['dv_item'] == 0 ){
                        $detalle = new VentaDetalle();
                    }else{
                        $detalle = VentaDetalle::find($item['dv_item']);
                    }

                    $detalle->vta_codigo = $venta->vta_codigo;

                    $detalle->pro_codigo = $item['pro_codigo'];
                    $detalle->dv_cantidad = $item['dv_cantidad'];
                    $detalle->dv_precio_unitario = $item['dv_precio_unitario'];
                    //$detalle->dv_nro_lote = $item['dv_nro_lote'];
                    //$detalle->dv_vencimiento_lote = $item['dv_vencimiento_lote'];
                    $detalle->dv_iva = $item['dv_iva'];
                    $detalle->dv_exentas = $item['dv_exentas'];
                    $detalle->dv_gravadas = $item['dv_gravadas'];
                    $detalle->dv_porcentaje_descuento = $item['dv_porcentaje_descuento'];
                    $detalle->dv_monto_descuento = $item['dv_monto_descuento'];
                    $detalle->iva_codigo = $item['iva_codigo'];
                    $detalle->dep_codigo = $item['dep_codigo'];
                    $detalle->dv_impuesto = $item['dv_impuesto'];
                    $detalle->dv_costo_mercaderia = $item['dv_costo_mercaderia'];
                    $detalle->cuenta_contable = $item['cuenta_contable'];
                    $detalle->dv_cantidad_res = $item['dv_cantidad_res'];
                    $detalle->lp_codigo = $item['lp_codigo'];
                    $detalle->dv_impuesto_a_desc = $item['dv_impuesto_a_desc'];
                    $detalle->dv_total_sin_iva = $item['dv_total_sin_iva'];
                    $detalle->dv_impuesto_d_desc = $item['dv_impuesto_d_desc'];
                    $detalle->dv_total_d_desc = $item['dv_total_d_desc'];
                    //$detalle->dv_item = $item['dv_item'];

                    $detalle->save();

                }

                DB::commit();
                // si llega aqui es por que fue exitoso el registro
                $mensaje='Registro grabado con existo';
            }else{
                $mensaje='No se pudo grabar el registro';
            }

        } catch (\Exception $exp) {
            $venta='';
            $mensaje=$exp->getMessage();

            DB::rollBack();
            //$mensaje = $exp->getMessage();
            //$this->emit('sale-error', $exp->getMessage());
        }

        // esto normalmente debemos traer de la DB
        //$romaneo->cli_nombres = $data->cli_nombres;   // solo es una prueba

        return response()->json([
            'data'=>$venta,
            'mensaje'=> $mensaje
        ],200);

    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $venta = Venta::join('clientes as c','c.cli_codigo','ventas.cli_codigo')
        ->select('ventas.*','c.cli_nombres as cli_nombres')
        ->where('ventas.vta_codigo', '=', $id )->get();

        // de esta forma al recuperar un producto recupero la categoria y las imagenes relacionadas
        //$producto = $this->producto->with(['categoria', 'productos_imagen'])->findOrFail($id);

        return response()->json([
            'data'=> $venta,
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
