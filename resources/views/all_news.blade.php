@extends('layout.layout')

@section('content')
<div class="all">
<div class="all_content">
    <div class="title">
        <h1>Các tin tức</h1>
        <button class="filter_btn">Bộ Lọc <i class="fa-solid fa-filter filter_icon"></i></button>
        <form class="filter_form" action="{{route('all')}}" method="post">
            @csrf
            <div class="filter_content">
                <div class="item">
                    <label for="">Loại</label>
                    @foreach ($categories as $category)
                        
                    <div>
                        <input type="checkbox" name="category[]" value="{{$category->id}}" @if (in_array($category->id,$filterCategories)) checked @endif>
                        <p>{{$category->name}}</p>
                    </div>
                    @endforeach
                </div>
                <div class="item">
                    <label for="">Ngày tạo</label>
                    <div>
                        <input type="radio" name="date[]" value="today" @if (in_array("today",$filterDates)) checked @endif>
                        <p>Hôm nay</p>
                    </div>
                    <div>
                        <input type="radio" name="date[]" value="this_week" @if (in_array("this_week",$filterDates)) checked @endif>
                        <p>Tuần này</p>
                    </div>
                    <div>
                        <input type="radio" name="date[]" value="this_month" @if (in_array("this_month",$filterDates)) checked @endif>
                        <p>Tháng này</p>
                    </div>
                    <div>
                        <input type="radio" name="date[]" value="this_year" @if ($checked) checked @endif @if (in_array("this_year",$filterDates)) checked @endif>
                        <p>Năm này</p>
                    </div>
                </div>
                <div class="item">
                    <label for="">Tác giả</label>
                    @foreach ($authors as $author)
                    <div>
                        <input type="checkbox" name="author[]" value="{{$author->id}}" @if (in_array($author->id,$filterAuthors)) checked @endif>
                        <p>{{$author->name}}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            <button>Lưu</button>
        </form>
    </div>
    @if (count($news) > 0)
    <div class="items">

        @foreach ($news as $item)
            @php
                $author = $authors->firstWhere('id', $item->id_user);
            @endphp
            <a href="{{route('news',$item->id)}}"><div class="item">
                <div class="text">
                    <h4>{{$author->name}}</h4>
                    <p>{{$item->title}}</p>
                    <span>{{$item->created_at}}</span>
                </div>
                <img src="{{ asset('images/'. $item->image) }}" alt="">
            </div></a>
        @endforeach
    </div>
    @else
    <p style="text-align: center;font-size:18px">Không tìm thấy!</p>       
    @endif
</div>
</div>
@endsection