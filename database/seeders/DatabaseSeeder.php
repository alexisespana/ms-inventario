<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UnidadMedidaSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(ProductosSeeder::class);
        $this->call(StockSeeder::class);
        $this->call(PrecioSeeder::class);
        $this->call(PrecioCompraSeeder::class);
    }
}
