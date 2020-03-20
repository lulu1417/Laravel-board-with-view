<title>Who also like this</title>
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
    @foreach ($likes as $like)
        <br>User：{{$like->user->name}}
        <br>Time：{{$like->created_at}}

        @if ($like->user->name == $user_name)
                <form name="form1" action={{route('dislike')}} method="post">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="like_id" value={{$like->id}}>
                    <input type="hidden" name="post_id" value={{$like->post->id}}>
                    <input type="submit" name="submit" value= "Retrive like 👎" >
                </form>
            <link rel="stylesheet" href="{{asset('css/button.css') }}">

        @endif
        <hr>
        @endforeach
        <div class="bottom left position-abs content">
            There are {{$likes_number}} likes.
        </div>

</div>
</body>
</html>
