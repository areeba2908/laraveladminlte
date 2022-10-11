<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\Token;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function createUserToken($user){
        $oldTokens = $user->tokens;
        foreach ($oldTokens as $token){
            $token->revoke();
        }
        $accessToken = Auth::user()->createToken($user->id)->accessToken;
        return $accessToken;
    }

    public function getStore() //one
    {
        return $this->belongsToMany(Store::class, 'stores_users');
    }

    public static function getUserByEmail($email) {
        return User::where('email', $email)->first();
    }

    public static function getUsers(){
        return User::all();
    }

    public static function getUserById ($id) {
        return User::find($id);
    }

    public static function createUser ($request){
        User::create(array('name'=>$request['name'],
                            'email'=>$request['email'],
                            'password'=>$request['password'],
            ));
    }

    public static function putUser ($request,$id){
        $user = User::find($id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();
    }

    public static function deleteUser($user){
        $user->delete();
    }
}
