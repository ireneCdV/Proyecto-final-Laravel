<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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
    // Obtener el usuario autenticado
    $user = Auth::user();

    // Obtener todas las citas del usuario autenticado
    $citas = $user->citas;

    return view('citas.index', ['citas' => $citas]);
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
                        ->where('hora', $value)
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
    
        return redirect()->route('citas.index');
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
