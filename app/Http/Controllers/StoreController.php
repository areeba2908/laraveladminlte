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
        $data = Store::find($id)->getCustomers;


        //$stores = Store::getStores();
        //return [$stores]; //postman test
        return view('stores.storeUsers', compact('data'));
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
        Store::createStore($request);
        //session()->flash('success', 'Store Successfully Registered');
        return['store created'];
        //return redirect('/stores');
//
    }

    public function edit($slug)
    {
        if (Store::where('slug', $slug )->exists()) {
            $store = Store::getStoreById($slug);
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
    public function update($slug, Request $request)
    {
        $request->validate([
            'name'=>'required',

        ]);
        $data =$request->all();
        Store::putStore($data,$slug);
        return ['store updated'];
//        session()->flash('success', 'Store Details updated.');
//        return  redirect('/stores');
    }

    public function delete($slug)
    {
        if (Store::where('slug', $slug )->exists()) {
            $store = Store::getStoreByslug($slug);
            Store::deleteStore($store);
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
