<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
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
        $setting = Setting::first();
        return view('ajustes.index', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        if($request->hasFile('sidebar_logo')){
            $url = $request->file('sidebar_logo')->store('public/logo');
            $setting->sidebar_logo->update([
                'name' => $request->file('logo')->getClientOriginalName(),
                'url' => str_replace('public/', '', $url)
            ]);
        }
        if($request->hasFile('service_logo')){
            $url = $request->file('service_logo')->store('public/logo');
            $setting->service_logo->update([
                'name' => $request->file('logo')->getClientOriginalName(),
                'url' => str_replace('public/', '', $url)
            ]);
        }
        $setting->update($request->all());
        session()->flash('flash_message', 'Se han actualizado los ajustes');
        return redirect('ajustes');
    }

}
