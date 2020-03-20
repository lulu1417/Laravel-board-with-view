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
        Author：{{$post->user->name}}
        <br>Subject：{{$post->subject}}
        <br>Content：{{$post->content}}
        <br>Time：{{$post->created_at}}
        <form name="form1" action={{route('storeLike')}} method="post">
            @csrf
            <input type="hidden" name="post_id" value='{{$post->id}}'>
            <input type="submit" name="submit" value="Like 👍">
        </form>
        <hr>
        <div class="sub-content">
            <h3><font color=#5599FF>Comments</font></h3><br>
            @foreach($post->comments as $comment)
                Author：{{$comment->user->name}}
                <br>Content：{{$comment->content}}
                <br>Time：{{$comment->created_at}}
                <hr>
            @endforeach
            <br><a href={{env('DOMAIN')}}showComments/{{$post->id}}>All comments</a>
        </div>
        <form name="form1" action="storeComment" method="post">
            @csrf
            <input type="hidden" name="post_id" value='{{$post->id}}'>
            <p><textarea style="font-family: \'Nunito\', sans-serif; font-size:20px; width:550px;height:100px;"
                         name="content"></textarea></p>
            <p><input type="submit" name="submit" value="SEND">
        </form>
        <link rel="stylesheet" href="{{ asset('css/button.css') }}">
        <hr>
    @endforeach
    <div class="bottom left position-abs content">
        There are {{$posts_number}} posts.
    </div>
</div>
</body>
</html>
