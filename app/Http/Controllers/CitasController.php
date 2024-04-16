<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Cita;
use App\Http\Requests\CitaRequest;
use App\Models\Service;

class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $citas= Cita::all();
        return view('citas.index', ['citas'=>$citas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
{
    $services = Service::all(); // Obtener todos los servicios desde la base de datos

    return view('citas.create', compact('services'));
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  CitaRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CitaRequest $request)
    {
        $cita = new Cita;
		$cita->fecha = $request->input('fecha');
		$cita->hora = $request->input('hora');
		$cita->servicio_id = $request->input('servicio_id');
        $cita->save();

        return to_route('citas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
{
    $cita = Cita::findOrFail($id);
    $servicio = Service::findOrFail($cita->servicio_id); // Obtener el servicio asociado a la cita
    return view('citas.show', ['cita' => $cita, 'servicio' => $servicio]);
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $cita = Cita::findOrFail($id);
        $services = Service::all(); // Obtener todos los servicios desde la base de datos
        return view('citas.edit',['cita'=>$cita, 'services'=>$services]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CitaRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CitaRequest $request, $id)
    {
        $cita = Cita::findOrFail($id);
		$cita->fecha = $request->input('fecha');
		$cita->hora = $request->input('hora');
		$cita->servicio_id = $request->input('servicio_id');
        $cita->save();

        return to_route('citas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return to_route('citas.index');
    }
}
