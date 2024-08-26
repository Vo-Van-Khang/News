@extends('layout.admin_layout')
@section('content_admin')
    <div class="contain">
        @if ($display == "news.list")
        <div class="content">
            <table>
                <tr>
                    <th>ID Danh mục</th>
                    <th>Tiêu đề</th>
                    <th>Tác giả</th>
                    <th>Hình ảnh</th>
                    <th>ID người tạo</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
                @foreach ($news as $item)
                @php
                    $author = $authors->firstWhere('id', $item->id_user);
                @endphp
                <tr  @class(['focus' => $focus == $item->id])>
                    <td class="td"><a href="{{ route('category.list',['focus' => $item->category])}}">{{$item->category}}</a></td>
                    <td class="td">{{$item->title}}</td>
                    <td class="td">{{$author->name}}</td>
                    <td class="td"><img src="{{ asset('images/'. $item->image) }}" alt=""></td>
                    <td class="td"><a href="{{route('user.list', ['focus' => $item->id_user])}}">{{$item->id_user}}</a></td>
                    <td class="td">{{$item->created_at}}</td>
                    <td>
                        <div>
                            <a href="{{route('news.update', $item->id)}}">Cập Nhật</a>
                            <a onclick=" return confirm('Bạn có muốn xóa tin tức {{$item->id}} không?');" href="{{route('news.delete',$item->id)}}">Xóa</a>  
                        </div>
                    </td>
                </tr>
                @endforeach
              
            </table>
        </div>
        @elseif($display == "news.create")
        <div class="content">
            <form action="{{route('news.create')}}" method="post" enctype="multipart/form-data"> 
                @csrf
                <h2>Thêm tin tức</h2>
                <div class="form form-user">
                    <div>
                        <label for="">Tiêu đề</label>
                        <input type="text" name="title" value="{{old('title')}}">
                        @error('title')
                            <p class="error_text">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="">Danh mục</label>
                        <select name="category">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option> 
                        @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="">Từ khóa</label>
                        <input type="text" name="keywords" value="{{old('keywords')}}">
                        @error('keywords')
                            <p class="error_text">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="">Mô tả</label>
                        <textarea name="description" id="" cols="30" rows="10">{{old('description')}}</textarea>
                        @error('description')
                            <p class="error_text">{{$message}}</p>
                        @enderror
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
                <div>
                    <textarea id="ckeditor" name="content" cols="30" rows="10">{{old('content')}}</textarea>
                    @error('content')
                    <p class="error_text" style="text-align: center">{{$message}}</p>
                    @enderror
                </div>
                <button>Thêm</button>
            </form>
        </div>
        @else
        <div class="content">
            <form action="{{route('news.update',$news->id)}}" method="post" enctype="multipart/form-data"> 
                @csrf
                <h2>Cập nhật tin tức</h2>
                <div class="form form-user">
                    <div>
                        <label for="">Tiêu đề</label>
                        <input type="text" name="title" value="{{$news->title}}">
                        @error('title')
                            <p class="error_text">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="">Tác giả</label>
                        <input type="text" name="author" value="{{$author->name}}" disabled>
                    </div>
                    <div>
                        <label for="">Từ khóa</label>
                        <input type="text" name="keywords" value="{{$news->keywords}}">
                        @error('keywords')
                            <p class="error_text">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="">Danh mục</label>
                        <select name="category">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" @if ($news->category == $category->id) selected @endif>{{$category->name}}</option> 
                        @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="">Mô tả</label>
                        <textarea name="description" id="" cols="30" rows="10">{{$news->description}}</textarea>
                        @error('description')
                            <p class="error_text">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="">Hình ảnh</label>
                        <div class="image">
                            @if ($news->image != null)
                            <img src="{{ asset('images/'. $news->image) }}" alt="">
                            @endif
                            <input type="file" name="image" value="{{ url('images/'.$news->image) }}">
                        </div>
                        @error('image')
                            <p class="error_text">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <textarea id="ckeditor" name="content" cols="30" rows="10">{{$news->content}}</textarea>
                    @error('content')
                    <p class="error_text" style="text-align: center">{{$message}}</p>
                    @enderror
                </div>
                <button type="submit">Cập nhật</button>
            </form>
        </div>
        @endif
    </div>
   
@endsection