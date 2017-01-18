<?php

use Illuminate\Database\Seeder;
use App\Equipment;
use App\EquipmentDetail;
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
        $title = 'Bocinas';

        $group_folio = str_replace(' ', '', strtoupper(substr($group->title, 0, 2)));
        $brand_folio = str_replace(' ', '', strtoupper(substr($brand->title, 0, 2)));
        $title_folio = str_replace(' ', '', strtoupper(substr($title, 0, 2)));
        $folio_first = $group_folio.$brand_folio.$title_folio;

        $stock = 10;
        $equipment = Equipment::create([
            'folio' => $folio_first,
            'title' => $title,
            'description' => 'Bocinas para fiesta',
            'stock' => $stock,
            'brand_id' => $brand->id,
            'group_id' => $group->id,
            'warehouse_id' => $warehouse->id
        ]);

        for ($i=0; $i < $stock; $i++) {
            $latest_folio = EquipmentDetail::where('folio', 'like', $folio_first.'%')->orderBy('id', 'desc')->first();
            $latest = (is_null($latest_folio)) ? sprintf('%05d', 1) : sprintf('%05d', (substr($latest_folio->folio, -5) + 1));
            $folio = $folio_first.'-'.$latest;
            $equipment->equipment_details()->create([
                'folio' => $folio
            ]);
        }
    }
}
