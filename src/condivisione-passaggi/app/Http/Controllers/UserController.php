<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function home()
    {
        if (Auth::check()) {
            // Recupera l'utente corrente autenticato
            $user = auth()->user();

            // Mostra la pagina personale dell'utente
            return view('home.home', ['user' => $user]);
        }
        return redirect('/');
    }

    public function logout(Request $request)
    {
        // Esegue il logout dell'utente
        Auth::logout();

        // Invalida la sessione
        $request->session()->invalidate();
        
        // Rigenera il token per la sessione
        $request->session()->regenerateToken();

        // Redireziona l'utente alla homepage
        return redirect('/');
    }

    public function updatePassword(Request $request)
    {
        $messages = array();
        // Validazione dei dati in ingresso
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required',
        ]);

        // Recupera l'utente corrente autenticato
        $user = auth()->user();

        // Verifica che la password corrente fornita sia corretta
        if (!Hash::check($request->oldPassword, $user->password)) {
            // La password corrente è errata, mostra un messaggio di errore
            $messages[] = "Current password is wrong";
            return redirect('/homePage')->with('errors', $messages);
        }

        // La password corrente è corretta, aggiorna la password dell'utente
        $user->password = Hash::make($request->newPassword);
        $user->save();

        // Mostra un messaggio di successo
        return redirect('/homePage')->withSuccess('Password changed');
    }

}