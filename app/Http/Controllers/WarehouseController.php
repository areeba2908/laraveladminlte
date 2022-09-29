<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use APP\Warehouse;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::getWarehouses();
        return [$warehouses];
        //return view('users.stores', compact('stores'));
    }

    public function createForm()
    {
        return view('stores.create');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);
        Warehouse::createWarehouse($request);
        //session()->flash('success', 'Store Successfully Registered');
        return['store created'];
        //return redirect('/stores');
//
    }

    public function edit($id)
    {
        if (Warehouse::where('id', $id )->exists()) {
            $store = Warehouse::getStoreById($id);
            $data = compact('store');
            return view('users.edit')->with($data);
        }
        else {
            session()->flash('error', 'Store not found');
            return redirect('/stores');
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
        Warehouse::putWarehouse($data,$id);
        return ['store updated'];
//        session()->flash('success', 'Store Details updated.');
//        return  redirect('/stores');
    }

    public function delete($id)
    {
        if (Warehouse::where('id', $id )->exists()) {
            $Warehouse = Warehouse::getStoreByslug($id);
            Warehouse::deleteWarehouse($Warehouse);
            session()->flash('success', 'Store deleted.');
            return ["store deleted"];
            //return redirect('/stores');
        }
        else {
            session()->flash('error', 'Store not found');
            return ["store id not found"];
            //return redirect('/users');
        }
    }
}
