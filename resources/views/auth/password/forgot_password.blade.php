<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="{{asset('css/sign_up&sign_in.css')}}">

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
   <form action="{{route('forgot')}}" method="post">
    @csrf
        <h1>Quên mật khẩu</h1>
        <div class="item">
            <label for="">Email</label>
            <div>
                <i class="fa-solid fa-user"></i>
                <input type="text" name="email" placeholder="Nhập email của bạn" value="{{old('email')}}">
            </div>
                @error('email')
                    <p class="error" style="color:red;">{{$message}}</p>
                @enderror
        </div>
        <button>Gửi</button>
        <p>Tự nhiên nhớ lại mật khẩu? <a href="{{route('login')}}">Đăng nhập ngay!</a></p>
   </form>
   @include('shared.message')
   <script src="{{asset('js/main.js')}}"></script>
</body>
</html>