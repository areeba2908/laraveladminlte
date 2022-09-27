<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'email', 'phonenumber', 'status'
    ];

    public static function getCustomers(){
        return Customer::all();
    }

    public static function getCustomerById ($id) {
        return Customer::find($id);
    }

    public static function createCustomer ($request){
        if ($request['status']=='online'){
            $status=1;
        }
        else{
            $status=0;
        }
//       $status=intval($request['status']);
        Customer::create(array('name'=>$request['name'],
            'email'=>$request['email'],
            'password'=>$request['password'],
           'phonenumber' => $request['phonenumber'],
            'status' => $status,
        ));
    }

    public static function putCustomer ($request,$id){
        if ($request['status']=='online'){
            $status=1;
        }
        else{
            $status=0;
        }
        $customer = Customer::find($id);
        $customer->name = $request['name'];
        $customer->email = $request['email'];
        $customer->phonenumber = $request['phonenumber'];
        $customer->status = $status;
        $customer->save();
    }

    public static function deleteCustomer($customer){
        $customer->delete();
    }
}
