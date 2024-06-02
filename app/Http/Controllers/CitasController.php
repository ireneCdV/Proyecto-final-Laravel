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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // Obtener el ID del usuario autenticado
        $userId = Auth::id();
    
        // Obtener todas las citas del usuario actual
        $citas = Cita::where('user_id', $userId);
    
        // Si no se especifica el filtro, mostrar solo las citas pendientes por defecto
        if (!$request->filled('estado')) {
            $citas->where('estado', 1);
        } else {
            $estado = $request->estado;
            $citas->where('estado', $estado);
        }
    
        // Obtener los resultados
        $citas = $citas->get();
    
        // Devolver la vista con los resultados
        return view('citas.index', compact('citas'));
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
        // Validar que la fecha seleccionada no sea un sábado o domingo y que no sea una fecha pasada
        $validator = Validator::make($request->all(), [
            'fecha' => [
                'required',
                'date',
                'after_or_equal:today', // La fecha debe ser hoy o en el futuro
                function ($attribute, $value, $fail) {
                    if (date('N', strtotime($value)) >= 6) { // 6 y 7 corresponden a sábado y domingo respectivamente
                        $fail('No se pueden programar citas para los sábados o domingos.');
                    }
                },
            ],
            'hora' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    // Verificar si ya existe una cita para la misma fecha y hora
                    $existingCita = Cita::where('fecha', $request->input('fecha'))
                     ->where('hora', $request->input('hora'))
                     ->exists();

                    if ($existingCita) {
                        $fail('Ya existe una cita programada para esta fecha y hora.');
                    }

                    // Verificar que la hora de la cita sea al menos una hora después de la hora actual
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

        // Si pasa la validación, guardar la cita con el user_id
        $cita = new Cita;
        $cita->fecha = $request->input('fecha');
        $cita->hora = $request->input('hora');
        $cita->servicio_id = $request->input('servicio_id');
        $cita->user_id = Auth::user()->id; // Obtener el ID del usuario autenticado
        $cita->save();

        // Cargar la relación usuario
        $cita->load('usuario');

        // Enviar el correo de confirmación de la cita
        SendAppointmentConfirmation::dispatch($cita);

        return redirect()->route('citas.index')->with('success', 'Cita creada y correo enviado.');
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
        if ($cita->estado != 1) {
            return redirect()->route('citas.index')->with('error', 'Una cita pasada no se puede modificar.');
        }
        $services = Service::all(); // Obtener todos los servicios desde la base de datos
        return view('citas.edit', ['cita' => $cita, 'services' => $services]);
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

    public function updateStatus(): JsonResponse
    {
    
        // Llamar al comando de Artisan
        Artisan::call('app:update-cite-status');
    
        // Devolver una respuesta JSON indicando éxito
        return response()->json(['message' => 'El estado de las citas ha sido actualizado correctamente.'], 200);
    }
    

    public function getAvailableHours(Request $request)
    {
        $date = $request->query('fecha');
        $citaId = $request->query('cita_id'); // Obtener el ID de la cita si se proporciona
        $allHours = [
            '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30',
            '17:00', '17:30', '18:00', '18:30', '19:00', '19:30', '20:00', '20:30'
        ];
    
        // Obtener las horas ocupadas para la fecha seleccionada
        $takenHoursQuery = Cita::where('fecha', $date);
        if ($citaId) {
            $takenHoursQuery->where('id', '!=', $citaId); // Excluir la hora de la cita actual
        }
        $takenHours = $takenHoursQuery->pluck('hora')->toArray();
    
        // Filtrar las horas disponibles
        $availableHours = array_diff($allHours, $takenHours);
    
        return response()->json([
            'availableHours' => $availableHours,
            'takenHours' => $takenHours
        ]);
    }
    
    
    
}
