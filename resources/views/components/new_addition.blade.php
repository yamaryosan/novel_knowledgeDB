<!-- 雑学項目新規追加フォーム -->

<form action="{{ route('store') }}" class="new_addition_form" method="POST">
    @csrf
    <p>タイトル</p>
    <input type="text" class="title_input" name="title" required>
    <p>概要</p>
    <input type="text" class="summary_input" name="summary" required>
    <p>詳細</p>
    <input type="text" class="detail_input" name="detail" required>
    <input type="submit" value="追加" class="submit_btn">
</form>
