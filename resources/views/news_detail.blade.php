@extends('layout.layout')

@section('content')
<div class="news_detail">
    <div class="content_news">
        <div class="title">
            <h1>{{$news->title}}</h1>
            <div class="info">
                <p>{{$author->name}}</p>
                <span>Ngày tạo: {{$news->created_at}}</span>
            </div>
        </div>
        <div class="content">
            <p>{!!$news->content!!}</p>
        </div>
        <div class="comments">
            <div class="filter" style="display: none">
                @foreach ($filter_comments as $filter_comment)
                    <input class="filter_comment_input" type="text" value="{{$filter_comment->content}}" hidden>
                @endforeach
            </div>
            <div class="comment_content">
                @foreach ($comments as $comment)
                    @php
                        $user = $users->firstWhere('id', $comment->id_user);
                    @endphp
                    <div class="item"> 
                        <div class="comment">
                            <div class="image">@if ($user) <img src="{{ asset('/images/' . $user->image) }}" alt=""> @endif
                            </div>
                            <div>
                                <h3>@if ($user) {{ $user->name }} @endif @if ($user->role === "admin") (Admin) @elseif($user->role === "staff") (Nhân viên) @endif</h3>
                                <p class="comment_content_item">{{ $comment->content }}</p>
                                <span class="reply_comment_btn" id_comment="{{ $comment->id }}" name_reply="{{ $user->name }}">Trả lời</span>
                            </div>
                            @if (Auth::check() && $comment->id_user == Auth::user()->id)
                                <a class="scroll_postion" onclick="return confirm('Bạn có muốn xóa bình luận này không?')" href="{{ route('comment.delete', [$news->id, $comment->id]) }}"><i class="fa-solid fa-minus"></i></a>
                            @endif
                        </div>
            
                        @foreach ($reply_comments as $reply_comment)
                            @if ($reply_comment->id_comment == $comment->id)
                                @php
                                    $reply_user = $users->firstWhere('id', $reply_comment->id_user);
                                @endphp
                                <div class="reply_comment">
                                    <div class="image">@if ($reply_user) <img src="{{ asset('/images/' . $reply_user->image) }}" alt=""> @endif
                                    </div>
                                    <div>
                                        <h3>@if ($reply_user) {{ $reply_user->name }} @endif @if ($reply_user->role === "admin") (Admin) @elseif($reply_user->role === "staff") (Nhân viên) @endif</h3>
                                        <div class="reply_comment_content">
                                            <strong>{{ $reply_comment->name_reply }}</strong>
                                            <p class="comment_content_item">{{ $reply_comment->content }}</p>
                                        </div>
                                        <span class="reply_comment_btn" id_comment="{{ $comment->id }}" name_reply="{{ $reply_user->name }}">Trả lời</span>
                                    </div>
                                    @if (Auth::check() && $reply_comment->id_user == Auth::user()->id)
                                        <a class="scroll_postion" onclick="return confirm('Bạn có muốn xóa bình luận này không?')" href="{{ route('comment.reply_delete', [$news->id, $reply_comment->id]) }}"><i class="fa-solid fa-minus"></i></a>
                                    @endif
                                </div>   
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>            
            @if (Auth::check())
            <div class="form">
                @error('comment')
                    <p style="color:#ee0000;text-align:center;margin-bottom:5px;">{{$message}}</p>
                @enderror
                <form action="{{route('comment',$news->id)}}" method="post" class="comment_form_js" id="comment_form">
                    @csrf
                    <input type="text" name="comment" autocomplete="off" placeholder="Nhập bình luận của bạn">
                    <button class="scroll_postion"><i class="fa-solid fa-caret-right"></i></button>
                </form>
                <form action="{{route('reply_comment',$news->id)}}" method="post" class="comment_form_js" id="reply_comment_form">
                    @csrf
                    <div>
                        <div><p id="name_reply">name</p><i id="close_reply_comment_form" class="fa-regular fa-circle-xmark"></i></div>
                        <input id="input_focus" type="text" name="comment" autocomplete="off" placeholder="Nhập bình luận của bạn">
                    </div>
                    <input type="text" name="id_comment" id="input_reply_comment" value="" hidden>
                    <input type="text" name="name_reply" id="input_name_reply" value="" hidden>
                    <button class="scroll_postion"><i class="fa-solid fa-caret-right"></i></button>
                </form>
            </div>
            @else
                <a class="login" href="{{route('login')}}">
                    Đăng nhập để gửi bình luận
                </a>
            @endif
        </div>
    </div>
    <div class="propose_news">
        <div class="items">
            <p>Nhiều hơn</p>
            @foreach ($news_category as $new_category)
                @if ($new_category->id != $news->id)   
                    <a href="{{route('news',$new_category->id)}}"><div class="item">
                        <img src="{{ asset('images/'. $new_category->image) }}" alt="">
                        <p class="title_limit">{{$new_category->title}}</p>
                    </div></a>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection