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
        if ($control->getType() == 'submit')
        {
            $control->addClass('primary');
        }
        else
        {
            $control->addClass('secondary');
        }
    }
@endphp