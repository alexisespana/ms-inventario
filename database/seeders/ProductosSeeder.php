<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Productos\Productos;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $json = Storage::disk('local')->get('data/productos.json');

        // $countries = json_decode($json,true);
        $jsons = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json), true);
        // Log::error($jsons);


        foreach ($jsons as $key => $value) {
            $precio_promo = '';
            $unid_med =1;


            if (in_array($key,[0,1,3,5])) {
               
               $precio_promo = rand(2, 10);
            }
            else{
                $unid_med =2;
            }
            Productos::create([
                'codigo' => $value['codigo'],
                'nombre' => $value['nombre'],
                'promo' => $precio_promo,
                
                'categoria' => '1',
                'unidad_medida' => $unid_med,
            ]);
        }
    }
}
