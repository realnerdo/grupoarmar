<?php

namespace App\Http\Controllers;

use App\Maintenance;
use App\Equipment;
use Illuminate\Http\Request;
use App\Http\Requests\MaintenanceRequest;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipments = Equipment::pluck('title', 'id');
        $equipments = [''=>''] + $equipments->toArray();
        return view('mantenimientos.create', compact('equipments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MaintenanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaintenanceRequest $request)
    {
        $equipment = Equipment::find($request->all())->first();
        if($equipment){
            $maintenance = $equipment->maintenances()->create($request->all());
        } // TODO: Make validation for when equipment not found
        session()->flash('flash_message', 'Se ha creado el mantenimiento: '.$maintenance->name);
        return redirect('mantenimientos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function show(Maintenance $maintenance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function edit(Maintenance $maintenance)
    {
        $equipments = Equipment::pluck('title', 'id');
        $equipments = [''=>''] + $equipments->toArray();
        return view('mantenimientos.edit', compact('maintenance', 'equipments'));
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
