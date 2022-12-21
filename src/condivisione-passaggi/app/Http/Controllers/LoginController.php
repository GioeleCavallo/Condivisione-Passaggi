<?php
 
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Exceptions\ErrorGeneral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class LoginController extends Controller
{
    public function index(){
        return view('login.login');
    }

    private function rightLogin($email, $psw){
        $user = DB::table('users')
                ->where('email', $email)
                ->first();
        if($user == null){return false;}
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
        //$input =$request->all() ;
        $messages = array();
        
      
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if ($validator->fails()) {
            $messages[] = "Set correct fields inputs";
        } else{
            if($this::rightLogin($request->email, $request->password)){
                echo "logged in";//return view('admin');
                return;
            }else{
                $messages[] = "Wrong username or password";
            }
        }
        //$messages = "email";
        return back()->with('errors', $messages);
        
    
    }
}