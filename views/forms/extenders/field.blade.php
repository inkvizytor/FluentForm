@php
    if ($group != null && $renderer->hasErrors($control))
    {
        $group->addClass('has-error');
    }
@endphp