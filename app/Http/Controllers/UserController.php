<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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

        $request->validate([
            'name' => ['required','unique:users'],
            'password' => ['required', 'between:4,20'],
        ]);

        $user = User::create([
            'name' => $request['name'],
            'password' => hash('sha256', $request['password']),
            'api_token' => Str::random(20),
        ]);

        return response()->json($user, 400);
//        $rules = [
//            'name' => ['required','unique:users'],
//            'password' => ['required', 'between:4,12'],
//        ];
//        $validator = validator::make($request->all(), $rules);
//
//        if ($validator->fails()) {
//            $status = 'invalid_input';
//            return View::make('index')->with('status', $status);
//        }

//        Session::put('user_id', $user->id);
//        return redirect(route('board'));
    }

    function login(Request $request)
    {
        $user = User::where('name', $request->name)->first();
        if(!$user){
//            $status = 'failed';
            return response()->json('name not found', 400);
//            return View::make('signin')->with('status', $status);
        }elseif($user->password !== hash('sha256', $request['password'])){
//            $status = 'failed';
//            return View::make('signin')->with('status', $status);
            return response()->json('wrong password', 400);
        }
//        Session::put('user_id', $user->id);
//        return redirect(route('board'));
        return response()->json($user);

    }
    function signin(){
        return view('signin');
    }

}
