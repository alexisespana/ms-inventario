<?php

namespace Database\Seeders;

use App\Models\UnidadMedida\UnidadMedida;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UnidadMedidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    $json = Storage::disk('local')->get('data/unidad_medida.json');

        // $countries = json_decode($json,true);
        $jsons = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json), true);
        //  Log::error($jsons);


        foreach ($jsons as $key => $value) {

            // Log::error($value['nombre']);


            UnidadMedida::create([
                'nombre' => $value['nombre'],
                'simbolo' => $value['simbolo'],
               
            ]);
        }
    }
}
