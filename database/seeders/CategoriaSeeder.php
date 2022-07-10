<?php

namespace Database\Seeders;

use App\Models\Categoria\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = [
            "abarrotes",
            "verduras",
            "frutas",
            "lácteos",
            "bebidas",
            "chuchería",
            "pan",
            "emburtidos",
            "Aseo del Hogar",
            "Aseo personal",

        ];

        // // $countries = json_decode($json,true);
        // $jsons = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json), true);
        // Log::error($json);


        foreach ($json as $key => $value) {

            // Log::error($value);


            Categoria::create([
                'nombre' => $value,
            ]);
        }
    }
}
