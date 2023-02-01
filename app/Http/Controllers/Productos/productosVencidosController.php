<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use App\Models\Productos\Productos;
use App\Models\Stock\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class productosVencidosController extends Controller
{
    public function productosVencidos(Request $request)


    {

        $productos = Productos::with(['Stock.precio_compra', 'precio', 'categoria', 'unidad_medida'])->get();

        // $productos = Stock::with(['productos:id,nombre', 'precio_compra:id,precio', 'productos.precio:id_prod,precio as precio_venta'])->whereBetween("fecha_venc", ['01/12/2022', '31/01/2023'])->get();
        return ($productos);
    }
}
