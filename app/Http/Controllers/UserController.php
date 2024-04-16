<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showPedidos()
    {
        // Obtener todas las facturas del usuario registrado con sus líneas asociadas
        $invoices = Auth::user()->facturas()->with('lines')->get();

        // Pasar los datos a la vista
        return view('pedidos', ['orders' => $invoices]);
    }

}
