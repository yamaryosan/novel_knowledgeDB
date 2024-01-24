<div class="show_trivium_unit">
    <div class="show_item_title">
        <h2>{{ $trivium->title }}</h2>
    </div>
    <div class="show_item_summary">
        <p>{!! nl2br(e($trivium->summary)) !!}</p>
    </div>
    <div class="show_item_detail">
        <p>{!! nl2br(e($trivium->detail)) !!}</p>
    </div>
    <button onclick="history.back()" class="back_btn">戻る</button>
</div>
