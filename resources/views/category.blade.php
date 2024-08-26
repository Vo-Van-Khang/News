@extends('layout.layout')

@section('content')
<div class="category">
    <div class="title">
        <img src="{{ asset('images/'. $name->image) }}" alt="">
        <p>{{ $name->name }}</p>
    </div>
    <div class="list_items">
        @foreach ($stacks as $stack)
        <div class="items">
            @foreach ($stack as $index => $item)
            @php
                $author = $authors->firstWhere('id', $item->id_user);
            @endphp
                @if (($index + 1) % 4 == 0) 
                <div class="item_outstanding">
                    <a href="{{ route('news', $item->id) }}">
                        <img src="{{ asset('images/'. $item->image) }}" alt="{{ $item->title }}">
                        <p>{{ $item->title }}</p>
                        <span>{{ $item->created_at }}</span>
                    </a>
                </div>
                @else
                <a href="{{ route('news', $item->id) }}">
                    <div class="item">
                        <h3>{{ $author->name }}</h3>
                        <p>{{ $item->title }}</p>
                        <span>{{ $item->created_at }}</span>
                    </div>
                </a>
                @endif
            @endforeach
        </div>
        @endforeach
    </div>
</div>
@endsection
