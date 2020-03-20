<title>All Posts</title>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<body>
<div class="flex-center position-ref full-height">
    <div class="top-right home">
        @include('layouts.nav')
    </div>

</div>
<div class="note full-height">
    @csrf
    @foreach ($posts as $post)
    <br>Author：{{$post->user->name}}
    <br>Subject：{{$post->subject}}
    <br>Content：{{$post->content}}
    <br>Time：{{$post->created_at}}
    <form name="form1" action="storeLike" method="post">
        <input type="hidden" name="post_id" value='{{$post->id}}'>
        <input type="submit" name="submit" value="Like 👍">
    </form>

    <form name="form1" action="showComments" method="post">
        <input type="hidden" name="post_id" value='{{$post->id}}'>
        <input type="submit" name="submit" value="All comments">
    </form>

    <form name="form1" action="storeComment" method="post">
        <input type="hidden" name="post_id" value='{{$post->id}}'>
        <p><textarea style="font-family: \'Nunito\', sans-serif; font-size:20px; width:550px;height:100px;"
                     name="content"></textarea></p>
        <p><input type="submit" name="submit" value="SEND">
    </form>
    <link rel="stylesheet" href="{{ asset('css/button.css') }}">
    @endforeach
    <hr>
    <div class="bottom left position-abs content">
        There are {{$posts_number}} posts.
    </div>
</body>
</html>
