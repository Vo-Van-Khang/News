@extends('layout.admin_layout')
@section('content_admin')
    <div class="contain">
        @if ($display == "user.list")
        <div class="content">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Hình ảnh</th>
                    <th>Vai trò</th>
                    <th>Hành động</th>
                </tr>
                @foreach ($users as $user)
                <tr @class(['focus' => $focus == $user->id])>
                    <td class="td">{{$user->id}}</td>
                    <td class="td">{{$user->name}}</td>
                    <td class="td">{{$user->email}}</td>
                    <td class="td"><img src="{{ asset('images/'. $user->image) }}" alt=""></td>
                    <td class="td">{{$user->role}}</td>
                    <td>
                        <div>
                            <a href="{{route('user.update', $user->id)}}">Cập Nhật</a>
                            @if ($user->role !== "admin")
                                <a onclick=" return confirm('Bạn có muốn xóa người dùng {{$user->name}} không?');" href="{{route('user.delete',$user->id)}}">Xóa</a>  
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
              
            </table>
        </div>
        @elseif($display == "user.create")
        <div class="content">
            <form action="{{route('user.create')}}" method="post" enctype="multipart/form-data"> 
                @csrf
                <h2>Thêm người dùng</h2>
                <div class="form form-user">
                    <div>
                        <label for="">Tên</label>
                        <input type="text" name="name" value="{{old('name')}}">
                        @error('name')
                            <p class="error_text">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="">Email</label>
                        <input type="text" name="email" value="{{old('email')}}">
                        @error('email')
                            <p class="error_text">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="">Mật khẩu</label>
                        <input type="password" name="password" value="{{old('password')}}">
                        @error('password')
                            <p class="error_text">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="">Ảnh</label>
                        <div class="image">
                            <input type="file" name="image" value="{{old('image')}}">
                        </div>
                        @error('image')
                            <p class="error_text">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="">Vai trò</label>
                        <div>
                            <p><input type="radio" name="role" value="staff"> Nhân viên</p>
                            <p><input type="radio" name="role" value="guest" checked> Khách hàng</p>
                        </div>
                    </div>
                </div>
                <button type="submit">Thêm</button>
            </form>
        </div>
        @else
        <div class="content">
            <form action="{{route('user.update', $user->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <h2>Cập nhật người dùng</h2>
                <div class="form form-user">
                    <div>
                        <label for="">Tên</label>
                        <input type="text" name="name" value="{{$user->name}}">
                        @error('name')
                            <p class="error_text">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="">Email</label>
                        <input type="text" name="email" value="{{$user->email}}" disabled>
                        @error('email')
                            <p class="error_text">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="">Ảnh</label>
                        <div class="image">
                            @if ($user->image != null)
                                <img src="{{ asset('images/'. $user->image) }}" alt="">
                            @endif
                            <input type="file" name="image" value="{{ url('images/'.$user->image) }}">
                        </div>
                        @error('image')
                            <p class="error_text">{{$message}}</p>
                        @enderror
                    </div>
                    @if ($user->role !== "admin")
                    <div>
                        <label for="">Vai trò</label>
                        <div>
                            <p><input type="radio" name="role" value="staff" @checked($user->role == "staff")> Nhân viên</p>
                            <p><input type="radio" name="role" value="guest" @checked($user->role == "guest")> Khách hàng</p>
                        </div>
                    </div>
                    @endif
                    <div>
                        <label for="">Được tạo vào</label>
                        <input type="text" disabled value="{{$user->created_at}}">
                    </div>
                </div>
                <button>Cập nhật</button>
            </form>
        </div>
        @endif
    </div>
   
@endsection