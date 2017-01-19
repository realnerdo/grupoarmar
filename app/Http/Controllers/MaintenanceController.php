<?php

namespace App\Http\Controllers;

use App\Maintenance;
use App\Equipment;
use App\EquipmentDetail;
use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\MaintenanceRequest;
use Excel;

class MaintenanceController extends Controller
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
        $maintenances = Maintenance::latest()->paginate(5);
        return view('mantenimientos.index', compact('maintenances'));
    }

    /**
     * Export to Excel the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportExcel()
    {
        $xls = Excel::create('mantenimientos', function($excel) {
            $excel->setTitle('Mantenimientos');
            $excel->sheet('Mantenimientos', function($sheet) {
                $maintenances = Maintenance::all();
                $sheet->fromModel($maintenances);
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
        $equipment_details = EquipmentDetail::pluck('folio', 'id');
        $equipment_details = [''=>''] + $equipment_details->toArray();
        $suppliers = Supplier::pluck('title', 'id');
        $suppliers = [''=>''] + $suppliers->toArray();
        return view('mantenimientos.create', compact('equipment_details', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MaintenanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaintenanceRequest $request)
    {
        if(!is_numeric($request->input('supplier_id'))){
            $supplier = Supplier::create([
                'title' => $request->input('supplier_id')
            ]);
            $request->merge(['supplier_id' => $supplier->id]);
        }

        $equipment_detail = EquipmentDetail::where('folio', $request->input('equipment_detail_folio'))->first();
        if($equipment_detail){
            $maintenance = Maintenance::create($request->all());
        } // TODO: Make validation for when equipment not found

        session()->flash('flash_message', 'Se ha creado el mantenimiento: '.$maintenance->name);
        return redirect('mantenimientos');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function edit(Maintenance $maintenance)
    {
        $equipment_details = Equipment::pluck('folio', 'id');
        $equipment_details = [''=>''] + $equipment_details->toArray();
        $suppliers = Supplier::pluck('title', 'id');
        $suppliers = [''=>''] + $suppliers->toArray();
        return view('mantenimientos.edit', compact('maintenance', 'equipment_details', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MaintenanceRequest  $request
     * @param  \App\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function update(MaintenanceRequest $request, Maintenance $maintenance)
    {
        $maintenance->update($request->all());
        session()->flash('flash_message', 'Se ha actualizado el mantenimiento del equipo: '.$maintenance->equipment->title);
        return redirect('mantenimientos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();
        session()->flash('flash_message', 'Se ha eliminado el mantenimiento del equipo');
        return redirect('mantenimientos');
    }
}
