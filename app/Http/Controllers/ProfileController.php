<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $validatedData = $request->validated();

        // Asegúrate de que los campos adicionales estén presentes en los datos validados
        $additionalFields = ['phone', 'address'];
        foreach ($additionalFields as $field) {
            if (isset($validatedData[$field])) {
                $user->{$field} = $validatedData[$field];
            }
        }

        // Llena el modelo de usuario con los datos validados
        $user->fill($validatedData);

        // Verifica si el correo electrónico ha cambiado para restablecer la verificación del correo electrónico
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Guarda el usuario actualizado en la base de datos
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
