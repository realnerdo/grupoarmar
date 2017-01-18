<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use Excel;

class ClientController extends Controller
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
        $clients = Client::latest()->paginate(5);
        return view('clientes.index', compact('clients'));
    }

    /**
     * Get the json of the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getClientById($id)
    {
        $client = Client::find($id);
        return $client;
    }

    /**
     * Export to Excel the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportExcel()
    {
        $xls = Excel::create('clientes', function($excel) {
            $excel->setTitle('Clientes');
            $excel->sheet('Clientes', function($sheet) {
                $clients = Client::all();
                $sheet->fromModel($clients);
            });
        });
        return $xls->download('xls');
    }

    /**
     * Export to PDF the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportPDF()
    {
        $xls = Excel::create('clientes', function($excel) {
            $excel->setTitle('Clientes');
            $excel->sheet('Clientes', function($sheet) {
                $clients = Client::all();
                $sheet->fromModel($clients);
            });
        });
        return $xls->download('pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $client = Client::create($request->all());
        session()->flash('flash_message', 'Se ha creado el cliente: '.$client->name);
        return redirect('clientes');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clientes.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $client->update($request->all());
        session()->flash('flash_message', 'Se ha actualizado el cliente: '.$client->name);
        return redirect('clientes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        session()->flash('flash_message', 'Se ha eliminado el cliente');
        return view('clientes');
    }
}
