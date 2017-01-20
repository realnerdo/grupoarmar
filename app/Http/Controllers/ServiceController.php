<?php

namespace App\Http\Controllers;

use Auth;
use App\Service;
use App\Client;
use App\Equipment;
use App\ServiceDetail;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceRequest;
use Excel;
use Carbon\Carbon;

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
     * Show the pdf of the specified resource.
     *
     * @param  Service  $service
     * @return \Illuminate\Http\Response
     */
    public function pdf(Service $service)
    {
        $settings = Setting::latest()->first();
        $pdf = \PDF::loadView('servicios.pdf', ['service' => $service, 'settings' => $settings]);
        $filename = $settings->title.' - Servicio para '.$service->client->name.'['.Carbon::now().'].pdf';
        return $pdf->stream($filename);
    }

    /**
     * Show the pdf of the specified resource.
     *
     * @param  Service  $service
     * @return \Illuminate\Http\Response
     */
    public function pdf_full(Service $service)
    {
        $settings = Setting::latest()->first();
        $pdf = \PDF::loadView('servicios.pdf_full', ['service' => $service, 'settings' => $settings]);
        $filename = $settings->title.' - Servicio para '.$service->client->name.'['.Carbon::now().'].pdf';
        return $pdf->stream($filename);
    }

    /**
     * Show the pdf of the specified resource.
     *
     * @param  Service  $service
     * @return \Illuminate\Http\Response
     */
    public function download(Service $service)
    {
        $settings = Setting::latest()->first();
        $pdf = \PDF::loadView('servicios.pdf', ['service' => $service, 'settings' => $settings]);
        $filename = $settings->title.' - Servicio para '.$service->client->name.'['.Carbon::now().'].pdf';
        return $pdf->download($filename);
    }

    /**
     * Show the pdf of the specified resource.
     *
     * @param  Service  $service
     * @return \Illuminate\Http\Response
     */
    public function download_full(Service $service)
    {
        $settings = Setting::latest()->first();
        $pdf = \PDF::loadView('servicios.pdf_full', ['service' => $service, 'settings' => $settings]);
        $filename = $settings->title.' - Servicio para '.$service->client->name.'['.Carbon::now().'].pdf';
        return $pdf->download($filename);
    }

    /**
     * Export to Excel the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportExcel()
    {
        $xls = Excel::create('servicios', function($excel) {
            $excel->setTitle('Servicios');
            $excel->sheet('Servicios', function($sheet) {
                $services = Service::all();
                $sheet->fromModel($services);
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
        $latest = Service::latest()->first();
        $folio = (is_null($latest)) ? sprintf('%05d', 1) : sprintf('%05d', $latest->folio + 1);
        $request->merge(['folio' => $folio]);

        $service = $this->save_equipments(null, $request);

        session()->flash('flash_message', 'Se ha creado un servicio para el evento: '.$service->event);
        return redirect('servicios');
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
        ServiceDetail::where('service_id', $service->id)->delete();

        $service = $this->save_equipments($service, $request, true);

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

    private function save_equipments($service, $request, $update = false)
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

        $this_start = Carbon::createFromFormat('!Y-m-d', $request->input('date_start'));
        $this_end = Carbon::createFromFormat('!Y-m-d', $request->input('date_end'));

        $availables = 0;
        $unavailables = 0;

        if($update){
            $service->update($request->all());
        }else{
            $service = Auth::user()->services()->create($request->all());
        }

        foreach ($request->input('equipments') as $equipment) {

            $current_equipment = Equipment::find($equipment['equipment_id']);

            foreach ($current_equipment->equipment_details as $equipment_detail) {
                $available = true;

                $service_details = $equipment_detail->service_details()->get();
                if($service_details->isEmpty()){
                    $equipment_details_availables[$current_equipment->id]['equipment_detail_ids'][$equipment_detail->id]['id'] = $equipment_detail->id;
                    $equipment_details_availables[$current_equipment->id]['equipment_detail_ids'][$equipment_detail->id]['quantity'] = $equipment['quantity'];
                    $equipment_details_availables[$current_equipment->id]['equipment_detail_ids'][$equipment_detail->id]['price'] = $equipment['price'];
                    $equipment_details_availables[$current_equipment->id]['equipment_detail_ids'][$equipment_detail->id]['total'] = $equipment['total'];
                    $equipment_details_availables[$current_equipment->id]['equipment_detail_ids'][$equipment_detail->id]['equipment_id'] = $equipment['equipment_id'];
                } else {
                    foreach ($service_details as $service_detail) {
                        $pending = $service_detail->service()->pending()->first();
                        if($pending){
                            if(
                                ($this_end < Carbon::createFromFormat('!Y-m-d', $pending->date_start)) ||
                                ($this_start > Carbon::createFromFormat('!Y-m-d', $pending->date_end))
                            ){
                                $equipment_details_availables[$current_equipment->id]['equipment_detail_ids'][$service_detail->equipment_detail->id]['id'] = $service_detail->equipment_detail->id;
                                $equipment_details_availables[$current_equipment->id]['equipment_detail_ids'][$service_detail->equipment_detail->id]['quantity'] = $equipment['quantity'];
                                $equipment_details_availables[$current_equipment->id]['equipment_detail_ids'][$service_detail->equipment_detail->id]['price'] = $equipment['price'];
                                $equipment_details_availables[$current_equipment->id]['equipment_detail_ids'][$service_detail->equipment_detail->id]['total'] = $equipment['total'];
                                $equipment_details_availables[$current_equipment->id]['equipment_detail_ids'][$service_detail->equipment_detail->id]['equipment_id'] = $equipment['equipment_id'];
                                $available = true;
                            } else{
                                $available = false;
                            }
                        }

                        $active = $service_detail->service()->active()->first();
                        if($active){
                            if(
                                ($this_end < Carbon::createFromFormat('!Y-m-d', $active->date_start)) ||
                                ($this_start > Carbon::createFromFormat('!Y-m-d', $active->date_end))
                            ){
                                $equipment_details_availables[$current_equipment->id]['equipment_detail_ids'][$service_detail->equipment_detail->id]['id'] = $service_detail->equipment_detail->id;
                                $equipment_details_availables[$current_equipment->id]['equipment_detail_ids'][$service_detail->equipment_detail->id]['quantity'] = $equipment['quantity'];
                                $equipment_details_availables[$current_equipment->id]['equipment_detail_ids'][$service_detail->equipment_detail->id]['price'] = $equipment['price'];
                                $equipment_details_availables[$current_equipment->id]['equipment_detail_ids'][$service_detail->equipment_detail->id]['total'] = $equipment['total'];
                                $equipment_details_availables[$current_equipment->id]['equipment_detail_ids'][$service_detail->equipment_detail->id]['equipment_id'] = $equipment['equipment_id'];
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

            $equipment_details_availables[$current_equipment->id]['availables'] = $availables;
            $availables = 0;
            $unavailables = 0;

        }

        foreach ($request->input('equipments') as $equipment) {
            if($equipment['quantity'] <= $equipment_details_availables[$equipment['equipment_id']]['availables']){
                $i = 1;
                foreach ($equipment_details_availables[$equipment['equipment_id']]['equipment_detail_ids'] as $equipment_detail_id) {
                    $service->service_details()->create([
                        'quantity' => $equipment_detail_id['quantity'],
                        'price' => $equipment_detail_id['price'],
                        'total' => $equipment_detail_id['total'],
                        'equipment_detail_id' => $equipment_detail_id['id'],
                        'equipment_id' => $equipment['equipment_id']
                    ]);
                    if($i == $equipment['quantity']){
                        break;
                    }
                    $i++;
                }
            }elseif($equipment['quantity'] > $equipment_details_availables[$equipment['equipment_id']]['availables']){
                if($equipment_details_availables[$equipment['equipment_id']]['availables'] > 0){
                    foreach ($equipment_details_availables[$equipment['equipment_id']]['equipment_detail_ids'] as $equipment_detail_id) {
                        $service->service_details()->create([
                            'quantity' => $equipment_detail_id['quantity'],
                            'price' => $equipment_detail_id['price'],
                            'total' => $equipment_detail_id['total'],
                            'equipment_detail_id' => $equipment_detail_id['id'],
                            'equipment_id' => $equipment['equipment_id']
                        ]);
                    }
                }

                $extra = $equipment['quantity'] - $equipment_details_availables[$equipment['equipment_id']]['availables'];
                for ($i=0; $i < $extra; $i++) {
                    $service->service_details()->create([
                        'quantity' => $equipment['quantity'],
                        'price' => $equipment['price'],
                        'total' => $equipment['total'],
                        'equipment_detail_id' => null,
                        'equipment_id' => $equipment['equipment_id']
                    ]);
                }
            }
        }

        return $service;
    }
}
