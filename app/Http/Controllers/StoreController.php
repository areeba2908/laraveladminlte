<?php

namespace App\Http\Controllers;
use App\Store;
use App\Warehouse;
use Illuminate\Support\Facades\DB;

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
        $store_id = $id;
        //echo ($data);
        //return [$stores]; //postman test
        return view('stores.storeWarehouses', compact('data','store_id'));
    }

    public function getAssignWarehouseForm($id){
        $store=Store::find($id);
        $warehouses= Warehouse::getWarehouses();
        return view('stores.assignWarehouseForm', compact('store','warehouses'));
    }

    public function postWarehouseStoreForm($id, Request $request){
        DB::transaction(function($id, $request) {

            $store = Store::find($id);
            $warehouse = [$request['warehouse']]; //you can pass more warehouses from frontend to here
            $store->getStoreWithWarehouses()->attach($warehouse);
            return redirect('/api/getStoreWarehouses/' . $store->id);
        });
    }

    public function createForm()
    {
        $warehouses=Warehouse::getWarehouses();
        return view('stores.create',compact('warehouses'));
    }

    public function create(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required',
                'slug' => 'required|unique:stores,slug',
            ]);
            $store = Store::createStore($request);
            $warehouses = $request->get('warehouses');
            if (empty($warehouses)){
                DB::commit();
                return redirect('/api/getStores');
            }
            else{
                $store->getStoreWithWarehouses()->attach($warehouses);
                DB::commit();
                return redirect('/api/getStores');
            }
            //session()->flash('success', 'Store Successfully Registered');
            //return['store created'];

        }
        catch(\Exception $e){
            DB::rollback();
            echo $e;
        }
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
