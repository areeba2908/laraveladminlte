<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Store extends Model
{
    protected $table = 'stores';

    protected $fillable = [
        'name','slug','status'
    ];

    public function getCustomers() //one
    {
        return $this->belongsToMany(Customer::class, 'stores_customers');
    }

    public static function getStores(){
        return Store::all();
    }

    public static function getStoreBySlug ($slug) {
        return Store::where('slug', $slug)->first();
    }

    public static function createStore ($request){
        Store::create(array('name'=>$request['name'],
            'slug'=>$request['slug'],
            'status'=>$request['status'],
        ));
    }

    public static function putStore ($request,$slug){
        $store = Store::where('slug', $slug)->first();
        $store->name = $request['name'];
        $store->slug = $request['slug'];
        $store->status = $request['status'];
        $store->save();
    }

    public static function deleteStore($store){
        $store->delete();
    }
}
