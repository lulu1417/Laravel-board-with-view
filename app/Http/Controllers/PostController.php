<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\User;
use Carbon\Carbon;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use View;
use App\CalculateTime;


class PostController extends Controller
{
    function index()
    {
        $posts = Post::with(['user',
            'comments' => function ($query) {
                $query->with('user', 'replies')->orderBy('created_at', 'desc');
            }, 'likes'])
            ->withCount('likes')
            ->withCount('comments')
            ->get();

        foreach ($posts as $post){
            $last = CalculateTime::transfer($post->created_at->toDateTimeString());
            $posts['last'] = $last;
        }

        return response()->json($posts);
//        return View('board')->with('posts', $posts)->with('posts_number', $posts_number);
    }

    function store(Request $request)
    {
        date_default_timezone_set('Asia/Taipei');

//        $user_id = Session::get('user_id', 'null');
//        $rules = [
//            'subject' => ['required', 'max:255'],
//            'content' => ['required', 'max:255'],
//        ];
//        $validator = validator::make($request->all(), $rules);
//
//        if ($validator->fails()) {
//            return view('addPost',['status' => 'invalid_input']);
//        }
//
        $request->validate([
            'content' => ['required', 'max:225'],
        ]);
        $create = Post::create([
            'user_id' => Auth::user()->id,
            'content' => $request['content'],
        ]);

        return response()->json($create, 200);

//        return redirect(route('board'));
    }

    function create()
    {
        if (!Session::get('user_id')) {
            return redirect(route('index'));
        }
        $user = User::find(Session::get('user_id'))->name;
        return View('addPost')->with('user', $user);
    }

    static function transfer($time)
    {
        if (strpos($time, date("Y-m-d")) == 0) {
            $now = date("Y-m-d H:i:s");

            $result['hour'] = floor((strtotime($now) - strtotime($time)) / 3600);
            $result['min'] = floor((strtotime($now) - ($result['hour'] * 3600) - strtotime($time)) / 60);
            $result['second'] = floor((strtotime($now) - ($result['hour'] * 3600) - ($result['min'] * 60) - strtotime($time)) % 60);

            return $result;

        } else {
            return 'more than 24';
        }

    }

    function allPost()
    {
        return response()->json(Post::with(['likes', 'user'])->withCount(['likes', 'comments'])->get());
    }
}
