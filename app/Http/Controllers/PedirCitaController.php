<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PedirCitaController extends Controller
{
    /**
     * Muestra el formulario para pedir una cita.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('pedir-cita');
    }
}
