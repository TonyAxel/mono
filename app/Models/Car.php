<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class Car extends Model
{
    use HasFactory;

    protected $rules = [
        'brand' => 'required',
        'model' => 'required',
        'color' => 'required',
        'number' => 'required|unique:cars',
        'flexRadioDefault1' => 'required'
    ];

    protected $rulesUpdateNonNumber = [
        'brand' => 'required',
        'model' => 'required',
        'color' => 'required',
        'flexRadioDefault' => 'required'
    ];

    protected $rulesUpdateCar = [
        'brand' => 'required',
        'model' => 'required',
        'color' => 'required',
        'number' => 'required|unique:cars',
        'flexRadioDefault' => 'required'
    ];

    protected $rulesAddCar = [
        'brand' => 'required',
        'model' => 'required',
        'color' => 'required',
        'number' => 'required|unique:cars',
        'flexRadioDefault1' => 'required'
    ];

    public function createCarValidate($values)
    {
        $valid = Validator::make($values, $this->rules);
        if($valid->passes()) return true;
        else return false;
    }

    public function addCar(Request $request, $idClient)
    {
        DB::table('cars')->insert([
            'brand' => $request->brand,
            'model' => $request->model,
            'color' => $request->color,
            'number' => $request->number,
            'check' => $request->flexRadioDefault1,
            'client_id' => $idClient
        ]);
    }

    public function selectCar(Request $request){
        $carParking = DB::table('clients')
            ->join('cars', 'client_id', '=', 'clients.id')
            ->select('cars.id','brand', 'model', 'number')
            ->where('clients.id',$request->title)
            ->get();
        return $carParking;
    }

    public function checkCar(Request $request)
    {
        DB::table('cars')
            ->where('id', $request->id)
            ->update(['check' => $request->value]);
        if($request->value == 1){
            return 'Машина на стоянке';
        }
         return 'Машина убрана со стоянки';
    }

    public function getCarsClient($id)
    {
        $cars = DB::table('clients')
                ->join('cars', 'client_id', '=', 'clients.id')
                ->select('cars.id','brand','model', 'color', 'number', 'check')
                ->where('clients.id', $id)
                ->get();
        
        return $cars;
    }

    public function updateCarValidate($values, Request $request, $id)
    {
        $number = DB::table('cars')
                ->select('number')
                ->where('id', $id)
                ->get();

        if($number[0]->number == $request->number)
        {
            $valid = Validator::make($values, $this->rulesUpdateNonNumber);
            if($valid->passes()) return true;
            else return false;
        }
        else
        {
            $valid = Validator::make($values, $this->rulesUpdateCar);
            if($valid->passes()) return true;
            else return false;
        }
        
    }

    public function updateCar(Request $request, $id){
        DB::table('cars')->where('id', $id)->update([
            'brand' => $request->brand,
            'model' => $request->model,
            'color' => $request->color,
            'number' => $request->number,
            'check' => $request->flexRadioDefault,
        ]);
    }

    public function deleteCar($id)
    {
        DB::table('cars')
            ->where('id', $id)
            ->delete();
    }

    public function addValidationCar($values)
    {
        $valid = Validator::make($values, $this->rulesAddCar);
        if($valid->passes()) return true;
        else return false;    
    }
}
