<title>All Comments</title>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<body>
<div class="flex-center position-ref full-height">
    <div class="top-right home">
        @include('layouts.nav')
    </div>
    <div class="top-left home">
        <a href={{route('board')}}>back</a>
    </div>

</div>
<div class="note full-height">
    <h2><font color=#5599FF>Comments</font></h2>
    @foreach ($comments as $comment)
        <div style="border-width:1px;border-style:double;border-color:#CCDDFF;padding:50px;">
        <br>Author：{{$comment->user->name}}
        <br>Content：{{$comment->content}}
        <br>Time：{{$comment->created_at}}
        @if($comment->replies_count> 0)
            <hr>
            <div class="sub-content">
                <div style="border-width:1px;border-style:double;border-color:#CCDDFF;padding:50px;">
                <h3><font color=#5599FF> Replies</font></h3>
                <hr>

                @foreach($comment->replies as $reply)
                    Author：{{$reply->user->name}}<br>
                    Content：{{$reply->content}}<br>
                    Time：{{$reply->created_at}}
                    <hr>
                @endforeach
                <a href={{env('DOMAIN')}}/showReplies/{{$comment->id}}>All Replies</a>
                </div>
            </div>

        @endif
        <br><h3><font color=#5599FF>Reply This Comment</font></h3>
        <form name="form1" action="{{route('storeReply')}}" method="post">
            @csrf
            <input type="hidden" name="comment_id" value={{$comment->id}}>
            <p><textarea style="font-family: \'Nunito\', sans-serif; font-size:20px; width:550px;height:100px;"
                         name="content"></textarea></p>
            <p><input type="submit" name="submit" value="SEND">

        </form>
        <link rel="stylesheet" href="{{ asset('css/button.css') }}">

        </div>
        <br>
    @endforeach
    <div class="bottom left position-abs content">
        There are {{$comments_number}} comments.
    </div>
</div>
</body>
</html>
