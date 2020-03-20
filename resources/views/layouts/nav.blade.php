<a href={{route('board')}}>All Posts</a>
@if(session('user_id'))
    <a href={{route('addPost')}}>Add post</a>
@endif
<a href={{route('index')}}>leave</a>
