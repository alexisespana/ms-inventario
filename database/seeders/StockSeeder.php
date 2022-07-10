<?php

namespace Database\Seeders;

use App\Models\Productos\Productos;
use App\Models\Stock\Stock;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Stringable;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        $json = Storage::disk('local')->get('data/stock.json');

        // $countries = json_decode($json,true);
        $jsons = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json), true);
        // Log::error($jsons);


        foreach ($jsons as $key => $value) {
            Stock::create([
                'id_prod' =>$value['id_prod'],
                'cantidad' => $value['cantidad'],
                'fecha_ingreso' => $value['fecha_ingreso'],
                'fecha_venc' => $value['fecha_venc'],
            ]);
        }
    
    }
}
