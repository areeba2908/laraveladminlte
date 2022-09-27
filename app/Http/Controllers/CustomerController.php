<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Contracts\Validation\Validator;


class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::getCustomers();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($data) {
                    if ($data->status == 0) return 'Offline';
                    if ($data->status == 1) return 'Online';
                    return 'Cancel';
                })
                ->addColumn('action', function($row){ //html

                    $btn =  '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-primary btn-sm editCustomer">Edit</a>';
                    $btn =  $btn.'<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteCustomer">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])// html parse
                ->make(true);
        }

        return view('customers.index');
    }

    public function createForm()
    {
        return view('customers.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',

                'status' => 'required'
            ]);
            if ($validator->fails()) {
                //dd($validator);
                return response()->json([
                    'status' => 400, 'success' => $validator->errors()->toArray()
                ]);
            } else {
                //$validated = $validator->validated();
                //dd($validated);
                Customer::createCustomer($request);
                session()->flash('success', 'Customer Successfully Registered');
                return response()->json(['status' => 200, 'success' => 'Customer Added to Record']);
            }

        }
        catch(\Exception $e) {
          //session()->flash('error', json_encode($e->getMessage(), true));
          //echo 'Message: ' .$e->getMessage();
            //return response()->json(["status"=>true,"message"=>$e->getMessage()]);
            return response()->json([ "error" =>"exception"]);
         }

    }
//open form on same page
    public function edit($id)
    {
        try {
            if (Customer::where('id', $id)->exists()) {
                $data = Customer::getCustomerById($id);
                //$data = compact('customer');
                return response()->json($data);
                //return view('customers.edit')->with($data);
            } else {
                session()->flash('error', 'Customer not found');
                return response()->json(["error" => "Customer ID Not Found"]);
            }
        }
        catch(\Exception $e) {
            //session()->flash('error', json_encode($e->getMessage(), true));
            //echo 'Message: ' .$e->getMessage();
            //return response()->json(["status"=>true,"message"=>$e->getMessage()]);
            return response()->json([ "error" =>$e->getMessage()]);
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
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'phonenumber' => 'required',
                'status' => 'required'
            ]);
            if ($validator->fails()) {
                //dd($validator);
                return response()->json([
                    'status' => 400, 'success' => $validator->errors()->toArray()
                ]);
            } else {
                //$validated = $validator->validated();
                //dd($validated);
                Customer::putCustomer($request,$id);
                session()->flash('success', 'Customer Successfully updated');
                return response()->json(['status' => 200, 'success' => 'Customer Successfully updated']);
            }

        }
        catch(\Exception $e) {
            //session()->flash('error', json_encode($e->getMessage(), true));
            //echo 'Message: ' .$e->getMessage();
            //return response()->json(["status"=>true,"message"=>$e->getMessage()]);
            return response()->json([ "error" =>$e->getMessage()]);
        }
    }

    //open new form
    public function editTwo($id){
        $customer = Customer::getCustomerById($id);
        return view('customers.edit',compact('customer'));
    }

    public function updateTwo($id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phonenumber' => 'required',
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            //dd($validator);
            return response()->json([
                'status' => 400, 'success' => $validator->errors()->toArray()
            ]);
        } else {
            //$validated = $validator->validated();
            //dd($validated);
            Customer::putCustomer($request,$id);
            session()->flash('success', 'Customer Successfully updated');
            return response()->json(['status' => 200, 'success' => 'Customer Successfully updated']);
        }
    }

    public function delete($id)
    {
        if (Customer::where('id', $id)->exists()) {
            $user = Customer::getCustomerById($id);
            Customer::deleteCustomer($user);
            session()->flash('success', 'User deleted.');
            return response()->json(["status"=>true,"success"=>"User Deleted"]);
        } else {
            session()->flash('error', 'User not found');
            return response()->json(["error"=>"User not Found"]);
        }
    }

    public function updateOrCreate(){

            $student = Customer::updateOrCreate(
                ['name' => 'advanced web tutorial', 'email' => 'advancedweb@gmail.com', 'phonenumber' => '03458890877','status'=>1]
            );

        return  redirect('/customers');

    }
}
