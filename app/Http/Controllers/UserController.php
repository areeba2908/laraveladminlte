<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\RefreshTokenRepository;
use Laravel\Passport\Token;
use Illuminate\Support\Facades\Cookie;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth:api');
//    }
    public function index(Request $request)
    {
        $users = User::getUsers();
        //return response()->json(['headers'=>$request->headers->all(),'users'=>auth()->user()]);
        return view('users.index', compact('users'));
    }
    public function getAllUsers(){
        $users = User::getUsers();
        return view('users.index', compact('users'));
    }

    public function getUserRoles($id){
        $user = User::getUserById($id);
        $roles = $user->roles->all(); // $userRole = $user->roles->pluck('name','name')->all();
//        dd([$roles]);
        return view('users.roles', compact('roles'));
    }

    public function createForm()
    {
        return view('users.create');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        User::createUser($request);
        session()->flash('success', 'User Successfully Registered');
        return redirect('/users');
//
    }

    public function edit($id)
    {
        if (User::where('id', $id )->exists()) {
            $user = User::getUserById($id);
            $data = compact('user');
            return view('users.edit')->with($data);
        }
        else {
            session()->flash('error', 'User not found');
            return redirect('/users');
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
            'email'=>'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        $data =$request->all();
        User::putUser($data,$id);
        session()->flash('success', 'User Details updated.');
        return  redirect('/users');
    }

    public function delete($id)
    {
        if (User::where('id', $id )->exists()) {
            $user = User::getUserById($id);
            User::deleteUser($user);
            session()->flash('success', 'User deleted.');
            return redirect('/users');
        }
        else {
            session()->flash('error', 'User not found');
            return redirect('/users');
        }
    }
    ////////////////////////////////////////////////////
    ///
    ///
    public function registerPage(){
        $roles=Role::all();
        return view('users.user_login.register', compact('roles'));
    }

    public function customLogin(Request $request)
    {
        try {
            $data = [
                'email' => $request->email,
                'password' => $request->password
            ];
            if (Auth::attempt($data)) {
                $user= User::getUserByEmail($request->email);
                $token =   Token::where('name', $user->id)->first();
                 if ($token !=null) {
                     $accessToken= User::createUserToken($user);
                     $minutes = 30;
                     //dd([request()->cookie('token')]);
                     return response()->json(['status'=>'200','success'=>'User Logged in.','user'=>Auth::user(),'token'=>$accessToken])->withCookie(cookie('accessToken', $accessToken, $minutes));
                 }
            } else {
                return response()->json(['error' => 'Unauthorised'], 400);
            }
        }
        catch(\Exception $e){
            echo 'Message: ' .$e->getMessage();
        }

    }

    public function customRegister(Request $request)
    {
        try {

            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:4',
            ]);

            if ($request['status']=='active'){
                $status=1;
            }
            else{
                $status=0;
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'status' => $status,
                'password' => Hash::make($request->password) //Hash::make()
            ]);

            $user->assignRole($request->input('roles')); //syncrole

            $accessToken = $user->createToken($user->id)->accessToken;
            $minutes = 30;
            return response()->json(['status'=>'200','success'=>'User Logged in.','user'=>Auth::user(),'token'=>$accessToken])->withCookie(cookie('accessToken', $accessToken, $minutes));

        }
        catch(\Exception $e){
            return response()->json(['status'=>'400','error' => $e->getMessage()]);
        }
    }


    public function userLogout(Request $request) {

       $user= auth()->user();
        $oldTokens = $user->tokens;
        foreach ($oldTokens as $token){
            $token->revoke();
        }
        return Redirect('/api_web/login');
    }

    public function guzzleGetRequest(){
        $users = User::getUsers();
        return response()->json(["data"=>$users]);
    }

    public function guzzlePostRequest(Request $request){
        if ($request['status']=='active'){
            $status=1;
        }
        else{
            $status=0;
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $status,
            'password' => Hash::make($request->password) //Hash::make()
        ]);
        return response()->json(["success"=>'user posted through post request']);
    }



}
