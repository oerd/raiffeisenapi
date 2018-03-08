<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Redirect;

class LoginController extends Controller
{

    protected $redirectTo = '/home';
    private $user;

    public function __construct(){
      return $this->user;
    }

    public function login()
{
    $credentials = Input::only('email', 'password');
    if (!$token = JWTAuth::attempt($credentials)) {
        return Response::json(["response" => "Error", "message" => "Username/Password wrong"]);
    } else {
        $token = JWTAuth::attempt($credentials);
        $user = Auth::user();
        if($user->role == 0){
            return view('admin.home')->with('token','user');
        }elseif ($user->role == 2) {
            return view('agency.home')->with('token','user');
        }else{
            return Response::json(compact('token', 'user'));
        }
    }
}

    public function signOut() {
        Auth::logout();
        return Redirect::route('/');
    }

    public function loginMobile()
    {
        $credentials = Input::only('phone', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return Response::json(["response" => "Error", "message" => "Username/Password wrong"]);
        } else {
            $token = JWTAuth::attempt($credentials);
            $user = Auth::user();
            return Response::json(["response" => "Success", "message" => compact('token', 'user')]);
        }
    }

    public function signup()
    {
        $email = request('email');
        $password = request('password');
        $name = request('name');
        $username =request('username');
        $phone = request('phone');
        $find = User::where('email', $email)->first();

        if (count($find) == 0 ) {
            $user = new User();
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->name = $name;
            $user->phone = $phone;
            $user->role = 1;
            $user->username = $username;
            $user->save();
            $token = JWTAuth::fromUser($user);
            return Response::json(["response" => "Success", "message" => compact('token', 'user')]);
        }else {
            return Response::json(["response" => "error", "message" => "Already exists!" ]);
        }
    }

    public function hashmake() {
        $pass = request('password');
        $password = Hash::make($pass);
        return $password;
    }

    public function expireToken() {
        try {
            $token = JWTAuth::getToken();
            $new_token = JWTAuth::refresh($token);
            return Response::json(["reponse" => "Success", "token" => $new_token ]);
        } catch (Exception $e){
            return Response::json(["response" => "Exception", "message" => "Your token has been blacklisted!"]);
        }   
    }
    
}
