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
//            $last = $this->transfer($post->created_at);
//            dd($last);
        }

        $posts->posts_number = $posts->count();

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
        if(strpos($time, date("Y-m-d") == 0)){
            $now = date("Y-m-d H:i:s");
//            var_dump(strtotime($now));
            $startdate="2011-3-15 11:50:00";
//            var_dump(strtotime("2015-11-18 23:00:00"));
            die();
            $last = strtotime($now) - strtotime($time);
             $last['second'] = (strtotime($now) - strtotime($time)); //計算相差之秒數
            $last['min'] =  (strtotime($now) - strtotime($time))/ (60); //計算相差之分鐘數
            $last['hour'] =  (strtotime($now) - strtotime($time))/ (60*60); //計算相差之小時數

            return $last;

        }else{
            return $time;
        }

    }
}
