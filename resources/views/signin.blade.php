<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sign In</title>
</head>

<body>
<div class="flex-center position-ref full-height">
    <div class="top-right home">
        <a href='board'>All Posts</a>
        <a href='/'>Sign up</a>
    </div>

    <div class="content">
        <div class="m-b-md">
            <form name="login" action="login" method="post">
                @csrf
                <p>Username : <input type=text name="name"></p>
                <p>Password : <input type=password name="password"></p>
                <p><input type="submit" name="submit" value="Sign In">
                    <link rel="stylesheet" href="{{ asset('css/button.css') }}">
                {{--                @include('layouts.buttonStyle')--}}
            </form>
        </div>
        @if(isset($status) && $status == 'failed')
            <div class="warning">Wrong username or password！</div>
        @endif
    </div>
</div>
</body>
</html>
