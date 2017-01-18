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
        $group_folio = str_replace(' ', '', strtoupper(substr($group->title, 0, 2)));
        $title_folio = str_replace(' ', '', strtoupper(substr('Bocinas', 0, 2)));
        $latest_folio = Equipment::where('folio', 'like', $group_folio.$title_folio.'%')->first();
        $latest = (is_null($latest_folio)) ? sprintf('%05d', 1) : sprintf('%05d', substr($latest_folio, -5));
        $folio = $group_folio.$title_folio.'-'.$latest;
        Equipment::create([
            'folio' => $folio,
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
