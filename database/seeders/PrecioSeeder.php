<?php

namespace Database\Seeders;

use App\Models\Precios\Precios;
use App\Models\Productos\Productos;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PrecioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = Storage::disk('local')->get('data/precios.json');

        // $countries = json_decode($json,true);
        $jsons = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json), true);
        // Log::error($jsons);


        foreach ($jsons as $key => $value) {
        Log::error($value);

            Precios::create([
                'id_prod' =>  $value['id_prod'],    
                'precio' =>  $value['precio'], 
                'precio_promo' =>  $value['precio_promo'], 
                'fecha_inicio' =>  $value['fecha_inicio'], 
                'fecha_fin' =>  $value['fecha_fin'], 
                'vigente' =>  $value['vigente'], 
            ]);
        }
    }
}
