<?php

use Illuminate\Database\Seeder;
use App\Equipment;
use App\Brand;
use App\Group;
use App\Warehouse;

class EquipmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brand = Brand::first();
        $group = Group::first();
        $warehouse = Warehouse::first();
        Equipment::create([
            'title' => 'Bocinas',
            'description' => 'Bocinas para fiesta',
            'serial' => '9889-1',
            'stock' => 10,
            'brand_id' => $brand->id,
            'group_id' => $group->id,
            'warehouse_id' => $warehouse->id
        ]);
    }
}
