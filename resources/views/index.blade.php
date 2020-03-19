<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sign up</title>
</head>

<body>
<div class="flex-center position-ref full-height">
    <div class="top-right home">
        <a href='board'>All Posts</a>
        <a href='signin'>Sign in</a>
    </div>

    <div class="content">
        <div class="m-b-md">
            <form name="signup" action="user" method="post">
                @csrf
                <p>Username : <input type=text name="name"></p>
                <p>Password : <input type=password name="password"></p>
                <p><input type="submit" name="submit" value="Sign Up">
                    <link rel="stylesheet" href="{{ asset('css/button.css') }}">
            </form>
        </div>
        @if(isset($status) && $status == 'invalid_input')
            <div class="warning">Incomplete input, or the username has already been used ！</div>
        @endif
    </div>
</div>
</body>
</html>
