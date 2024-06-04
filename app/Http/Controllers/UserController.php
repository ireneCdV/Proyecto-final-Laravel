<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Muestra los pedidos del usuario autenticado.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showPedidos()
    {
        $invoices = Auth::user()->facturas()->with('lines')->get();
        return view('pedidos', ['orders' => $invoices]);
    }

}
