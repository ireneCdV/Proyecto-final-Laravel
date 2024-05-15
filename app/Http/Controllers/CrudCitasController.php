<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Http\Requests\CrudCitaRequest;

class CrudCitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $query = Cita::with(['usuario', 'service']);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('fecha', [$request->start_date, $request->end_date]);
        }

        if ($request->has('estado')) {
            $query->where('estado', $request->estado);
        }

        $crudcitas = $query->get();

        return view('crudcitas.index', ['crudcitas' => $crudcitas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('crudcitas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CrudCitaRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CrudCitaRequest $request)
    {
        $crudcita = new Cita;
		$crudcita->fecha = $request->input('fecha');
		$crudcita->hora = $request->input('hora');
		$crudcita->servicio_id = $request->input('servicio_id');
		$crudcita->user_id = $request->input('user_id');
        $crudcita->save();

        return to_route('crudcitas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
{
    // Buscar la cita por su ID con la relación cargada
    $crudcita = Cita::with('usuario')->findOrFail($id);

    // Retornar la vista con los datos de la cita y el usuario
    return view('crudcitas.show', compact('crudcita'));
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $crudcita = Cita::findOrFail($id);
        return view('crudcitas.edit',['crudcita'=>$crudcita]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CrudCitaRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CrudCitaRequest $request, $id)
    {
        $crudcita = Cita::findOrFail($id);
		$crudcita->fecha = $request->input('fecha');
		$crudcita->hora = $request->input('hora');
		$crudcita->servicio_id = $request->input('servicio_id');
		$crudcita->user_id = $request->input('user_id');
        $crudcita->save();

        return to_route('crudcitas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $crudcita = Cita::findOrFail($id);
        $crudcita->delete();

        return to_route('crudcitas.index');
    }
}
