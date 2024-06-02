<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Http\Requests\CrudCitaRequest;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class CrudCitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // Crear la consulta base con relaciones
        $query = Cita::with(['usuario', 'service']);
    
        // Filtrar por rango de fechas si están presentes
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('fecha', [$request->start_date, $request->end_date]);
        }
    
        // Filtrar por estado si está presente y no está vacío
        if ($request->filled('estado')) {
            if ($request->estado === '') {
                // Mostrar citas abiertas y pasadas
                $query->where(function($q) {
                    $q->where('estado', 1) // Abiertas
                      ->orWhere('fecha', '<', now()); // Pasadas
                });
            } else {
                // Filtrar por el estado específico
                $query->where('estado', $request->estado);
            }
        }
    
        // Obtener los resultados de la consulta
        $crudcitas = $query->get();
    
        // Retornar la vista con los resultados
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
        $services = Service::all(); // Suponiendo que tienes un modelo llamado Service para gestionar los servicios
        $users = User::all(); // Suponiendo que tienes un modelo llamado User para gestionar los usuarios
        return view('crudcitas.edit', ['crudcita' => $crudcita, 'services' => $services, 'users' =>$users]);
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

        // Guarda los cambios en la cita
        $crudcita->fecha = $request->input('fecha');
        $crudcita->hora = $request->input('hora');
        $crudcita->servicio_id = $request->input('servicio_id');
        $crudcita->user_id = $request->input('user_id');
        $crudcita->save();

        // Inserta un nuevo registro en la tabla pivot user_cites
        DB::table('user_cites')->insert([
            'user_id' => auth()->id(), // ID del usuario que ha actualizado la cita
            'cite_id' => $crudcita->id // ID de la cita actualizada
        ]);

        return redirect()->route('crudcitas.index');
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

        // Inserta un nuevo registro en la tabla pivot user_cites para la eliminación
        DB::table('user_cites')->insert([
            'user_id' => auth()->id(), // ID del usuario que ha eliminado la cita
            'cite_id' => $crudcita->id // ID de la cita eliminada
        ]);

        // Elimina la cita
        $crudcita->delete();

        return redirect()->route('crudcitas.index');
    }

    

}
