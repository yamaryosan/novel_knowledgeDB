<table>
    <tbody>
        @if (count($files) === 0)
        <tr>
            <td>ファイルはありません</td>
        </tr>
        @else
            @foreach ($files as $file)
            <tr>
                <td>{{ $file['filename'] }}</td>
                <td>{{ $file['uploaded_at'] }}</td>
                <td>{{ $file['article_count'] }}個</td>
                <td>
                    <a href="/storage/public/export/{{ $file['filename'] }}" download="{{ $file['filename'] }}">
                        <img src="{{ asset('images/download.png') }}" alt="download">
                    </a>
                </td>
                <td>
                    <a href="{{ route('export_delete', ['filename' => $file['filename']]) }}">
                        <img src="{{ asset('images/trashbox.png') }}" alt="trashbox">
                    </a>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
