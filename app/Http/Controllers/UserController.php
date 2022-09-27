<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::getUsers();
        return view('users.index', compact('users'));
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

}
