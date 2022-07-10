<?php

namespace Database\Seeders;

use App\Models\PrecioCompra\PrecioCompra;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PrecioCompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = Storage::disk('local')->get('data/precio_compra.json');

        // $countries = json_decode($json,true);
        $jsons = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json), true);
        // Log::error($jsons);


        foreach ($jsons as $key => $value) {
            PrecioCompra::create([
                'id_stock' =>$value['id_stock'],
                'precio' =>$value['precio'],
                'fecha' =>$value['fecha'],
            ]);
        }
    }
}
