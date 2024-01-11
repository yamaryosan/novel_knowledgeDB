<input type="button"
class="{{ $name }} {{ $image }} {{ $color }}"
@isset($link) onClick="location.href='{{ $link }}'"
@endisset
>
