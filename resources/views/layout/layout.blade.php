<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Google Tin tức</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

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
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
        <!-- font-family: 'Oswald', sans-serif;-->
        <!-- font-family: 'Josefin Sans', sans-serif; -->
        <!-- font-family: 'Dosis', sans-serif; -->
        <!-- font-family: 'Pacifico', cursive; -->
        <!-- font-family: 'Tilt Neon', cursive; -->
        <!-- font-family: 'Signika', sans-serif; -->
</head>
<body>
    <div class="sticky">
        <nav>
            <div class="logo">
                <a href="{{route('index')}}"><img src="{{asset('images/logo.png')}}" alt=""></a>
            </div>
            <div class="search">
                <form action="{{route('search')}}" method="get">
                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                    <input type="text" placeholder="Tìm kiếm chủ đề, vị trí và nguồn" name="content" @isset ($value_search) value="{{$value_search}}" @endisset>
                </form>
            </div>
            <div class="account">
                @guest
                    <a href="{{route('login')}}"><button>Đăng nhập</button></a>
                @endguest
                @auth
                    <div>
                        @if (Auth::user()->role == "admin" || Auth::user()->role == "staff")
                            <a href="{{route('category.list')}}" class="admin">Quản trị</a>
                        @endif
                        <a href="{{route('account')}}" class="image"><img src="{{ asset('images/'. Auth::user()->image) }}" alt=""></a>
                    </div>
                @endauth
            </div>
        </nav>
        <div class="list_category">
            <ul>
                <a href="{{route('about')}}"><li @class(['selected' => $navigational == 'about'])>Giới thiệu</li></a>
                <a href="{{route('index')}}"><li @class(['selected' => $navigational == 'index'])>Trang chủ</li></a>
                <a href="{{route('all')}}" @class(['selected' => $navigational == 'all'])><li>Tất cả</li></a>
                @foreach ($categories as $category)
                    <a href="{{route('category',$category->id)}}"><li @class(['selected' => $navigational == $category->id])>{{$category->name}}</li></a>
                @endforeach
            </ul>
        </div>
    </div>
    @yield('content')
    {{-- Message --}}
    <footer>
        <div>
            <div>
                <img src="{{asset('images/logo.png')}}" alt="">
                <p>Cảm ơn bạn đã lựa chọn chúng tôi</p>
            </div>
            <div>Hân hạnh được phục vụ bạn!</div>
        </div>
        <p>Copyright © 2023 Google News | Được phát triển bởi Google News Development Team</p>
    </footer>
    @include('shared.message')
    <script src="{{asset('js/main.js')}}"></script>
</body>
</html>