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

        $targhe = $this->selectTargheUser($user);

        //echo $targhe[0]->targa;
        // Mostra la pagina personale dell'utente
        return view('car.car', ['user' => $user, 'targhe' => $targhe]);
    }

    public function car($targa){
        $user = auth()->user();
        if(!$this->existsForUser($targa,$user->id)){
            return redirect('cars')
            ->with("errors",["Car doesn't exists"]);
        }
        $car = DB::table('auto')
        ->where('targa', $targa)
        ->first();
        return view('car.showCar', ['car' => $car]);
    }

    public function journeys($targa){
        $user = auth()->user();
        if(!$this->existsForUser($targa,$user->id)){
            return redirect('cars')
            ->with("errors",["Car doesn't exists"]);
        }
        $journeys = DB::table('tragitto')
        ->where('tragitto_auto', $targa)
        ->get();

        return view('car.showJourneys', ['journeys' => $journeys, 'targa' => $targa]);
    }

    private function validateInput(Request $request){
        
        $validator = Validator::make($request->all(), [
            'targa' => 'required',
            'marca' => 'required',
            'color_car' => 'required',
            'posti' => 'required',
        ]);
        return $validator;
        

    }

    public function updateCar(Request $request){
    
        $user = auth()->user();

        $validator = $this->validateInput($request);

        if ($validator->fails()) {
            return redirect('cars')
            ->with("errors",["Insert valid inputs"])
            ->withInput();
        }
        $validated = $validator->validated();

        if(!$this->existsForUser($validated["targa"],$user->id)){
            return redirect('cars')
            ->with("errors",["Car doesn't exists"])
            ->withInput();
        }


        $this->updateCarForUser($validated['targa'],$validated['marca'],$validated['color_car'],$validated['posti'],$user);

        return redirect("cars");

    }

    public function addCar(Request $request){
        
        $user = auth()->user();

        $validator = $this->validateInput($request);

        if ($validator->fails()) {
            return redirect('cars')
            ->with("errors",["Insert valid inputs"])
            ->withInput();
        }
        $validated = $validator->validated();

        if($this->exists($validated["targa"])){
            return redirect('cars')
            ->with("errors",["Car already exists"])
            ->withInput();
        }
        $this->addCarToUser($validated['targa'],$validated['marca'],$validated['color_car'],$validated['posti'],$user);

        return redirect("cars");
    }

    public function addJourney(Request $request) {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'targa' => 'required',
            'check_list' => 'required',
            'descrizione' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect("car/" . $validated['targa'] . "/journeys")
            ->with("errors",["Insert valid inputs"])
            ->withInput();
        }
        $validated = $validator->validated();

        $posti = DB::table('auto')
        ->select('posti')
        ->where('targa',$validated['targa'])
        ->first();

        $tragittoId = DB::table('tragitto')->insertGetId([
            'nome' => $validated['nome'],
            'descrizione' => $validated['descrizione'],
            'tragitto_auto' => $validated['targa'],
            'numero_persone' => $posti->posti
        ]);


        foreach ($validated['check_list'] as $day) {
            DB::table('giorno_tragitto')->insert([
                'giorno_nome' => $day,
                'tragitto_id' => $tragittoId
            ]);
        }
        
        return redirect("car/" . $validated['targa'] . "/journeys");
    }


    private function exists($targa){
        return DB::table('auto')->where('targa', $targa)->exists();
    }

    private function existsForUser($targa,$userId){
        return DB::table('auto')
        ->where('targa', $targa)
        ->where('auto_user',$userId)
        ->exists();
    }

    private function selectTargheUser($user){

        return DB::table('auto')
        ->select('targa')
        ->where('auto_user',$user->id)
        ->get();
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

    private function updateCarForUser($targa, $marca,$colore,$posti,$user){

        DB::table('auto')
        ->where('targa',$targa)
        ->update([
            'marca' => $marca,
            'colore' => $colore,
            'posti' => $posti
        ]);
    }
}