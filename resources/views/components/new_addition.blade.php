<!-- 雑学項目新規追加フォーム -->

<form action="{{ route('new_addition') }}" method="POST">
    @csrf
    <input type="text" class="title_input">
    <input type="text" class="summary_input">
    <input type="text" class="detail_input">
    <input type="submit" value="追加">
</form>
