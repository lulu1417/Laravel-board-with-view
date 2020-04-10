<title>All Posts</title>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<body>
<div class="flex-center position-ref full-height">
    <div class="top-right home">
        @include('layouts.nav')
    </div>

</div>
<div class="note full-height">

        <h2><font color=#5599FF>Posts</font></h2>
        @foreach ($posts as $post)
        <div style="border-width:1px;border-style:double;border-color:#CCDDFF;padding:50px;">
            Author：{{$post->user->name}}
            <br>Subject：{{$post->subject}}
            <br>Content：{{$post->content}}
            <br>Time：{{$post->created_at}}
            <form name="form1" action={{route('storeLike')}} method="post">
                @csrf
                <input type="hidden" name="post_id" value='{{$post->id}}'>
                <input type="submit" name="submit" value="Like 👍">
            </form>   <a href={{env('APP_URL')}}showLikes/{{$post->id}}>See who likes this post</a>

            @if($post->comments->count() > 0)
                <hr>
                <div class="sub-content">
                    <div style="border-width:1px;border-style:double;border-color:#CCDDFF;padding:50px;">
                        <h3><font color=#5599FF> Comments</font></h3>
                        <hr>
                        @foreach($post->comments as $comment)
                            Author：{{$comment->user->name}}
                            <br>Content：{{$comment->content}}
                            <br>Time：{{$comment->created_at}}
                            <hr>
                        @endforeach
                        <br><a href={{env('APP_URL')}}showComments/{{$post->id}}>All comments</a>
                    </div>
                </div>
            @endif
            <h3><font color=#5599FF>Reply This Post</font></h3>
            <form name="form1" action="storeComment" method="post">
                @csrf
                <input type="hidden" name="post_id" value='{{$post->id}}'>
                <p><textarea style="font-family: \'Nunito\', sans-serif; font-size:20px; width:550px;height:100px;"
                             name="content"></textarea></p>
                <p><input type="submit" name="submit" value="SEND">
            </form>
            <link rel="stylesheet" href="{{ asset('css/button.css') }}">

        </div>
        <br>
        @endforeach
        <div class="bottom left position-abs content">
            There are {{$posts_number}} posts.
        </div>
    </div>
</body>
</html>
