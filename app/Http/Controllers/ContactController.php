<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Auth;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Procesa el envío del formulario de contacto.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create([
            'user_id' => Auth::id(), 
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        echo '<script>localStorage.removeItem("contactFormData");</script>';

        return redirect()->back()->with('success', 'Gracias por contactarnos. Te responderemos pronto.');
    }

    /**
     * Muestra el formulario de contacto.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show()
    {
        return view('contact.contact');
    }
}
