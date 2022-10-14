<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Store;

class RoleController extends Controller
{
    public function index(){
        $roles= Role::all();
        return view ('roles.index',compact('roles'));
    }

    public function assignRoles($id){
        $role= Role::findById($id);
        $stores= Store::all();
        return view ('roles.assignRole',compact('role','stores'));
    }

    public function roleToStores(Request $request, $id)
    {
       $storeIds= $request->get('stores');
       $role= Role::findById($id);   //for this role many stores can be accessed
        $role->stores()->sync($storeIds);
       return redirect ('/api/getAllRoles');
    }

}
