<?php

namespace App\Http\Controllers;

use App\Like;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($post_id)
    {
        $likes = Like::with('user')->where('post_id', $post_id)->orderBy('id', 'desc')->get();
        $likes_number = $likes->count();
        $user_id = Session::get('user_id');
        if($user_id != null){
            $name = User::find(Session::get('user_id'))->name;
        }else{
            $name = null;
        }
        return view('showLikes', [
            'likes' => $likes,
            'likes_number' => $likes_number,
            'user_name' => $name,
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
            'post_id' => ['required', 'exists:posts,id'],
        ]);

        if(Like::where('user_id', Auth::user()->id)->where('post_id', $request['post_id'])->get()->count() > 0){
            return response()->json('already_liked');
//            $like = Like::all();
//            return response()->json($like, 200);
        }
        $create = Like::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request['post_id'],
        ]);

        return response()->json($create, 200);

//        $user_id = Session::get('user_id', 'null');
//        $request->validate([
//            'post_id' => ['required', 'exists:posts,id'],
//        ]);
//
//        if (Like::where('user_id', $user_id)->where('post_id', $request->post_id)->count() == 0 && $user_id != 'null') {
//            Like::create([
//                'user_id' => $user_id,
//                'post_id' => $request['post_id'],
//            ]);
//        }
//        return redirect(env('DOMAIN') . 'showLikes/' . $request->post_id);
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
    public function destroy(Request $request)
    {
        $request->validate([
           'like_id' => ['required', 'exists:likes,id']
        ]);
            $like = Like::find($request->like_id);
            $delete = $like->delete();
            return response()->json($delete, 200);

//        Like::find($request->like_id)->delete();
//        return redirect(env('DOMAIN') . 'showLikes/' . $request->post_id);
    }
}
