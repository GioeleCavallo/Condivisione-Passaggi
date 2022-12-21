<?php
 
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Exceptions\ErrorGeneral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        return view('login.login');
    }

    private function rightLogin($email, $psw){
        $user = DB::table('users')
                ->where('email', $email)
                ->first();
        return Hash::check($psw, $user->password); 
       /* foreach ($users as $user) {
            if (Hash::check($psw, $user->password)) {
                return true;
            }
        }*/
       // return false;
    }

    public function checkLogin(Request $request)
    {
        $input = $request->all();
        $errors = array();
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (isset($request->validator) && $request->validator->fails()) {
            return back();
        }
        if($this::rightLogin($request->email, $request->password)){
            echo "logged in";//return view('admin');
            return;
        }
        $errors[] = new ErrorGeneral("Login", "Wrong username or password",0);
        return back()->with("errors", $errors);
    }
}