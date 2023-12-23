<!-- インポートエラー時のメッセージ -->

@if (session('flash_message'))
    <div class="import_error_container">
        <div class="message">
            <img src="{{ asset('images/failure_icon.png') }}" alt="error" class="import_error_img">
            <p>{{ session('flash_message') }}</p>
        </div>
    </div>
@endif