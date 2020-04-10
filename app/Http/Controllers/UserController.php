<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidateRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use View;
use Illuminate\Support\Str;

class UserController extends Controller
{
    private  $rules = [
        'name' => ['required'],
        'password' => ['required', 'between:4,20'],
    ];

    function index()
    {
        return view('index');
    }

    function store(Request $request)
    {

        $rules = [
        'name' => ['required', 'unique:users'],
        'password' => ['required', 'between:4,20'],
    ];

        $validator = validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $status['message'] = 'invalid input';
            return response()->json($status, 400);
        }


        $user = User::create([
            'name' => $request['name'],
            'password' => hash('sha256', $request['password']),
            'api_token' => Str::random(20),

        ]);

        Session::put('user_id', $user->id);
        return redirect(route('board'));
    }

    function login(Request $request)
    {
        $rules = [
            'name' => ['required'],
            'password' => ['required'],
        ];

        $validator = validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $status['message'] = 'invalid input';
        }

        $user = User::where('name', $request->name)->first();
        if (!$user) {
            $status = 'failed';
            return View::make('signin')->with('status', $status);
        } elseif ($user->password !== hash('sha256', $request['password'])) {
            $status = 'failed';
            return View::make('signin')->with('status', $status);
        }
        $user->update([
            'api_token' => Str::random(20),
        ]);

        Session::put('user_id', $user->id);
        return redirect(route('board'));

    }

    function signin()
    {
        return view('signin');
    }

}
