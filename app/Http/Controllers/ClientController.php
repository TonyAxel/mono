<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelClient = new Client();
        $clientsCar = $modelClient->allClients();
        return view('clients', compact('clientsCar'));
    }

    public function pageHome(){
        $modelClient = new Client();
        $ar = $modelClient->pageHome();
        return view('home', ['carParking' => $ar['carParking'], 'clientsSelect' => $ar['clientsSelect']]);
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
        
        $modelClient = new Client();
        $modelCar = new Car();
        if($modelClient->createClientsValidate($request->all()) === true && $modelCar->createCarValidate($request->all()) === true) 
        {    
            $idClient = $modelClient->addClient($request);
            $modelCar->addCar($request, $idClient);
            return redirect()->back();
        }
        if($modelClient->createClientsValidate($request->all()) !== true){
            $errors = $modelClient->createClientsValidate($request->all());
            return redirect()->route('clients.create')->withErrors($errors)->withInput();
        }
        if($modelCar->createCarValidate($request->all()) !== true){
            $errors = $modelCar->createCarValidate($request->all());
            return redirect()->route('clients.create')->withErrors($errors)->withInput();
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modelClient = new Client();
        $modelCar = new Car();

        $client = $modelClient->getClient($id);
        $cars = $modelCar->getCarsClient($id);
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
        $modelClient = new Client();

        if($modelClient->updateClientValidate($request->all(), $request, $id)){
            $modelClient->updateClient($request, $id);
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function updateCar(Request $request, $id){
        $modelCar = new Car();

        if($modelCar->updateCarValidate($request->all(), $request, $id)){
            $modelCar->updateCar($request, $id);
            return redirect()->back();
        }
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modelCar = new Car();
        $modelCar->deleteCar($id);
        return redirect()->back();
    }

    
}
