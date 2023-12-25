<!-- エラー時のメッセージ -->

@if (session('flash_error_message'))
    <div class="error_container">
        <div class="message">
            <img src="{{ asset('images/failure_icon.png') }}" alt="error" class="error_img">
            <p>{{ session('flash_error_message') }}</p>
        </div>
    </div>
@endif
