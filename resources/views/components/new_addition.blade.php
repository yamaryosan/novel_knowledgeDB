<!-- 雑学項目新規追加フォーム -->

<form action="{{ route('store') }}" method="POST">
    @csrf
    <input type="text" class="title_input" name="title">
    <input type="text" class="summary_input" name="summary">
    <input type="text" class="detail_input" name="detail">
    <input type="submit" value="追加">
</form>
