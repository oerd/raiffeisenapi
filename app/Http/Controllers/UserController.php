<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Response;

class UserController extends Controller
{
    // public function __construct() {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        if (Auth::user() == null)
            return view('/login');
        else
            return redirect('/home');
    }

    public function edit(Request $request)
    {
        $user = Auth::user();
        // dd($user);

        if ($request->has('email')) {
            $user->email = request('email');
        }

        if ($request->has('name')) {
            $user->name = request('name');
        }

        if ($request->has('phone')) {
            $user->phone = request('phone');
        }

        if ($request->has('username')) {
            $user->sex = request('gender');
        }

        if ($request->has('password')) {
            $user->password = Hash::make(request('password'));
        }

        $user->save();
        return Response::json(["response" => "Success", "message" => "User Updated"]);
    }

    public function delete()
    {
        $user = Auth::user();
        $deleteUser = $user->delete();
        if ($deleteUser) {
            return Response::json(["response" => "Success", "message" => "Account Deleted"]);
        } else {
            return Response::json(["response" => "Error", "message" => "Your account could not be deleted!"]);
        }
    }
}
