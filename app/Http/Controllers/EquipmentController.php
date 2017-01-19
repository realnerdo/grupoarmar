<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\EquipmentDetail;
use App\Brand;
use App\Group;
use App\Warehouse;
use App\Picture;
use Illuminate\Http\Request;
use App\Http\Requests\EquipmentRequest;
use Excel;
use Carbon\Carbon;

class EquipmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipments = Equipment::latest()->paginate(5);
        return view('equipos.index', compact('equipments'));
    }

    /**
     * Get a json object of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEquipments(Request $request)
    {
        $this_start = Carbon::createFromFormat('Y-m-d', $request->input('date_start'));
        $this_end = Carbon::createFromFormat('Y-m-d', $request->input('date_end'));

        $equipments = Equipment::latest()
            ->where('title', 'like', '%'.$request->input('q').'%')
            ->orWhere('folio', 'like', '%'.$request->input('q').'%')
            ->orWhere('description', 'like', '%'.$request->input('q').'%')
            ->with('brand', 'group', 'warehouse', 'equipment_details')->get();

        $data = ['items' => [], 'total_count' => $equipments->count()];
        $availables = 0;
        $unavailables = 0;

        foreach ($equipments as $equipment) {
            foreach ($equipment->equipment_details as $equipment_detail) {
                $available = true;

                $service_details = $equipment_detail->service_details()->get();
                if(!$service_details->isEmpty()){
                    foreach ($service_details as $service_detail) {
                        $pending = $service_detail->service()->pending()->first();
                        if($pending){
                            if(
                                ($this_end < $pending->date_start) ||
                                ($this_start > $pending->date_end)
                            ){
                                $available = true;
                            } else{
                                $available = false;
                            }
                        }

                        $active = $service_detail->service()->active()->first();
                        if($active){
                            if(
                                ($this_end < $pending->date_start) ||
                                ($this_start > $pending->date_end)
                            ){
                                $available = true;
                            } else{
                                $available = false;
                            }
                        }
                    }
                }

                if($available){
                    $availables++;
                }else{
                    $unavailables++;
                }
            }

            $push = [
                'id' => $equipment->id,
                'text' => $equipment->title,
                'folio' => $equipment->folio,
                'title' => $equipment->title,
                'description' => $equipment->description,
                'stock' => $equipment->stock,
                'brand' => $equipment->brand->title,
                'group' => $equipment->group->title,
                'warehouse' => $equipment->warehouse->title,
                'availables' => $availables,
                'unavailables' => $unavailables
            ];
            array_push($data['items'], $push);
        }
        return $data;
    }

    /**
     * Get the json of the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEquipmentById($id)
    {
        $equipment = Equipment::with('brand', 'group', 'warehouse')
            ->find($id);
        return $equipment;
    }

    /**
     * Export to Excel the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportExcel()
    {
        $xls = Excel::create('equipos', function($excel) {
            $excel->setTitle('Equipos');
            $excel->sheet('Equipos', function($sheet) {
                $equipments = Equipment::all();
                $sheet->fromModel($equipments);
            });
        });
        return $xls->download('xls');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::pluck('title', 'id');
        $brands = [''=>''] + $brands->toArray();
        $groups = Group::pluck('title', 'id');
        $groups = [''=>''] + $groups->toArray();
        $warehouses = Warehouse::pluck('title', 'id');
        $warehouses = [''=>''] + $warehouses->toArray();
        return view('equipos.create', compact('brands', 'groups', 'warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\EquipmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EquipmentRequest $request)
    {
        if(!is_numeric($request->input('brand_id'))){
            $brand = Brand::create([
                'title' => $request->input('brand_id'),
                'description' => $request->input('brand_id')
            ]);
            $request->merge(['brand_id' => $brand->id]);
        } else {
            $brand = Brand::find($request->input('brand_id'));
        }

        if(!is_numeric($request->input('group_id'))){
            $group = Group::create([
                'title' => $request->input('group_id'),
                'description' => $request->input('group_id')
            ]);
            $request->merge(['group_id' => $group->id]);
        } else {
            $group = Group::find($request->input('group_id'));
        }

        if(!is_numeric($request->input('warehouse_id'))){
            $warehouse = Warehouse::create([
                'title' => $request->input('warehouse_id'),
                'description' => $request->input('warehouse_id')
            ]);
            $request->merge(['warehouse_id' => $warehouse->id]);
        }

        $group_folio = str_replace(' ', '', strtoupper(substr($group->title, 0, 2)));
        $brand_folio = str_replace(' ', '', strtoupper(substr($brand->title, 0, 2)));
        $title_folio = str_replace(' ', '', strtoupper(substr($request->input('title'), 0, 2)));
        $folio_first = $group_folio.$brand_folio.$title_folio;
        $request->merge(['folio' => $folio_first]);

        $equipment = Equipment::create($request->all());

        for ($i=0; $i < $request->input('stock'); $i++) {
            $latest_folio = EquipmentDetail::where('folio', 'like', $folio_first.'%')->orderBy('id', 'desc')->first();
            $latest = (is_null($latest_folio)) ? sprintf('%05d', 1) : sprintf('%05d', (substr($latest_folio->folio, -5) + 1));
            $folio = $folio_first.'-'.$latest;
            $equipment->equipment_details()->create([
                'folio' => $folio
            ]);
        }

        session()->flash('flash_message', 'Se ha agregado el equipo: '.$equipment->title);
        return redirect('equipos');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment $equipment)
    {
        $brands = Brand::pluck('title', 'id');
        $brands = [''=>''] + $brands->toArray();
        $groups = Group::pluck('title', 'id');
        $groups = [''=>''] + $groups->toArray();
        $warehouses = Warehouse::pluck('title', 'id');
        $warehouses = [''=>''] + $warehouses->toArray();
        return view('equipos.edit', compact('equipment', 'brands', 'groups', 'warehouses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EquipmentRequest  $request
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(EquipmentRequest $request, Equipment $equipment)
    {
        if(!is_numeric($request->input('brand_id'))){
            $brand = Brand::create([
                'title' => $request->input('brand_id'),
                'description' => $request->input('brand_id')
            ]);
            $request->merge(['brand_id' => $brand->id]);
        } else {
            $brand = Brand::find($request->input('brand_id'));
        }

        if(!is_numeric($request->input('group_id'))){
            $group = Group::create([
                'title' => $request->input('group_id'),
                'description' => $request->input('group_id')
            ]);
            $request->merge(['group_id' => $group->id]);
        } else {
            $group = Group::find($request->input('group_id'));
        }

        if(!is_numeric($request->input('warehouse_id'))){
            $warehouse = Warehouse::create([
                'title' => $request->input('warehouse_id'),
                'description' => $request->input('warehouse_id')
            ]);
            $request->merge(['warehouse_id' => $warehouse->id]);
        }

        $group_folio = str_replace(' ', '', strtoupper(substr($group->title, 0, 2)));
        $brand_folio = str_replace(' ', '', strtoupper(substr($brand->title, 0, 2)));
        $title_folio = str_replace(' ', '', strtoupper(substr($request->input('title'), 0, 2)));
        $folio_first = $group_folio.$brand_folio.$title_folio;
        $request->merge(['folio' => $folio_first]);

        $current_stock = $equipment->stock;

        $equipment->update($request->all());

        if($request->input('stock') > $current_stock){
            $new_ones = $request->input('stock') - $current_stock;
            for ($i=0; $i < $new_ones; $i++) {
                $latest_folio = EquipmentDetail::where('folio', 'like', $folio_first.'%')->orderBy('id', 'desc')->first();
                $latest = (is_null($latest_folio)) ? sprintf('%05d', 1) : sprintf('%05d', (substr($latest_folio->folio, -5) + 1));
                $folio = $folio_first.'-'.$latest;
                $equipment->equipment_details()->create([
                    'folio' => $folio
                ]);
            }
        }

        session()->flash('flash_message', 'Se ha actualizado el equipo: '.$equipment->title);
        return redirect('equipos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment)
    {
        $equipment->delete();
        session()->flash('flash_message', 'Se ha eliminado el equipo');
        return redirect('equipos');
    }
}
