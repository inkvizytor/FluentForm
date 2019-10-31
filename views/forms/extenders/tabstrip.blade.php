@php
    $control->attr('active', 'active');

    if ($control->getMode() == 'tabs:begin')
    {
        $control->addClass('tabs');

        $control->attr('tabs', ['data-tab' => '']);
        $control->attr('tab', ['class' => 'tab-title']);
        $control->attr('link', []);
        $control->attr('panels', ['class' => 'tabs-content']);
    }

    if ($control->getMode() == 'panel:begin')
    {
        $control->attr('panel', ['class' => 'content']);
    }
@endphp