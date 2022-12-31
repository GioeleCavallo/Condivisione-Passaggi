<?php
 
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Exceptions\ErrorGeneral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;

class LoginController extends Controller
{
    public function index(){
        // Verifica se l'utente è autenticato
        if (Auth::check()) {
            // L'utente è autenticato, lo reindirizzo verso la pagina desiderata
            return redirect('/homePage');
        } else {
            // L'utente non è autenticato, mostra la homepage
            return view('login.login');
        }
    }

    private function rightLogin($email, $psw){
        $user = DB::table('users')
                ->where('email', $email)
                ->first();
        if($user == null){return false;}
        return Hash::check($psw, $user->password); 
    }

    public function checkLogin(Request $request)
    {
        
        $messages = array();

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials, $request->has('admin'))) {
            return redirect()->intended('homePage');
        }

    
        $messages[] = "Check credentials";
        return back()->with('errors', $messages);
        
    }
}