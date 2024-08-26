@extends('layout.admin_layout')
@section('content_admin')
    <div class="contain">
        @if ($display == "comment.list")
        <div class="content">
            <table>
                <tr>
                    <th>ID người tạo</th>
                    <th>ID tin tức</th>
                    <th>Nội dung</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
                @foreach ($comments as $comment)
                <tr>
                    <td class="td"><a href="{{route('user.list', ['focus' => $comment->id_user])}}">{{$comment->id_user}}</a></td>
                    <td class="td"><a href="{{route('news.list', ['focus' => $comment->id_news])}}">{{$comment->id_news}}</a></td>
                    <td><textarea disabled>{{$comment->content}}</textarea></td>
                    <td class="td">{{$comment->created_at}}</td>
                    <td>
                        <div>
                            <button id_comment="{{$comment->id}}" class="reply_btn">Các BL Trả Lời</button>
                            <a onclick=" return confirm('Bạn có muốn xóa bình luận {{$comment->id}} không?');" href="{{route('admin_comment.delete',$comment->id)}}">Xóa</a>  
                        </div>
                    </td>
                </tr>
                    @foreach ($reply_comments as $reply_comment)
                        @if ($reply_comment->id_comment === $comment->id)
                            <tr id_comment="{{$reply_comment->id_comment}}" class="extra tr_reply_comment">
                                <td class="td"><a href="{{route('user.list', ['focus' => $reply_comment->id_user])}}">{{$reply_comment->id_user}}</a></td>
                                <td><textarea disabled>{{$reply_comment->content}}</textarea></td>
                                <td class="td">{{$reply_comment->created_at}}</td>
                                <td>
                                    <div>
                                        <a onclick=" return confirm('Bạn có muốn xóa bình luận {{$reply_comment->id}} không?');" href="{{route('admin_reply_comment.delete',$reply_comment->id)}}">Xóa</a>  
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
              
            </table>
        </div>
        @elseif ($display == "filter_comment.list")
        <div class="content">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nội dung</th>
                    <th>ID người tạo</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
                @foreach ($filter_comments as $filter_comment)
                    <tr>
                        <td class="td">{{$filter_comment->id}}</td>
                        <td><textarea disabled>{{$filter_comment->content}}</textarea></td>
                        <td class="td"><a href="{{route('user.list', ['focus' => $filter_comment->id_user])}}">{{$filter_comment->id_user}}</a></td>
                        <td class="td">{{$filter_comment->created_at}}</td>
                        <td>
                            <div>
                                <a href="{{route('filter_comment.update', $filter_comment->id)}}">Cập Nhật</a>
                                <a onclick=" return confirm('Bạn có muốn xóa lọc bình luận {{$filter_comment->id}} không?');" href="{{route('admin_filter_comment.delete',$filter_comment->id)}}">Xóa</a>  
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        @elseif($display == "filter_comment.create")
        <div class="content">
            <form action="{{route('filter_comment.create')}}" method="post" enctype="multipart/form-data"> 
                @csrf
                <h2>Thêm lọc bình luận</h2>
                <div class="form form-user">
                    <div>
                        <label for="">Nội dung</label>
                        <input type="text" name="filter_comment" value="{{old('filter_comment')}}">
                        @error('filter_comment')
                            <p class="error_text">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="">ID</label>
                        <input type="text" value="Tự động" disabled>
                    </div>
                </div>
                <button>Thêm</button>
            </form>
        </div>
        @else
        <div class="content">
            <form action="{{route('filter_comment.update',$filter_comment->id)}}" method="post" enctype="multipart/form-data"> 
                @csrf
                <h2>Cập nhật lọc bình luận</h2>
                <div class="form form-user">
                    <div>
                        <label for="">Nội dung</label>
                        <input type="text" name="filter_comment" value="{{$filter_comment->content}}">
                        @error('filter_comment')
                            <p class="error_text">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="">ID</label>
                        <input type="text" value="{{$filter_comment->id}}" disabled>
                    </div>
                    <div>
                        <label for="">Ngày tạo</label>
                        <input type="text" value="{{$filter_comment->created_at}}" disabled>
                    </div>
                </div>
                <button type="submit">Cập nhật</button>
            </form>
        </div>
        @endif
    </div>
   
@endsection