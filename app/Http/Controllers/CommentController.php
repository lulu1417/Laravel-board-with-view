<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CalculateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($post_id)
    {
        $comments = Comment::with('user')->with('replies')->withCount('replies')->where('post_id', $post_id)->orderBy('id', 'desc')->get();
        $comments_number = $comments->count();
        return view('showComments', ['comments' => $comments, 'comments_number' => $comments_number, 'post_id' => $post_id]);
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


        $user_id = Session::get('user_id');
        if ($user_id != null) {
            Comment::create([
                'user_id' => $user_id,
                'post_id' => $request['post_id'],
                'content' => $request['content'],
            ]);
            return redirect(env('DOMAIN') . 'showComments/' . $request->post_id);

        } else {
            return redirect(route('board'));
        }

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

    function allComment(Request $request){
        $request->validate([
            'post_id' => ['required', 'exists:posts,id']
        ]);
        $comments = Comment::with(['user', 'replies'])->where('post_id', $request->post_id)->get();
        foreach ($comments as $item){
            $item['last'] = CalculateTime::transfer($item->created_at->toDateTimeString());
            foreach ($item->replies as $item){
                $item['last'] = CalculateTime::transfer($item->created_at->toDateTimeString());
            }

        }
        return response()->json($comments);
    }
}
