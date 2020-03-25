<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use View;


class PostController extends Controller
{
    function index()
    {
        $posts = Post::with(['user','comments','likes'])->orderBy('id', 'desc')->get();
        $posts->posts_number = $posts->count();

        $posts = Post::with(['user', 'comments' => function ($query)  { $query->with('user','replies')->orderBy('created_at','desc'); },'likes'])->first();
        $posts->posts_number = $posts->count();
//
//        foreach ($posts as $post){
//            $post->comments = $post->comments->toArray();
//            $post->comments = array_map(function ($comment)  {
//                $comment['replies'] = Comment::with('replies')->find($comment['post_id']);
//                return $comment['replies'];
//            }, $post->comments);
//        }

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
}
