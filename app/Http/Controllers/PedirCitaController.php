<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PedirCitaController extends Controller
{
    public function create()
    {
        // Aquí colocarías la lógica para mostrar el formulario de pedir cita
        return view('pedir-cita');
    }
}
