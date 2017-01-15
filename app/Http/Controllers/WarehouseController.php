<?php

namespace App\Http\Controllers;

use App\Warehouse;
use Illuminate\Http\Request;
use App\Http\Requests\WarehouseRequest;

class WarehouseController extends Controller
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
        $warehouses = Warehouse::latest()->paginate(5);
        return view('almacenes.index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('almacenes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\WarehouseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WarehouseRequest $request)
    {
        $warehouse = Warehouse::create($request->all());
        session()->flash('flash_message', 'Se ha creado el almacén: '.$warehouse->title);
        return redirect('almacenes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse)
    {
        return view('almacenes.edit', compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\WarehouseRequest  $request
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(WarehouseRequest $request, Warehouse $warehouse)
    {
        $warehouse->update($request->all());
        session()->flash('flash_message', 'Se ha actualizado el almacén: '.$warehouse->title);
        return redirect('almacenes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();
        session()->flash('flash_message', 'Se ha eliminado el almacén');
        return redirect('almacenes');
    }
}
