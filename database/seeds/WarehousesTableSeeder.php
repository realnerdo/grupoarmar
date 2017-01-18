<?php

use Illuminate\Database\Seeder;
use App\Warehouse;

class WarehousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Warehouse::create(['title' => 'Un almacén', 'address' => 'Calle 13']);
    }
}
