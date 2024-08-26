@extends('layout.admin_layout')
@section('content_admin')
    <div class="contain">
        @if ($display == "category.list")
        <div class="content">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Mô tả</th>
                    <th>Hình ảnh</th>
                    <th>ID người tạo</th>
                    <th>Hành động</th>
                </tr>
                @foreach ($categories as $category)
                <tr @class(['focus' => $focus == $category->id])>
                    <td class="td">{{$category->id}}</td>
                    <td class="td">{{$category->name}}</td>
                    <td class="td">{{$category->description}}</td>
                    <td class="td"><img src="{{ asset('images/'. $category->image) }}" alt=""></td>
                    <td class="td"><a href="{{route('user.list', ['focus' => $category->id_user])}}">{{$category->id_user}}</a></td>
                    <td>
                        <div>
                            <a href="{{route('category.update', $category->id)}}">Cập Nhật</a>
                            @if (in_array($category->id, $items_FK))
                                <button disabled>Xóa</button>  
                            @else
                                <a onclick=" return confirm('Bạn có muốn xóa danh mục {{$category->name}} không?');" href="{{route('category.delete',$category->id)}}">Xóa</a>
                            @endif   
                        </div>
                    </td>
                </tr>
                @endforeach
              
            </table>
        </div>
        @elseif($display == "category.create")
        <div class="content">
            <form action="{{route('category.create')}}" method="post" enctype="multipart/form-data">
                @csrf
                <h2>Thêm danh mục</h2>
                <div class="form form-category">
                    <div>
                        <label for="">Tên</label>
                        <input type="text" name="name">
                        @error('name')
                            <p class="error_text">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="">Mô tả</label>
                        <input type="text" name="description">
                        @error('description')
                            <p class="error_text">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="">ID</label>
                        <input type="text" disabled value="Tự động">
                    </div>
                    <div>
                        <label for="">Hình ảnh</label>
                        <div class="image">
                            <input type="file" name="image" value="{{old('file')}}">
                        </div>
                        @error('image')
                            <p class="error_text">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <button>Thêm</button>
            </form>
        </div>
        @else
        <div class="content">
            <form action="{{route('category.update', $category->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <h2>Cập nhật danh mục</h2>
                <div class="form form-category">
                    <div>
                        <label for="">Tên</label>
                        <input type="text" name="name" value="{{$category->name}}">
                        @error('name')
                            <p class="error_text">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="">Mô tả</label>
                        <input type="text" name="description" value="{{$category->description}}">
                        @error('description')
                            <p class="error_text">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="">ID</label>
                        <input type="text" disabled value="{{$category->id}}">
                    </div>
                    <div>
                        <label for="">Hình ảnh</label>
                        <div class="image">
                            @if ($category->image != null)
                            <img src="{{ asset('images/'. $category->image) }}" alt="">
                            @endif
                            <input type="file" name="image" value="{{ url('images/'.$category->image) }}">
                        </div>
                        @error('image')
                            <p class="error_text">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <button>Cập nhật</button>
            </form>
        </div>
        @endif
    </div>

@endsection