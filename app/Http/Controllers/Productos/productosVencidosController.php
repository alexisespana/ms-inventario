<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use App\Models\Stock\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class productosVencidosController extends Controller
{
    public function productosVencidos(Request $request)


    {
             $productos = DB::table("stock as st")
        ->join("productos as p", function($join){
            $join->on("p.id", "=", "st.id_prod");
        })
        ->join("precios as p2", function($join){
            $join->on("p2.id_prod", "=", "p.id");
        })
        ->join("precio_compra as pc", function($join){
            $join->on("pc.id_stock", "=", "st.id");
        })
        ->select("p.id", "p.nombre", "st.cantidad", "p2.precio as porecio_venta", "pc.precio as precio_compra", "st.fecha_ingreso", "st.fecha_venc")
        // ->whereBetween("st.fecha_venc", ['01/12/2022','31/01/2023'])
        ->get();
        // $productos = Stock::with(['productos:id,nombre', 'precio_compra:id,precio', 'productos.precio:id_prod,precio as precio_venta'])->whereBetween("fecha_venc", ['01/12/2022', '31/01/2023'])->get();
        return ($productos);
    }
}
