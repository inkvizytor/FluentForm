@php
    $buttonTypes = [
        'primary',
        'secondary',
        'success',
        'alert'
    ];

    if (!$control->hasClass('button'))
    {
        $control->addClass('button');
    }

    if (empty(array_intersect($control->getCss(), $buttonTypes)))
    {
        $control->addClass('secondary');
    }
@endphp