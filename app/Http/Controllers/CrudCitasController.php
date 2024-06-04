<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Http\Requests\CrudCitaRequest;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;


class CrudCitasController extends Controller
{
    /**
     * Muestra una lista de recursos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $query = Cita::with(['usuario', 'service']);
    
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('fecha', [$request->start_date, $request->end_date]);
        }
    
        if ($request->filled('estado')) {
            if ($request->estado === '') {
                $query->where(function($q) {
                    $q->where('estado', 1)
                      ->orWhere('fecha', '<', now());
                });
            } else {
                $query->where('estado', $request->estado);
            }
        }
    
        $crudcitas = $query->get();
    
        return view('crudcitas.index', ['crudcitas' => $crudcitas]);
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('crudcitas.create');
    }

    /**
     * Almacena un recurso recién creado en el almacenamiento.
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
     * Muestra el recurso especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $crudcita = Cita::with('usuario')->findOrFail($id);

        return view('crudcitas.show', compact('crudcita'));
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $crudcita = Cita::findOrFail($id);

        if ($crudcita->fecha < now() || ($crudcita->fecha == now()->toDateString() && $crudcita->hora < now()->format('H:i'))) {
            return redirect()->route('crudcitas.index')->with('error', 'No puedes editar una cita que ya ha pasado.');
        }

        $services = Service::all();
        $users = User::all();
        return view('crudcitas.edit', ['crudcita' => $crudcita, 'services' => $services, 'users' =>$users]);
    }

    /**
     * Actualiza el recurso especificado en el almacenamiento.
     *
     * @param  CrudCitaRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CrudCitaRequest $request, $id)
    {
        $crudcita = Cita::findOrFail($id);

        if ($crudcita->fecha < now() || ($crudcita->fecha == now()->toDateString() && $crudcita->hora < now()->format('H:i'))) {
            throw ValidationException::withMessages(['error' => 'No puedes editar una cita que ya ha pasado.']);
        }

        $crudcita->fecha = $request->input('fecha');
        $crudcita->hora = $request->input('hora');
        $crudcita->servicio_id = $request->input('servicio_id');
        $crudcita->user_id = $request->input('user_id');
        $crudcita->save();

        DB::table('user_cites')->insert([
            'user_id' => auth()->id(), 
            'cite_id' => $crudcita->id 
        ]);

        return redirect()->route('crudcitas.index');
    }

    /**
     * Elimina el recurso especificado del almacenamiento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $crudcita = Cita::findOrFail($id);

        DB::table('user_cites')->insert([
            'user_id' => auth()->id(), 
            'cite_id' => $crudcita->id 
        ]);

        $crudcita->delete();

        return redirect()->route('crudcitas.index');
    }


    /**
     * Obtiene las horas disponibles para una fecha específica.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAvailableHours(Request $request)
    {
        $date = $request->query('fecha');
        $citaId = $request->query('cita_id');
        $allHours = [
            '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30',
            '17:00', '17:30', '18:00', '18:30', '19:00', '19:30', '20:00', '20:30'
        ];

        $takenHoursQuery = Cita::where('fecha', $date);
        if ($citaId) {
            $takenHoursQuery->where('id', '!=', $citaId); 
        }
        $takenHours = $takenHoursQuery->pluck('hora')->toArray();
        $availableHours = array_diff($allHours, $takenHours);
    
        return response()->json([
            'availableHours' => $availableHours,
            'takenHours' => $takenHours
        ]);
    }

    

}
