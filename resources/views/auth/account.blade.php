@extends('layout.account_layout')
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
    @csrf
    <img src="{{asset('images/account_background.jpg')}}" alt="">
                <div class="detail">
                    <div class="image">
                        <img src="{{asset('images/'.Auth::user()->image)}}" alt="">
                        <i class="fa-solid fa-camera" id="upload_image"></i>
                        <p id="status_image" @error('image') style="color: #db0000" @enderror>@error('image'){{$message}}@enderror</p>
                        <input type="file" name="image" id="input_image">
                    </div>
                    <div class="info">
                        <div>
                            <p>Email</p>
                            <input type="text" disabled value="{{Auth::user()->email}}">
                        </div>
                        <div>
                            <p>Tên</p>
                            <input type="text" name="name" value="{{Auth::user()->name}}">
                            @error('name')
                                <p style="color: #db0000">{{$message}}</p> 
                            @enderror
                        </div>
                        <div>
                            <p>Vai trò</p>
                            <input type="text" disabled value="{{Auth::user()->role}}">
                        </div>
                    </div>
                    <button class="btn_update">Lưu thay đổi</button>
                </div>
            </div>
    </form>
@endsection