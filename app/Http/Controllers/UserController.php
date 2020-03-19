<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use View;
use Illuminate\Support\Str;

class UserController extends Controller
{
    function index()
    {
        return view('index');
    }

    function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'unique:users'],
            'password' => ['required', 'between:4,12'],
        ];
        $validator = validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $status = 'invalid_input';
            return View::make('index')->with('status', $status);
        }

        $user = User::create([
            'name' => $request['name'],
            'password' => hash('sha256', $request['password']),
            'api_token' => Str::random(20),
        ]);

        return View::make('board')->with('token', $user->api_token);
    }

    function login(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::where('name', $request->name)->first();
        if(!$user){
            $status = 'failed';
            return View::make('signin')->with('status', $status);
        }elseif($user->password !== hash('sha256', $request['password'])){
            $status = 'failed';
            return View::make('signin')->with('status', $status);
        }
        return view('board');

    }
    function signin(){
        return view('signin');
    }

}
