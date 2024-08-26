<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account</title>
    <link rel="stylesheet" href="{{asset('css/account.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dosis&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tilt+Neon&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Signika:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
        <!-- font-family: 'Oswald', sans-serif;-->
        <!-- font-family: 'Josefin Sans', sans-serif; -->
        <!-- font-family: 'Dosis', sans-serif; -->
        <!-- font-family: 'Pacifico', cursive; -->
        <!-- font-family: 'Tilt Neon', cursive; -->
        <!-- font-family: 'Signika', sans-serif; -->
</head>
<body>
    <div class="content">
        <div class="nav-account">
            <a href="{{route('index')}}">
                <div class="item">
                <i class="fa-solid fa-right-from-bracket"></i>
                    <p>Trở lại</p>
                </div>
            </a>
            <a href="{{route('account')}}">
                <div class="item {{ $navigation === 'information' ? 'active' : '' }}">
                    <i class="fa-regular fa-user"></i>
                    <p>Thông tin tài khoản</p>
                </div>
            </a>
            <a href="{{route('history')}}">
                <div class="item {{ $navigation === 'history' ? 'active' : '' }}">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <p>Lịch sử</p>
                </div>
            </a>
            <a onclick="return confirm('Bạn có muốn đăng xuất không?');" href="{{route('logout')}}">
                <div class="item">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <p>Đăng xuất</p>
                </div>
            </a>
        </div>
        <div class="display">
            @yield('content')
        </div>
    </div>
     {{-- Message --}}
     @include('shared.message')
    <script src="{{asset('js/main.js')}}"></script>
</body>
</html>