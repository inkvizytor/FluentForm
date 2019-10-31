@php
    if ($control->isDisabled() || $control->isReadonly())
    {
        if ($group != null)
        {
            $group->addClass('disabled');
        }
    }
@endphp