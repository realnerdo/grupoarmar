<?php

namespace App\Http\Controllers;

use Auth;
use App\Service;
use App\Client;
use App\Equipment;
use App\ServiceDetail;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceRequest;

class ServiceController extends Controller
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
        $services = Service::latest()->paginate(5);
        return view('servicios.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::pluck('name', 'id');
        $clients = [''=>''] + $clients->toArray();
        $equipments = Equipment::pluck('title', 'id');
        $equipments = [''=>''] + $equipments->toArray();
        return view('servicios.create', compact('clients', 'equipments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        if(!is_numeric($request->input('client_id'))){
            $client = Client::create([
                'name' => $request->input('client_id'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'company' => $request->input('company'),
                'trade_name' => $request->input('trade_name'),
                'rfc' => $request->input('rfc'),
                'address' => $request->input('address'),
                'zipcode' => $request->input('zipcode')
            ]);

            $request->merge(['client_id' => $client->id]);
        }
        $service = Auth::user()->services()->create($request->all());
        foreach ($request->input('equipments') as $equipment) {
            $service->service_details()->create([
                'quantity' => $equipment['quantity'],
                'equipment_id' => $equipment['equipment_id']
            ]);
        }
        session()->flash('flash_message', 'Se ha creado un servicio para el evento: '.$service->event);
        return redirect('servicios');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $clients = Client::pluck('name', 'id');
        $clients = [''=>''] + $clients->toArray();
        $equipments = Equipment::pluck('title', 'id');
        $equipments = [''=>''] + $equipments->toArray();
        return view('servicios.edit', compact('service', 'clients', 'equipments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ServiceRequest  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, Service $service)
    {
        $service->update($request->all());
        foreach ($request->input('equipments') as $equipment) {
             ServiceDetail::where('service_id', $service->id)->delete();
        }
        foreach ($request->input('equipments') as $equipment) {
            $service->service_details()->create([
                'quantity' => $equipment['quantity'],
                'product_id' => $equipment['product_id']
            ]);
        }
        session()->flash('flash_message', 'Se ha actualizado el servicio para el evento: '.$service->event);
        return redirect('servicios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        session()->flash('flash_message', 'Se ha eliminado el servicio');
        return redirect('servicios');
    }
}
