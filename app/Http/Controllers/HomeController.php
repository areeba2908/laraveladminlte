<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (auth()->user()->name == 'areeba'){
//            $permission= Permission::create(['name'=>'Store-Access']);
//            $role=Role::findByName('admin');
//            $role->givePermissionTo($permission);
           //Role::create(['name'=>'admin']);
            auth()->user()->assignRole('admin'); //admin has create and edit permission
        }
        elseif (auth()->user()->name == 'nabiza'){
//            $role= Role::create(['name'=>'customer']);
//            $permission= Permission::findByName('Store-Access');
//            $role->givePermissionTo($permission);
            auth()->user()->assignRole('customer');
        }
        return view('welcome');

    }

    public function testingRoles(){
//        $data= auth()->user();
        //$role= Role::create(['name'=>'writer']); //change default guard in config/auth.php to api/web
        $permission= Permission::create(['name'=>'Store-Access']);
//        $role=Role::findByName('admin');
//        $permission=Permission::findById(4);
//        $role->givePermissionTo($permission); //1
////        $permission->assignRole($role);
////        auth()->user()->givePermissionTo('create store'); //direct permission
//        auth()->user()->assignRole('writer'); //2
////        $data= auth()->user()->getDirectPermissions();
////        $data= auth()->user()->getRoleNames();
//        $data= auth()->user()->getPermissionsViaRoles();
////        return User::role('admin')->get();

       echo $permission;
    }
}
