<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\CrudService;
use App\Http\Requests\CrudServiceRequest;
use App\Models\Service;

class CrudServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $crudservices= Service::all();
        return view('crudservices.index', ['crudservices'=>$crudservices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('crudservices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CrudServiceRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CrudServiceRequest $request)
    {
        $crudservice = new Service;
		$crudservice->name = $request->input('name');
		$crudservice->price = $request->input('price');
        $crudservice->save();

        return to_route('crudservices.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $crudservice = Service::findOrFail($id);
        return view('crudservices.show',['crudservice'=>$crudservice]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $crudservice = Service::findOrFail($id);
        return view('crudservices.edit',['crudservice'=>$crudservice]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CrudServiceRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CrudServiceRequest $request, $id)
    {
        $crudservice = Service::findOrFail($id);
		$crudservice->name = $request->input('name');
		$crudservice->price = $request->input('price');
        $crudservice->save();

        return to_route('crudservices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $crudservice = Service::findOrFail($id);
        $crudservice->delete();

        return to_route('crudservices.index');
    }
}
