<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Cita;
use App\Http\Requests\CitaRequest;
use App\Jobs\SendAppointmentConfirmation;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\JsonResponse;


class CitasController extends Controller
{
    /**
     * Muestra una lista de citas del usuario autenticado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
    
        $citas = Cita::where('user_id', $userId);
    
        if (!$request->filled('estado')) {
            $citas->where('estado', 1);
        } else {
            $estado = $request->estado;
            $citas->where('estado', $estado);
        }
    
        $citas = $citas->get();
    
        return view('citas.index', compact('citas'));
    }
    

    /**
     * Muestra el formulario para crear una nueva cita.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $services = Service::all(); 

        return view('citas.create', compact('services'));
    }

    /**
     * Almacena una nueva cita en el almacenamiento.
     *
     * @param  CitaRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CitaRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'fecha' => [
                'required',
                'date',
                'after_or_equal:today', 
                function ($attribute, $value, $fail) {
                    if (date('N', strtotime($value)) >= 6) { 
                        $fail('No se pueden programar citas para los sábados o domingos.');
                    }
                },
            ],
            'hora' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $existingCita = Cita::where('fecha', $request->input('fecha'))
                     ->where('hora', $request->input('hora'))
                     ->exists();

                    if ($existingCita) {
                        $fail('Ya existe una cita programada para esta fecha y hora.');
                    }

                    $currentDateTime = now();
                    $selectedDateTime = \Carbon\Carbon::parse($request->input('fecha') . ' ' . $value);
                    if ($selectedDateTime->lte($currentDateTime->addHour())) {
                        $fail('La cita debe ser programada con al menos una hora de antelación.');
                    }
                },
            ],
        ], [
            'fecha.required' => 'El campo fecha es obligatorio.',
            'fecha.after_or_equal' => 'El día seleccionado ya ha pasado.',
            'hora.required' => 'El campo hora es obligatorio.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cita = new Cita;
        $cita->fecha = $request->input('fecha');
        $cita->hora = $request->input('hora');
        $cita->servicio_id = $request->input('servicio_id');
        $cita->user_id = Auth::user()->id; 
        $cita->save();

        $cita->load('usuario');

        SendAppointmentConfirmation::dispatch($cita);

        return redirect()->route('citas.index')->with('success', 'Cita creada y correo enviado.');
    }
    

    /**
     * Muestra la información de una cita específica.
     *
     * @param  int  $id El ID de la cita
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $cita = Cita::findOrFail($id);
        $servicio = Service::findOrFail($cita->servicio_id); 
        return view('citas.show', ['cita' => $cita, 'servicio' => $servicio]);
    }

    /**
     * Muestra el formulario para editar una cita específica.
     *
     * @param  int  $id El ID de la cita
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $cita = Cita::findOrFail($id);
        if ($cita->estado != 1) {
            return redirect()->route('citas.index')->with('error', 'Una cita pasada no se puede modificar.');
        }
        $services = Service::all(); 
        return view('citas.edit', ['cita' => $cita, 'services' => $services]);
    }

    /**
     * Actualiza la cita especificada en el almacenamiento.
     *
     * @param  CitaRequest  $request La solicitud de la cita
     * @param  int  $id El ID de la cita
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CitaRequest $request, $id)
    {
        $cita = Cita::findOrFail($id);
        if ($cita->estado != 1) {
            return redirect()->route('citas.index')->with('error', 'Solo se pueden editar citas pendientes.');
        }
    
        $validator = Validator::make($request->all(), [
            'fecha' => [
                'required',
                'date',
                'after_or_equal:today',
                function ($attribute, $value, $fail) {
                    if (date('N', strtotime($value)) >= 6) {
                        $fail('No se pueden programar citas para los sábados o domingos.');
                    }
                },
            ],
            'hora' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $existingCita = Cita::where('fecha', $request->input('fecha'))
                                        ->where('hora', $request->input('hora'))
                                        ->where('id', '!=', $request->route('id'))
                                        ->exists();
    
                    if ($existingCita) {
                        $fail('Ya existe una cita programada para esta fecha y hora.');
                    }
    
                    $currentDateTime = now();
                    $selectedDateTime = \Carbon\Carbon::parse($request->input('fecha') . ' ' . $value);
                    if ($selectedDateTime->lte($currentDateTime->addHour())) {
                        $fail('La cita debe ser programada con al menos una hora de antelación.');
                    }
                },
            ],
        ], [
            'fecha.required' => 'El campo fecha es obligatorio.',
            'fecha.after_or_equal' => 'El día seleccionado ya ha pasado.',
            'hora.required' => 'El campo hora es obligatorio.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $cita->fecha = $request->input('fecha');
        $cita->hora = $request->input('hora');
        $cita->servicio_id = $request->input('servicio_id');
        $cita->save();
    
        return to_route('citas.index')->with('success', 'Cita actualizada correctamente.');
    }

    /**
     * Elimina la cita especificada del almacenamiento.
     *
     * @param  int  $id El ID de la cita
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return to_route('citas.index');
    }

    /**
     * Actualiza el estado de las citas.
     *
     * Este método ejecuta el comando de Artisan para actualizar el estado de las citas.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(): JsonResponse
    {
    
        Artisan::call('app:update-cite-status');
    
        return response()->json(['message' => 'El estado de las citas ha sido actualizado correctamente.'], 200);
    }
    

    /**
     * Obtiene las horas disponibles para programar una cita.
     *
     * @param  \Illuminate\Http\Request  $request La solicitud HTTP
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
