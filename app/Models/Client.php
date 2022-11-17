<?php

namespace App\Models;

use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use HasFactory;

    protected $rulesCreate = [
        'fio' => 'required|min:3',
        'flexRadioDefault'=> 'required',
        'phone' =>'required|unique:clients'
    ];

    protected $rulesUpdateNonPhone = [
        'fio' => 'required|min:3',
        'flexRadioDefault'=> 'required',
    ];

    protected $rulesUpdatePhone = [
        'fio' => 'required|min:3',
        'flexRadioDefault'=> 'required',
        'phone' =>'required|unique:clients',
    ];

    public function createClientsValidate($values)
    {
        $valid = Validator::make($values, $this->rulesCreate);
        if($valid->passes()) return true;
        else return false;
    }
    

    public function allClients(){
        $clientsCar = DB::table('clients')
            ->join('cars', 'client_id', '=', 'clients.id')
            ->select('clients.id','cars.id as car_id','fio', 'brand', 'model', 'number')
            ->paginate(10);
        return $clientsCar;
    }

    public function addClient(Request $request){
        $idClient =  DB::table('clients')->insertGetId([
            'fio' => $request->fio,
            'gender' => $request->flexRadioDefault,
            'phone' => $request->phone,
            'addres' => $request->addres,
            'created_at' => Date::now()
        ]);
        return $idClient;
    }
    
    public function pageHome()
    {
        $carParking = DB::table('clients')
            ->join('cars', 'client_id', '=', 'clients.id')
            ->select('clients.id','cars.id as car_id','fio', 'brand', 'model', 'number')
            ->where('check', '1')
            ->paginate(10);

        $clientsSelect = DB::table('clients')
            ->select('id','fio')
            ->get();

        return  ['carParking' =>  $carParking, 'clientsSelect' => $clientsSelect];
    }

    public function getClient($id)
    {
        $client = DB::table('clients')
                ->select('id','fio', 'gender', 'phone', 'addres')
                ->where('id', $id)
                ->get();

        return $client;
    }

    public function updateClientValidate($values, Request $request, $id)
    {
        $phone = DB::table('clients')
            ->select('phone')
            ->where('id', $id)
            ->get();
        if($phone[0]->phone == $request->phone)
        {
            $valid = Validator::make($values, $this->rulesUpdateNonPhone);
            if($valid->passes()) return true;
            else return false;
        }
        else
        {
            $valid = Validator::make($values, $this->rulesUpdatePhone);
            if($valid->passes()) return true;
            else return false;
        }
        
    }

    public function updateClient(Request $request, $id){
        DB::table('clients')->where('id', $id)->update([
            'fio' => $request->fio,
            'gender' => $request->flexRadioDefault,
            'phone' => $request->phone,
            'addres' => $request->addres,
            'updated_at'=> Date::now()
        ]);
    }
}
