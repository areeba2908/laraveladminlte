<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouses';

    protected $fillable = [
        'name','location','status'
    ];

    public function getWarehousesWithStores() //many to many relationship function
    {
        return $this->belongsToMany(Warehouse::class, 'stores_warehouses');
    }

    public static function getWarehouses(){
        return Warehouse::all();
    }

    public static function getWarehouseBySlug ($location) {
        return Warehouse::where('location', $location)->first();
    }

    public static function getWarehouseById ($id) {
        return Warehouse::find($id);
    }

    public static function createWarehouse ($request){
        if ($request['status']=='active'){
            $status=1;
        }
        else{
            $status=0;
        }
        Warehouse::create(array('name'=>$request['name'],
            'location'=>$request['location'],
            'status'=>$status,
        ));
    }

    public static function putWarehouse ($request,$id){
        if ($request['status']=='active'){
            $status=1;
        }
        else{
            $status=0;
        }
        $warehouse = Warehouse::find($id);
        $warehouse->name = $request['name'];
        $warehouse->location= $request['location'];
        $warehouse->status = $status;
        $warehouse->save();
    }

    public static function deleteWarehouse($warehouse){
        $warehouse->delete();
    }


}
