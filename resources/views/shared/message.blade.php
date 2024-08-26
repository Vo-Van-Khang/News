@if (session()->has('success'))
    <div class="message_box success">
        {{ session('success') }}
        <i class="fa-solid fa-circle-minus hide_message"></i>
    </div>
@elseif(session()->has('error'))
    <div class="message_box error">
        {{ session('error') }}
        <i class="fa-solid fa-circle-minus hide_message"></i>
    </div>
@endif

