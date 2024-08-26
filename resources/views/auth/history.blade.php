@extends('layout.account_layout')
@section('content')
    <table>
        <form action="{{route('history.delete_all')}}" method="post">
        @csrf
            <tr>
                <th>Tiêu đề</th>
                <th>Ảnh</th>
                <th>Ngày xem</th>
                <th>Hành động</th>
                <th>Tất cả <input class="all_checkbox_history" type="checkbox"></th>
            </tr>
            @if (count($histories) > 0)
            @foreach ($histories as $history)
            <tr>
                <td class="td">{{$history->title}}</td>
                <td><img src="{{asset('images/'.$history->image)}}" alt=""></td>
                <td class="td">{{$history->created_at}}</td>
                <td><a href="{{route('news',$history->id_news)}}">Đọc lại</a> <a onclick="return confirm('Bạn có muốn xóa lịch sử này không?')" href="{{route('history.delete',$history->id)}}"><i class="fa-regular fa-trash-can"></i></a></td>
                <td><input class="checkbox_history" type="checkbox" name="id[]" value="{{$history->id}}"></td>
            </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><button onclick="return confirm('Bạn có muốn xóa những lịch sử này không?')"><i class="fa-regular fa-trash-can"></i>Xoá các mục đã chọn</button></td>
            </tr>
            @else
                <p class="null">Không có lịch sử!</p>
            @endif
        </form>
    </table>
@endsection