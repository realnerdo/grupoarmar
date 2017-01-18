<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\Brand;
use App\Group;
use App\Warehouse;
use App\Picture;
use Illuminate\Http\Request;
use App\Http\Requests\EquipmentRequest;
use Excel;

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
        $equipments = Equipment::latest()
            ->where('title', 'like', '%'.$request->input('q').'%')
            ->orWhere('serial', $request->input('q'))
            ->with('pictures', 'brand', 'group', 'warehouse')->get();
        $data = ['items' => [], 'total_count' => $equipments->count()];
        foreach ($equipments as $equipment) {
            $picture = (isset($equipment->pictures[0])) ? url('storage/'.$equipment->pictures[0]->url) : null;
            $push = [
                'id' => $equipment->id,
                'text' => $equipment->title,
                'title' => $equipment->title,
                'description' => $equipment->description,
                'serial' => $equipment->serial,
                'stock' => $equipment->stock,
                'brand' => $equipment->brand->title,
                'group' => $equipment->group->title,
                'warehouse' => $equipment->warehouse->title,
                'picture' => $picture
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
        $equipment = Equipment::with('pictures', 'brand', 'group', 'warehouse')
            ->find($id);
        $equipment->picture = (isset($equipment->pictures[0])) ? url('storage/'.$equipment->pictures[0]->url) : null;
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
        $title_folio = str_replace(' ', '', strtoupper(substr($request->input('title'), 0, 2)));
        $latest_folio = Equipment::where('folio', 'like', $group_folio.$title_folio.'%')->first();
        $latest = (is_null($latest_folio)) ? sprintf('%05d', 1) : (sprintf('%05d', substr($latest_folio->folio, -5) + 1));
        $folio = $group_folio.$title_folio.'-'.$latest;
        $request->merge(['folio' => $folio]);

        $equipment = Equipment::create($request->all());

        if($request->hasFile('photos')){
            foreach ($request->file('photos') as $photo) {
                $url = $photo->store('public/equipments');
                $picture = Picture::create([
                    'name' => $photo->getClientOriginalName(),
                    'url' => str_replace('public/', '', $url)
                ]);
                $equipment->pictures()->sync([$picture->id]);
            }
        }
        session()->flash('flash_message', 'Se ha agregado el equipo: '.$equipment->title);
        return redirect('equipos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment $equipment)
    {
        //
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
        }

        if(!is_numeric($request->input('group_id'))){
            $group = Group::create([
                'title' => $request->input('group_id'),
                'description' => $request->input('group_id')
            ]);
            $request->merge(['group_id' => $group->id]);
        }

        if(!is_numeric($request->input('warehouse_id'))){
            $warehouse = Warehouse::create([
                'title' => $request->input('warehouse_id'),
                'description' => $request->input('warehouse_id')
            ]);
            $request->merge(['warehouse_id' => $warehouse->id]);
        }

        $equipment->update($request->all());

        if($request->hasFile('photos')){
            foreach ($request->file('photos') as $photo) {
                $url = $photo->store('public/equipments');
                $picture = Picture::create([
                    'name' => $photo->getClientOriginalName(),
                    'url' => str_replace('public/', '', $url)
                ]);
                $equipment->pictures()->sync([$picture->id]);
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
