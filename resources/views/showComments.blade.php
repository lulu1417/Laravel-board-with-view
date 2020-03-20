<title>All Comments</title>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<body>
<div class="flex-center position-ref full-height">
    <div class="top-right home">
        @include('layouts.nav')
    </div>
    <div class="top-left home">
        BACK
    </div>

</div>
<div class="note full-height">
    @foreach ($comments as $comment)
        Author：{{$comment->user->name}}
        <br>Content：{{$comment->content}}
        <br>Time：{{$comment->created_at}}

        <form name="form1" action="showReplies" method="post">
            @csrf
            <input type="hidden" name="comment_id" value={{$comment->id}}>
            <input type="submit" name="submit" value="All Replies">
        </form>

        <form name="form1" action="storeReply" method="post">
            @csrf
            <input type="hidden" name="comment_id" value={{$comment->id}}>
            <p><textarea style="font-family: \'Nunito\', sans-serif; font-size:20px; width:550px;height:100px;"
                         name="content"></textarea></p>
            <p><input type="submit" name="submit" value="SEND">

        </form>
        <link rel="stylesheet" href="{{ asset('css/button.css') }}">
    @endforeach
    <div class="bottom left position-abs content">
        There are {{$comments_number}} comments.
    </div>
</div>
</body>
</html>
