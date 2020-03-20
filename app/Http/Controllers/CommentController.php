<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
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
        $comments = Comment::with('user')->where('post_id', $post_id)->orderBy('id', 'desc')->get();
        $comments_number = $comments->count();
        return view('showComments', ['comments' => $comments, 'comments_number' => $comments_number]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Session::get('user_id', 'null');
        $rules = [
            'post_id' => ['required', 'exists:posts,id'],
            'content' => ['required', 'max:255'],
        ];
        $validator = validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return view('board',['status' => 'invalid_input']);
        }

        Comment::create([
            'user_id' => $user_id,
            'post_id' => $request['post_id'],
            'content' => $request['content'],
        ]);

        return redirect('http://localhost:8000/showComments/'.$request->post_id);
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
}
