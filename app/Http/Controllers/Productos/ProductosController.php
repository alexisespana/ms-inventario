<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use App\Models\Categoria\Categoria;
use App\Models\PrecioCompra\PrecioCompra;
use App\Models\Precios\Precios;
use App\Models\Productos\Productos;
use App\Models\Stock\Stock;
use App\Models\UnidadMedida\UnidadMedida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductosController extends Controller
{
    public function format_precio($valor)
    {
        $format = $valor;
        if (isset($valor)) {
            $format =  str_replace('.', '', $valor);
        }

        return $format;
    }

    public function listaProductos(Request $request)
    {
        // return ($request);
        $productos = Productos::with(['Stock.precio_compra', 'precio', 'categoria', 'unidad_medida'])->when($request, function ($query) use ($request) {
            if (isset($request['codigo'])){
                 $query->where('codigo', $request['codigo']);
            }elseif (isset($request['like'])){
                $query->where('nombre','like', '%'.$request['like'].'%');
           }
            ;
        })->get();
        return ($productos);
    }

    public function IngresarProductos(Request $request)
    {
        $unidadMedida = UnidadMedida::all();
        $Categoria = Categoria::all();



        return array('unidadMedida' => $unidadMedida, 'categoria' => $Categoria);
    }

    public function Registrar(Request $request)
    {



        // $request['codigo'],
        // $request['nombre'],
        // $request['cantidad'],
        // $request['precio'],

        //  return($request->all());
        $productos = Productos::create([
            'codigo' => $request['codigo'],
            'nombre' => $request['nombre_prod'],
            'categoria' => $request['categoria'],
            'unidad_medida' => $request['unidad_medida'],
            'cantidad' => $request['cantidad'],
            'promo' => $this->format_precio($request['cant_promo']),
            'fecha_compra' => date('d-m-Y'),
            'fecha_venc' => $request['fecha_venc'],
        ]);

        Log::alert($productos);


        //  return $productos;


        if ($productos) {

            $Precios = Precios::create([
                'id_prod' => $productos["id"],
                'precio' => $this->format_precio($request['precio_venta']),
                'precio_promo' => $this->format_precio($request['precio_promo']),
                'fecha_inicio' => date('d/m/Y'),
                'fecha_fin' => date('d/m/Y'),
                'vigente' => '1',
            ]);
            $stock = Stock::create([
                'id_prod' => $productos["id"],
                'cantidad' => $request['cantidad'],
                'fecha_ingreso' => date('d/m/Y'),
                'fecha_venc' => $request['fecha_venc'],
                'id_marca' => '1',
            ]);

            $precio_compra = PrecioCompra::create([
                'id_stock' => $stock["id"],
                'precio' => $this->format_precio($request['precio_compra']),
                'fecha' => date('d/m/Y'),

            ]);
        }

        return ($productos);
    }

    public function Editar(Request $request)
    {

        // return $request;

        $productos = Productos::with(['Stock', 'precio'])->find($request["id"]);
        $productos->nombre = $request["nombre"];
        $productos->save();

        if ($productos) {

            $Precios = Precios::where('id_prod', $productos->id)->update([
                'precio' => $request['precio'],
                'fecha_inicio' => date('d/m/Y'),
                'fecha_fin' => date('d/m/Y'),
                'vigente' => '1',
            ]);
            $stock = Stock::where('id_prod', $productos->id)->update([
                'id_prod' => $productos["id"],
                'cantidad' => $request['cantidad'],
                'fecha_ingreso' => date('d/m/Y'),
                'fecha_venc' => date('d/m/Y')

            ]);

            // Log::info($productos);

            return $productos;
        }
    }
}
