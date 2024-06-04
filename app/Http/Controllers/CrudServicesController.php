<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\CrudService;
use App\Http\Requests\CrudServiceRequest;
use App\Models\Service;

class CrudServicesController extends Controller
{
    /**
     * Muestra una lista de recursos.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $crudservices= Service::all();
        return view('crudservices.index', ['crudservices'=>$crudservices]);
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('crudservices.create');
    }

    /**
     * Almacena un recurso recién creado en el almacenamiento.
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
     * Muestra el recurso especificado.
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
     * Muestra el formulario para editar el recurso especificado.
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
     * Actualiza el recurso especificado en el almacenamiento.
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
     * Elimina el recurso especificado del almacenamiento.
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
