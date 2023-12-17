<!-- インポート用のフォーム -->

<div class="import">
    <form class="import_form" action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="drop_area">
            <div id="importFileIcon" role="button" tabindex="0">ファイルを選択</div>
            <input id="fileInput" class="import_file_part" type="file" name="file">
        </div>
        <input class="submit_btn" type="submit" value="アップロード">
    </form>
</div>
