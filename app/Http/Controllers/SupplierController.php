<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\SupplierRequest;

class SupplierController extends Controller
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
    public function index(Request $request)
    {
        $values = '';
        foreach($request->all() as $key => $value){
            $values .= $value;
        }
        if($values == ''){
            $suppliers = Supplier::latest()->paginate(5);
        }else{
            $suppliers = Supplier::latest()
                ->where('title', $request->input('title'))
                ->orWhere('phone', $request->input('phone'))
                ->paginate(5);
        }
        return view('proveedores.index', compact('suppliers', 'request'));
    }

    /**
     * Export to Excel the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportExcel()
    {
        $xls = Excel::create('proveedores', function($excel) {
            $excel->setTitle('Proveedores');
            $excel->sheet('Proveedores', function($sheet) {
                $suppliers = Supplier::all();
                $sheet->fromModel($suppliers);
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
        return view('proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SupplierRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
        $supplier = Supplier::create($request->all());
        session()->flash('flash_message', 'Se ha creado el proveedor: '.$supplier->title);
        return redirect('proveedores');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('proveedores.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SupplierRequest  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->all());
        session()->flash('flash_message', 'Se ha actualizado el proveedor: '.$supplier->title);
        return redirect('proveedores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        session()->flash('flash_message', 'Se ha eliminado el proveedor');
        return redirect('proveedores');
    }
}
