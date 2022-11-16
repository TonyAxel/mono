<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function home(){

        $carParking = DB::table('clients')->join('cars', 'clients.car_id', '=', 'cars.id')->select('clients.id','fio', 'brand', 'model', 'number')->where('check', '1')->paginate(10);
        $clientsSelect = DB::table('clients')->select('id','fio')->get();
        return view('home', compact('carParking', 'clientsSelect'));
    }
    public function selectCar(Request $request){
        $carParking = DB::table('clients')->join('cars', 'clients.car_id', '=', 'cars.id')->select('cars.id','fio', 'brand', 'model', 'number')->where('clients.id',$request->title)->get();
        return $carParking;
    }
    public function checkCar(Request $request){
        $update = DB::table('cars')->where('id', $request->id)->update(['check' => $request->value]);
        if($request->value == 1){
            return 'Машина на стоянке';
        }
        return 'Машина убрана со стоянки';
    }
}
