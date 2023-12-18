<!-- 雑学項目新規追加フォーム -->

<form action="{{ route('store') }}" class="new_addition_form" method="POST">
    @csrf
    <p>タイトル</p>
    <input type="text" class="title_input" name="title" required>
    <p>概要</p>
    <textarea class="summary_input" name="summary" cols="20" rows="5"></textarea>
    <p>詳細</p>
    <textarea class="detail_input" name="detail" cols="20" rows="5"></textarea>
    <input type="submit" value="追加" class="submit_btn">
</form>
