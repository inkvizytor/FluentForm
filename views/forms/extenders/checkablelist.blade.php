@php
    if ($control->isInline())
        $control->addClass('inline-list');
    else
        $control->addClass('no-bullet');

    $control->addClass($control->getType());
@endphp