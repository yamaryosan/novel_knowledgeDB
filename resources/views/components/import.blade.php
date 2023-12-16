<!-- インポート用のフォーム -->

<div class="import_export">
    <form class="import" action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input class="import_file_part" type="file" name="file">
        <input class="import_btn" type="submit" value="インポート">
    </form>
</div>
