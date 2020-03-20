<title>All Replies</title>
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
    @foreach ($replies as $reply)
        <br>Author：{{$reply->user->name}}
        <br>Content：{{$reply->content}}
        <br>Time：{{$reply->created_at}}
        <hr>
    @endforeach
    <div class="bottom left position-abs content">
        There are {{$replies_number}} replies.
    </div>
</div>
</body>
</html>
