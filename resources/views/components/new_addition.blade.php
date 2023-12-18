<!-- 雑学項目新規追加フォーム -->

<form action="{{ route('store') }}" class="new_addition_form" method="POST">
    @csrf
    <input type="text" class="title_input" name="title" required>
    <input type="text" class="summary_input" name="summary" required>
    <input type="text" class="detail_input" name="detail" required>
    <input type="submit" value="追加">
</form>
