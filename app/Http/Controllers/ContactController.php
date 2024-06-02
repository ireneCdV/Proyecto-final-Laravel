<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Auth;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Crear una nueva entrada en la base de datos
        Contact::create([
            'user_id' => Auth::id(), // Guardar el ID del usuario autenticado
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // Limpiar el LocalStorage después de un envío exitoso
        echo '<script>localStorage.removeItem("contactFormData");</script>';

        return redirect()->back()->with('success', 'Gracias por contactarnos. Te responderemos pronto.');
    }

    public function show()
    {
        return view('contact.contact');
    }
}
