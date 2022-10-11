<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Store extends Model
{
    protected $table = 'stores';

    protected $fillable = [
        'name','slug','status'
    ];

    public function getStoreWithUsers() //one
    {
        return $this->belongsToMany(User::class, 'stores_users');
    }

    public function getStoreWithCustomers() //one
    {
        return $this->belongsToMany(Customer::class, 'stores_customers');
    }

    public function getStoreWithWarehouses() //one
    {
        return $this->belongsToMany(Warehouse::class, 'stores_warehouses');
    }

    public static function getStores(){
        return Store::all();
    }

    public static function getStoreBySlug ($slug) {
        return Store::where('slug', $slug)->first();
    }

    public static function getStoreById ($id) {
        return Store::find($id);
    }

    public static function createStore ($request){
        if ($request['status']=='online'){
            $status=1;
        }
        else{
            $status=0;
        }
        return Store::create(array('name'=>$request['name'],
            'slug'=>$request['slug'],
            'status'=>$status,
        ));
    }

    public static function putStore ($request,$id){
        if ($request['status']=='active'){
            $status=1;
        }
        else{
            $status=0;
        }
        $store = Store::find($id);
        $store->name = $request['name'];
        $store->slug = $request['slug'];
        $store->status = $status;
        $store->save();
    }

    public static function deleteStore($store){
        $store->delete();
    }
}
