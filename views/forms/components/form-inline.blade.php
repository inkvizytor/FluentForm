@php
    $groupCss = array_merge(['left', take($class)], $group->getCss());
@endphp

<div class="{!! implode(' ', $groupCss) !!}">
    {!! $slot !!}
</div>