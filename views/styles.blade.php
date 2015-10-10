@foreach(config('fluentform.cdn.styles') as $name => $url)
    @if(config('fluentform.cdn.enabled.'.$name, false) == true)
    <link href="{{ $url }}" rel="stylesheet" type="text/css">
    @endif
@endforeach