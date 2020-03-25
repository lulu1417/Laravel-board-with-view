<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Reply;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($comment_id)
    {
        $replies = Reply::with('user')->with('comment')->where('comment_id', $comment_id)->orderBy('id', 'desc')->get();
        $replies_number = $replies->count();
        $post_id = Comment::find($comment_id)->post_id;
        return view('showReplies', [
            'replies' => $replies,
            'replies_number' => $replies_number,
            'comment_id' => $comment_id,
            'post_id' => $post_id,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        date_default_timezone_set('Asia/Taipei');

        $request->validate([
            'comment_id' => ['required', 'exists:comments,id'],
            'content' => ['required', 'max:255'],
        ]);

        $create = Reply::create([
            'user_id' => Auth::user()->id,
            'comment_id' => $request['comment_id'],
            'content' => $request['content'],
            'created_at' => Carbon::now(),
        ]);

        return response()->json($create, 200);

//        $user_id = Session::get('user_id');
//        $request->validate([
//            'comment_id' => ['required', 'exists:comments,id'],
//            'content' => ['required', 'max:255'],
//        ]);
//        if ($user_id != null) {
//            Reply::create([
//                'user_id' => $user_id,
//                'comment_id' => $request['comment_id'],
//                'content' => $request['content'],
//            ]);
//        } else {
//            return redirect(env('DOMAIN') . 'showComments/' . Comment::find($request->comment_id)->post_id);
//        }
//        return redirect(env('DOMAIN') . 'showReplies/' . $request->comment_id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    function allReply(){
        return response()->json(Reply::with('user')->get());
    }
}
