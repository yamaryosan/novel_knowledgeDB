<!-- 成功時のメッセージ -->
@if (session('flash_succeed_message'))
    <div class="import_succeed_container">
        <div class="message">
            <img src="{{ asset('images/check_icon.png') }}" alt="succeed" class="import_succeed_img">
            <p>{{ session('flash_succeed_message') }}</p>
        </div>
    </div>
@endif
