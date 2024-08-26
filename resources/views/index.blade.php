@extends('layout.layout')

@section('content')
<div class="content">
    <div class="news">
        <div class="title">
            <h2>Tin vắn cho bạn</h2>
            <p>Ngày {{date('d')}} Tháng {{date('m')}}</p>
        </div>
        <div class="news_content">
            @foreach ($news as $new)
            @php
                $author = $authors->firstWhere('id', $new->id_user);
            @endphp
            <a class="news_item" href="{{route('news',$new->id)}}">
                <div class="item">
                    <div class="texts">
                        <div class="top">
                            <h4>{{$author->name}}</h4>
                            <p>{{$new->title}}</p>
                        </div>
                        <span>{{$new->created_at}}</span>
                    </div>
                    <img src="{{ asset('images/'. $new->image) }}" alt="">
                </div>
            </a>
            @endforeach
            <div class="hr"></div>
        </div>
    </div>
    <div class="news">
        <div class="title">
            <h2>Có thể bạn sẽ quan tâm</h2>
            <p>Giải trí</p>
        </div>
        <div class="news_content">
                @foreach ($news as $new)
                @php
                    $author = $authors->firstWhere('id', $new->id_user);
                @endphp
                    @if ($new->category == $categories[3]->id)
                    <a class="news_care_item" href="{{route('news',$new->id)}}">
                        <div class="item">
                            <div class="texts">
                                <div class="top">
                                    <h4>{{$author->name}}</h4>
                                    <p>{{$new->title}}</p>
                                </div>
                                <span>{{$new->created_at}}</span>
                            </div>
                            <img src="{{ asset('images/'. $new->image) }}" alt="">
                        </div>
                    </a>
                    @endif
            @endforeach
            <div class="hr"></div>
        </div>
    </div>
    <div class="topic">
        <p>Chủ đề của bạn</p>
        <div class="content_topic">
           
                @foreach ($categories as $category)
                @if ($category->id == 1 || $category->id == 3)
                    <div class="items outstanding category_item" category="{{$category->id}}"> 
                @else
                    <div class="items category_item" category="{{$category->id}}">   
                @endif
                <a class="topic_name" href="{{route('category',$category->id)}}">{{$category->name}}<i class="fa-solid fa-chevron-right"></i></a>
                    @foreach ($news as $new)
                        @if ($new->category == $category->id)
                        <a class="news_category_item" category="{{$new->category}}" href="{{route('news',$new->id)}}">
                        <div class="item">
                            <div class="texts">
                                <p>{{$new->title}}</p>
                                <span>{{$new->created_at}}</span>
                            </div>
                            <img src="{{ asset('images/'. $new->image) }}" alt="">
                        </div>
                        </a>
                        @endif
                    @endforeach
                </div>
                @endforeach
                
        </div>
    </div>
</div>
@endsection