@php
    $groupCss = array_merge(['left', $class], $group->getCss());
@endphp

<div class="{!! implode(' ', $groupCss) !!}">
    {!! $slot !!}
</div>