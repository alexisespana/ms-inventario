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
            'fecha' => date("Y-m-d"),
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
            if (isset($request['fecha_hoy'])) {
                //  $query->whereBetween('fecha', ['2022-11-01','2022-11-31']);
                $query->whereBetween('fecha', [$request['fecha_hoy'], $request['fecha_mañana']]);
            };
        })->orderBy('cod_operacion', 'ASC')->get();

        Log::alert($request['fecha_hoy']. $request['fecha_mañana']);

        //
       // $this->aumentoVentas($cantidad_aumentar= 100000, $DiaAumento='2023-01-04');

        return ($productos);
    }

    public function aumentoVentas($cantidad_aumentar, $DiaAumento)
    {
       
        $ventasMes = Ventas::with(['productos.categoria'])
            ->whereBetween('fecha', [$DiaAumento,$DiaAumento])->get();

        $totalVentas = 0;
        foreach ($ventasMes as $key => $value1) {
            $totalVentas += str_replace(['$', '.', ',00'], ['', '', ''], substr($value1->valor_compra, 0, -3));
        }
        foreach ($ventasMes as $key => $value) {
            $fechanew = str_replace('-11-', "-12-", $value->fecha);

           $ventasEncontrada = Ventas::with(['ventas_prod'])
                   ->whereNotBetween('fecha', ['2022-11-01', '2022-11-31'])->inRandomOrder()->first();
                  
            if ($totalVentas < $cantidad_aumentar) {
       

                $ventasEncontrada = Ventas::with(['ventas_prod'])
                   ->whereNotBetween('fecha', ['2022-11-01', '2022-11-31'])->inRandomOrder()->first();
                  
                   
                   if ($value->medio_pago == 1) {  // SI EL METODO DE PAGO ES EN EFECTIVO SE BUSCA UNA COMPRA EN EFECTIVO PARA SUMARLE 1 AL CODIGO ENCONTRADO
                   
                    $ventasEncontrada->nroBoleta = Ventas::where('medio_pago', 1)->count();
                } 
    
    

            //  $cant_prod = array_sum($request->cantidad);
              $ventas = Ventas::create([
                'medio_pago' =>  $ventasEncontrada->medio_pago,
                'suma_prod' =>  $ventasEncontrada->suma_prod,
                'cant_prods' => $ventasEncontrada->cant_prods,
                'valor_compra' =>  $ventasEncontrada->valor_compra,
                'pagado' =>  $ventasEncontrada->pagado,
                'cambio' =>  $ventasEncontrada->cambio,
                'procesada' => '1',
                'cod_operacion' => $ventasEncontrada->cod_operacion,
                'fecha'=> $value->fecha,
            ]);
       
    
    
            foreach ($ventasEncontrada->ventas_prod as $key => $codigo) {
                
                  
                    $Ventas_prod = Ventas_prod::create([
                        'id_venta' => $codigo->id_venta,
                        'id_prod' => $codigo->id_prod
                    ]);
    
                    }
                    
                    
                
                Log::alert($codigo->id_venta.'- '. $ventasEncontrada->id);
    } // hasta que la suma del total de las ventas de igual al valor asignado


            /* foreach ($productos as $key => $value) {
            $fechanew = str_replace('-11-', "-12-", $value->fecha);
            $ventas = Ventas::with(['productos.categoria'])
                ->where('fecha',  $fechanew)->first();
                if ($ventas) {
          //  Log::alert($value->id.' '.$ventas->id);
                }
           

            $fechanew = '';
        }*/
        }
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
