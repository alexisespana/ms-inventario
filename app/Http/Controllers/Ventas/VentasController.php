<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Models\Productos\Productos;
use App\Models\Ventas\Ventas;
use App\Models\Ventas_pdod\Ventas_prod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VentasController extends Controller
{
    public function RegistarVenta(Request $request)
    {




        // return($request->all());
        if (!isset($request->nroBoleta)) {  // SI EL METODO DE PAGO ES EN EFECTIVO SE BUSCA UNA COMPRA EN EFECTIVO PARA SUMARLE 1 AL CODIGO ENCONTRADO
            $request->metodoPago = 1;

            $request->nroBoleta = Ventas::where('medio_pago', 1)->count();
        } else {
            $request->metodoPago = 2;
            $request->cant_efectivo = 0;
            $request->vuelto = 0;
        }

        $cant_prod = array_sum($request->cantidad);
        $ventas = Ventas::create([
            'medio_pago' =>  $request->metodoPago,
            'suma_prod' =>  $cant_prod,
            'cant_prods' => json_encode($request->cantidad),
            'valor_compra' =>  $request->precioTotal,
            'pagado' =>  $request->cant_efectivo,
            'cambio' =>  $request->vuelto,
            'procesada' => '1',
            'cod_operacion' => $request->nroBoleta,
        ]);

        if ($ventas) {



            foreach ($request->codigo as $key => $codigo) {
                $productos = Productos::with(['Stock'])->where('codigo', $codigo)->first();

                $Ventas_prod = Ventas_prod::create([
                    'id_venta' => $ventas->id,
                    'id_prod' => $productos->id
                ]);

                $stock = DB::table('stock')
                    ->where('id_prod', $productos->id)
                    ->update(['cantidad' => ($productos->Stock->cantidad - ($request->cantidad[$key]))]);
            }

            return $ventas;
        }
    }

    public function ListarVentas(Request $request)
    {
        $productos = Ventas::with(['productos.categoria'])->when($request, function ($query) use ($request) {
            if (isset($request['codigo'])) $query->where('id', $request['codigo']);
        })->orderBy('created_at','ASC')->get();

        return ($productos);
    }

    public function DetallesVentas(Request $request)
    {
        //    return($request->all());

        $productos = Ventas::with(['productos.categoria', 'productos.precio'])->when($request, function ($query) use ($request) {
            if (isset($request['codigo'])) $query->where('id', $request['codigo']);
        })->get();

        // return($productos[0]->cant_prods[6]);

        return ($productos);
    }
}
