<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warehouse;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::getWarehouses();
        return view('warehouses.index', compact('warehouses'))->with('errors');
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
        return view('warehouses.create');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);
        Warehouse::createWarehouse($request);
        session()->flash('success', 'Warehouse Successfully Registered');
        return redirect('/api/getWarehouses');
//
    }

    public function edit($id)
    {
        if (Warehouse::find($id)->exists()) {
            $warehouse = Warehouse::getWarehouseById($id);
            return view('warehouses.edit',compact('warehouse'));
        }
        else {
            session()->flash('error', 'Store not found');
            return redirect('/api/getWarehouses');
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
        StoreWarehouse::putWarehouse($data,$id);
        session()->flash('success', 'Store Details updated.');
        return redirect('/api/getWarehouses');
    }

    public function delete($id)
    {
        if (Warehouse::where('id', $id )->exists()) {
            $warehouse = Warehouse::getWarehouseById($id);
            Warehouse::deleteWarehouse($warehouse);
            session()->flash('success', 'Warehouse deleted.');
            return redirect('/api/getWarehouses');
        }
        else {
            session()->flash('error', 'Store not found');
            //return ["store id not found"];
            return redirect('/api/getWarehouses');
        }
    }
}
