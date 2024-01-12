<input type="button"
class="{{ $name }} {{ $image }} {{ $color }}"
@isset($data_name)
data-{{ $data_name }}="{{ $data_value }}"
@endisset
@isset($link) onClick="location.href='{{ $link }}'"
@endisset
>
