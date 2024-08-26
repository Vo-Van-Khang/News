<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
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
    <div class="admin">
        <div class="nav">
            <div class="item">
                <div class="name" style="padding: 0px 15px 10px;">
                    <p>Danh mục</p>
                    <i class="fa-solid fa-caret-right"></i>
                </div>
                <div class="list">
                    <a href="{{route('category.list')}}">
                        <div @class(['active' => $display == 'category.list'])>
                            <i class="fa-solid fa-list-check"></i>
                            <p>Quản lí</p>
                        </div>
                    </a>
                    <a href="{{route('category.create')}}">
                        <div @class(['active' => $display == 'category.create'])>
                            <i class="fa-solid fa-circle-plus"></i>
                            <p>Thêm mới</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="item">
                <div class="name" style="padding: 0px 15px 10px;">
                    <p>Tin tức</p>
                    <i class="fa-solid fa-caret-right"></i>
                </div>
                <div class="list">
                    <a href="{{route('news.list')}}">
                        <div @class(['active' => $display == 'news.list'])>
                            <i class="fa-solid fa-list-check"></i>
                            <p>Quản lí</p>
                        </div>
                    </a>
                    <a href="{{route('news.create')}}">
                        <div @class(['active' => $display == 'news.create'])>
                            <i class="fa-solid fa-circle-plus"></i>
                            <p>Thêm mới</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="item">
                <div class="name" style="padding: 0px 15px 10px;">
                    <p>Người dùng</p>
                    <i class="fa-solid fa-caret-right"></i>
                </div>
                <div class="list">
                    <a href="{{route('user.list')}}">
                        <div @class(['active' => $display == 'user.list'])>
                            <i class="fa-solid fa-list-check"></i>
                            <p>Quản lí</p>
                        </div>
                    </a>
                    <a href="{{route('user.create')}}">
                        <div @class(['active' => $display == 'user.create'])>
                            <i class="fa-solid fa-circle-plus"></i>
                            <p>Thêm mới</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="item">
                <div class="name" style="padding: 0px 15px 10px;">
                    <p>Bình luận</p>
                    <i class="fa-solid fa-caret-right"></i>
                </div>
                <div class="list">
                    <a href="{{route('comment.list')}}">
                        <div @class(['active' => $display == 'comment.list'])>
                            <i class="fa-solid fa-list-check"></i>
                            <p>Quản lí BL</p>
                        </div>
                    </a>
                    <a href="{{route('filter_comment.list')}}">
                        <div @class(['active' => $display == 'filter_comment.list'])>
                            <i class="fa-solid fa-filter filter_icon"></i>
                            <p>Quản lí lọc BL</p>
                        </div>
                    </a>
                    <a href="{{route('filter_comment.create')}}">
                        <div @class(['active' => $display == 'filter_comment.create'])>
                            <i class="fa-solid fa-circle-plus"></i>
                            <p>Thêm lọc BL</p>
                        </div>
                    </a>
                </div>
            </div>
            <a href="{{route('index')}}" class="item">
                <div class="name">
                    <p>Trở về</p>
                    <i class="fa-solid fa-house"></i>
                </div>                
            </a>
        </div>
        <div class="content">
            @yield('content_admin')
        </div>
    </div>
    {{-- Message --}}
    @include('shared.message')
    <script src="{{asset('js/main.js')}}"></script>
</body>
</html>