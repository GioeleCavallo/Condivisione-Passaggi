<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

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


    public function admin()
    {
        if (Auth::check()) {
            // Recupera l'utente corrente autenticato
            $user = auth()->user();
            if($user->user_tipo=="admin"){
                $tipi = $this->selectType();

                // Mostra la pagina personale dell'utente
                return view('admin.admin', ['user' => $user, 'tipi' => $tipi]);
            }
        }
        return redirect('/');
    }


    private function selectType(){

        return DB::table('tipo')
        ->select('nome')
        ->get();
    }

    private function validateInput(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'tipo' => 'required',
        ]);
        return $validator;
    }

    public function addUser(Request $request){

        $validator = $this->validateInput($request);

        if ($validator->fails()) {
            return redirect('admin')
            ->with("errors",["Insert valid inputs"])
            ->withInput();
        }
        $validated = $validator->validated();
        if($this->exists($validated['email'])){
            return redirect('admin')
            ->with("errors",["Email already exists"])
            ->withInput();

        }

        $password = $this->generateRandomPassword(22);

        $this->addUserToDB($validated['name'],$validated['email'],Hash::make($password),$validated['tipo']);
        $this->sendMail($validated['email'],$validated['name'],$password);
        return redirect("admin")->withSuccess('User added');
    }

    private function sendMail($email,$name,$psw){

        $subject = 'Iscrizione';
        $body = "Ciao $name sei stato iscritto alla condivisione dei passaggi. ecco la tua password: $psw. 
        Cambiala il prima possibile in ".url('/').".";
        
        Mail::raw($body, function($message) use ($email, $subject) {
            $message->to($email)->subject($subject);
        });
    }

    private function generateRandomPassword($length) {
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= chr(rand(33, 126));
        }
        return $password;
    }

    private function exists($email){
        return DB::table('users')->where('email', $email)->exists();
    }

    private function addUserToDB($name,$email,$psw,$type){
        DB::table("users")->insert([
            'name' => $name,
            'email' => $email,
            'password' => $psw,
            'user_tipo' => $type
        ]);
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