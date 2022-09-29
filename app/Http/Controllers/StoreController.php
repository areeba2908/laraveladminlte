<?php

namespace App\Http\Controllers;
use App\Store;
use App\Customer;

use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::getStores();
        //return [$stores]; //postman test
        return view('stores.index', compact('stores'))->with('errors');
    }

    public function getStoreCustomers($id)
    {
        $data = Store::find($id)->getStoreWithCustomers;
        //return [$stores]; //postman test
        return view('stores.storeUsers', compact('data'));
    }

    public function getStoreWarehouses($id)
    {
        $data = Store::find($id)->getStoreWithWarehouses;
        //return [$stores]; //postman test
        return view('stores.storeWarehouses', compact('data'));
    }

    public function createForm()
    {
        return view('stores.create');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'slug'=>'required|unique:stores,slug',
        ]);
        Store::createStore($request);
        session()->flash('success', 'Store Successfully Registered');
        //return['store created'];
        return redirect('/api/getStores');
//
    }

    public function edit($id)
    {
        if (Store::find($id)->exists()) {
            $store = Store::getStoreById($id);
            //$data = compact('store');
            //dd ($data);
            return view('stores.edit',compact('store'));
        }
        else {
            session()->flash('error', 'Store not found');
            return redirect('/api/getStores');
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
        Store::putStore($data,$id);
        //return ['store updated'];
        session()->flash('success', 'Store Details updated.');
        return redirect('/api/getStores');
    }

    public function delete($id)
    {
        if (Store::where('id', $id )->exists()) {
            $store = Store::getStoreById($id);
            Store::deleteStore($store);
            session()->flash('success', 'Store deleted.');
            //return ["store deleted"];
            return redirect('/api/getStores');
        }
        else {
            session()->flash('error', 'Store not found');
            //return ["store id not found"];
            return redirect('/api/getStores');
        }
    }


}
