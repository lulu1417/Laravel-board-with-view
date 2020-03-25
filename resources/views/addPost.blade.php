<title>Add Post</title>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<body>
<div class="flex-center position-ref full-height">
    <div class="top-right home">
        @include('layouts.nav')
    </div>
    <div class="top-left home">
        <a href={{route('board')}}>back</a>
    </div>
    <div class="content">
        <div class="m-b-md">
            <form name="form1" action="storePost" method="post">
                @csrf
                <p><strong>Hi {{$user}}</strong> ʕ•ᴥ•ʔ</p>
                <p>SUBJECT</p>
                <p><input type="text" name="subject"></p>
                <p>CONTENT</p>
                <p><textarea style="font-family: 'Nunito', sans-serif; font-size:20px; width:550px;height:100px;"
                             name="content"></textarea></p>
                <p><input type="submit" name="submit" value="SEND">
                    <link rel="stylesheet" href="{{ asset('css/button.css') }}">
            </form>
        </div>
    </div>
</div>
</body>
</html>
