<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehouseCategory extends Model
{
    protected $table = 'warehousecategories';

    protected $fillable = [
        'name','status','slug'
    ];

//    public function getWarehousesWithStores() //many to many relationship function
//    {
//        return $this->belongsToMany(Warehouse::class, 'stores_warehouses');
//    }

    public static function getWarehouseCategories(){
        return WarehouseCategory::all();
    }

//    public static function getWarehouseCategoryBySlug ($slug) {
//        return WarehouseCategory::where('slug', $slug)->first();
//    }

    public static function getWarehouseCategoryById ($id) {
        return WarehouseCategory::find($id);
    }

    public static function createWarehouseCategory ($request){
        if ($request['status']=='active'){
            $status=1;
        }
        else{
            $status=0;
        }
        WarehouseCategory::create(array('name'=>$request['name'],
            'slug'=>$request['slug'],
            'status'=>$status,
        ));
    }

    public static function putWarehouseCategory ($request,$id){
        if ($request['status']=='active'){
            $status=1;
        }
        else{
            $status=0;
        }
        $warehouseCategory = WarehouseCategory::find($id);
        $warehouseCategory->name = $request['name'];
        $warehouseCategory->slug= $request['slug'];
        $warehouseCategory->status = $status;
        $warehouseCategory->save();
    }

    public static function deleteWarehouseCategory($warehouseCategory){
        $warehouseCategory->delete();
    }
}
