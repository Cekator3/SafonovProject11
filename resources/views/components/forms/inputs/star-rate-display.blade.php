{{-- Star rating display field --}}

@props(['value' => null])

<meter class="star-rate display" style="--value: calc({{$value}} / 5 * 100%);" min="0" max="5" title="{{ $value }}/5" value="{{ $value }}"></meter>
