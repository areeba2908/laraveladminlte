<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WarehouseCategory;

class WarehouseCategoryController extends Controller
{
    public function index()
    {
        $data = WarehouseCategory::getWarehouseCategories();
        return view('warehouseCategories.index', compact('data'))->with('errors');
    }

//    public function getStoreWarehouses($id)
//    {
//        $data = Store::find($id)->getCustomers;
//
//
//        //$stores = Store::getStores();
//        //return [$stores]; //postman test
//        return view('stores.storeUsers', compact('data'));
//    }

    public function createForm()
    {
        return view('warehouseCategories.create');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);
        WarehouseCategory::createWarehouseCategory($request);
        session()->flash('success', 'Warehouse Category Successfully Registered');
        return redirect('/api/getWarehouseCategories');
//
    }

    public function edit($id)
    {
        if (WarehouseCategory::find($id)->exists()) {
            $warehouseCategory = WarehouseCategory::getWarehouseCategoryById($id);
            return view('warehouseCategoryiesedit',compact('warehouseCategory'));
        }
        else {
            session()->flash('error', 'Store not found');
            return redirect('/api/getWarehouseCategories');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'name'=>'required',

        ]);
        $data =$request->all();
        WarehouseCategory::putWarehouseCategory($data,$id);
        session()->flash('success', 'Store Details updated.');
        return redirect('/api/getWarehouseCategories');
    }

    public function delete($id)
    {
        if (WarehouseCategory::where('id', $id )->exists()) {
            $warehouseCategory = WarehouseCategory::getWarehouseCategoryById($id);
            WarehouseCategory::deleteWarehouseCategory($warehouseCategory);
            session()->flash('success', 'Warehouse deleted.');
            return redirect('/api/getWarehouseCategories');
        }
        else {
            session()->flash('error', 'Store not found');
            //return ["store id not found"];
            return redirect('/api/getWarehouseCategories');
        }
    }
}
