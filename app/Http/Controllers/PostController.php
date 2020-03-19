<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use View;
use Illuminate\Support\Str;


class PostController extends Controller
{
    function index()
    {
        $posts = Post::with('user')->get();
        $posts_number = $posts->count();
        return View('board')->with('posts', $posts)->with('posts_number', $posts_number)->with('user', Auth::user());
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

        $user = Post::create([
            'user_id' => Auth::user()->id,
            'subject' => $request['subject'],
            'content' => $request['content'],
        ]);

        return View::make('board')->with('token', $user->api_token);
    }
}
