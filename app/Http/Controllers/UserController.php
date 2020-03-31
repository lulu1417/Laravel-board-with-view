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

        Log::info('request body：' . $request->body);
        Log::info('signup->' . 'name：' . $request->name . ' password：' . $request->password);
        date_default_timezone_set('Asia/Taipei');


//        $request->validate([
//            'name' => ['required','unique:users'],
//            'password' => ['required', 'between:4,20'],
//        ]);

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
        Log::info(response()->json($user, 200));
        return response()->json($user->makeVisible(['api_token', 'created_at']), 200);


//        Session::put('user_id', $user->id);
//        return redirect(route('board'));
    }

    function login(Request $request)
    {
        Log::info('request ：' . $request);
        Log::info('login-> name：' . $request['name'] . ' password：' . $request['password']);
        date_default_timezone_set('Asia/Taipei');
//        $request->validate([
//                'name' => ['required',],
//                'password' => ['required'],
//            ]
//        );

        $rules = [
            'name' => ['required'],
            'password' => ['required'],
        ];

        $validator = validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $status['message'] = 'invalid input';
            return response()->json($status, 400);
        }

        $user = User::where('name', $request->name)->first();
        if (!$user) {
//            $status = 'failed';
            $status['message'] = 'name not found';
            return response()->json($status, 400);
//            return View::make('signin')->with('status', $status);
        } elseif ($user->password !== hash('sha256', $request['password'])) {
            $status['message'] = 'wrong password';
            return response()->json($status, 400);
//            $status = 'failed';
//            return View::make('signin')->with('status', $status);
        }
        $user->update([
            'api_token' => Str::random(20),
        ]);
        return response()->json($user->makeVisible(['api_token', 'created_at']), 200);
//        Session::put('user_id', $user->id);
//        return redirect(route('board'));

    }

    function signin()
    {
        return view('signin');
    }

}
