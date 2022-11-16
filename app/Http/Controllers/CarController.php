<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Car;

class CarController extends Controller
{
    public function selectCar(Request $request){
        $modelCar = new Car();
        $carParking = $modelCar->selectCar($request);
        return $carParking;
    }
    public function checkCar(Request $request){
        
        $modelCar = new Car();
        $valuesParking = $modelCar->checkCar($request);

        return $valuesParking;
    }

    public function addCar(Request $request, $id)
    {
        $modelCar = new Car();
        if($modelCar->addValidationCar($request->all())){
            $modelCar->addCar($request, $id);
            return redirect()->back();
        }
        return redirect()->back();
    }
}
