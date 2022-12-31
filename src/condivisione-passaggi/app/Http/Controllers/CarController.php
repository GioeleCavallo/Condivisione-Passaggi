<?php
 
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function index(){

        $user = auth()->user();

        // Mostra la pagina personale dell'utente
        return view('car.car', ['user' => $user]);
    }

    public function addCar(Request $request){
        
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'targa' => 'required',
            'marca' => 'required',
            'color_car' => 'required',
            'posti' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('cars')
            ->with("errors",["Insert valid inputs"])
            ->withInput();
        }
        $validated = $validator->validated();

        print_r($validated);        //print_r($validated);
        if($this->exists($validated["targa"])){
            return redirect('cars')
            ->with("errors",["Car already exists"])
            ->withInput();
        }
        $this->addCarToUser($validated['targa'],$validated['marca'],$validated['color_car'],$validated['posti'],$user);

        return redirect("cars");
    }

    private function exists($targa){
        return DB::table('auto')->where('targa', $targa)->exists();
    }


    private function addCarToUser($targa, $marca,$colore,$posti,$user){

        DB::table('auto')->insert([
            'targa' => $targa,
            'marca' => $marca,
            'colore' => $colore,
            'posti' => $posti,
            'auto_user' => $user->id
        ]);
    }
}