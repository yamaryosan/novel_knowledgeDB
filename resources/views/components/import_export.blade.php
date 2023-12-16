<!-- インポート・エクスポート用ボタン -->

<div class="import_export">
    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input class="import_file_part" type="file" name="file">
        <input class="import_btn" type="submit" value="インポート">
    </form>
    <form action="{{ route('export') }}" method="POST">
        @csrf
        <input class="export_btn" type="submit" value="エクスポート">
    </form>
</div>
