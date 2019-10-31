@php
    if ($control->getMode() == 'panel:begin')
    {
        if (!$control->hasClass('panel'))
        {
            $control->addClass('panel');
        }

        $control->attr('heading', ['class' => 'panel-heading']);
        $control->attr('body', ['class' => 'panel-body']);
    }

    if ($control->getMode() == 'panel:end')
    {
        $control->attr('footer', ['class' => 'panel-footer']);
    }
@endphp