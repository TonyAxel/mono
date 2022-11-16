<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientsCar = DB::table('clients')->join('cars', 'clients.car_id', '=', 'cars.id')->select('clients.id','fio', 'brand', 'model', 'number')->paginate(10);
        
        return view('clients', compact('clientsCar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createClient(Request $request){
        $request->validate([
            'fio' => 'required|min:3',
            'flexRadioDefault'=> 'required',
            'phone' =>'required|unique:clients',
            'brand' => 'required',
            'model' => 'required',
            'color' => 'required',
            'number' => 'required|unique:cars',
            'flexRadioDefault1' => 'required'
        ]);
        $idCar =  DB::table('cars')->insertGetId([
            'brand' => $request->brand,
            'model' => $request->model,
            'color' => $request->color,
            'number' => $request->number,
            'check' => $request->flexRadioDefault1]);

        DB::table('clients')->insert([
            'fio' => $request->fio,
            'gender' => $request->flexRadioDefault,
            'phone' => $request->phone,
            'addres' => $request->addres,
            'car_id' => $idCar
        ]);

        return redirect()->route('clients.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = DB::table('clients')->select('id','fio', 'gender', 'phone', 'addres')->where('id', $id)->get();
        $cars = DB::table('clients')->join('cars', 'clients.car_id', '=', 'cars.id')->select('cars.id','brand','model', 'color', 'number', 'check')->where('clients.id', $id)->get();
        return view('edit', compact('client', 'cars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $phone = DB::table('clients')->select('phone')->where('id', $id)->get();
        if($phone[0]->phone == $request->phone){
            $request->validate([
                'fio' => 'required|min:3',
                'flexRadioDefault'=> 'required',
            ]);
        }
        else{
            $request->validate([
                'fio' => 'required|min:3',
                'flexRadioDefault'=> 'required',
                'phone' =>'required|unique:clients',
            ]);
        }
        DB::table('clients')->where('id', $id)->update([
            'fio' => $request->fio,
            'gender' => $request->flexRadioDefault,
            'phone' => $request->phone,
            'addres' => $request->addres,
        ]);
        return redirect()->route('clients.edit', $id);
    }

    public function updateCar(Request $request, $id){
        $number = DB::table('cars')->select('number')->where('id', $id)->get();
        if($number[0]->number == $request->number){
            $request->validate([
                'brand' => 'required',
                'model' => 'required',
                'color' => 'required',
                'flexRadioDefault' => 'required'
            ]);
        }
        else{
            $request->validate([
                'brand' => 'required',
                'model' => 'required',
                'color' => 'required',
                'number' => 'required|unique:cars',
                'flexRadioDefault' => 'required'
            ]);
        }
        DB::table('cars')->where('id', $id)->update([
            'brand' => $request->brand,
            'model' => $request->model,
            'color' => $request->color,
            'number' => $request->number,
            'check' => $request->flexRadioDefault,
        ]);
        $idUser = DB::table('clients')->join('cars', 'clients.car_id', '=', 'cars.id')->select('clients.id')->where('car_id', $id)->get();
        return redirect()->route('clients.edit', $idUser[0]->id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('clients')->where('id', $id)->delete();
        return redirect()->route('clients.index');
    }

    public function addCar(Request $request, $id)
    {
        $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'color' => 'required',
            'number' => 'required|unique:cars',
            'flexRadioDefault' => 'required'
        ]);
        $idCar =  DB::table('cars')->insertGetId([
            'brand' => $request->brand,
            'model' => $request->model,
            'color' => $request->color,
            'number' => $request->number,
            'check' => $request->flexRadioDefault]);

        $client = DB::table('clients')->select('fio', 'gender', 'phone', 'addres')->where('id',$id)->get();
        
        DB::table('clients')->insert([
            'fio' => $client[0]->fio,
            'gender' => $client[0]->gender,
            'phone' => $client[0]->phone,
            'addres' => $client[0]->addres,
            'car_id' => $idCar
        ]);
        
        return redirect()->route('clients.edit', $id);
    }
}
