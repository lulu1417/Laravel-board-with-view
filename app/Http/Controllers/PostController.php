<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use View;


class PostController extends Controller
{
    function index()
    {
        $posts = Post::with('user')->orderBy('id', 'desc')->get();
        $posts_number = $posts->count();
        return View('board')->with('posts', $posts)->with('posts_number', $posts_number);
    }

    function store(Request $request)
    {
        $user_id = Session::get('user_id', 'null');
        $rules = [
            'subject' => ['required', 'max:255'],
            'content' => ['required', 'max:255'],
        ];
        $validator = validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return view('addPost',['status' => 'invalid_input']);
        }

        Post::create([
            'user_id' => $user_id,
            'subject' => $request['subject'],
            'content' => $request['content'],
        ]);

        return redirect(route('board'));
    }

    function addPost()
    {
        if(!Session::get('user_id')) {
            return redirect(route('index'));
        }
        $user = User::find(Session::get('user_id'))->name;
        return View('addPost')->with('user', $user);
    }
}
