@php
    $groupCss = array_merge(['row', take($class)], $group->getCss());
    $labelCss = [
        'column',
        'large-'.($group->getLabelSize('lg') ?: $renderer->getLabelSize('lg')),
        'medium-'.($group->getLabelSize('md') ?: $renderer->getLabelSize('md')),
        'small-'.($group->getLabelSize('sm') ?: $renderer->getLabelSize('sm'))
    ];
    $fieldCss = [
        'column',
        'large-'.($group->getFieldSize('lg') ?: $renderer->getFieldSize('lg')),
        'medium-'.($group->getFieldSize('md') ?: $renderer->getFieldSize('md')),
        'small-'.($group->getFieldSize('sm') ?: $renderer->getFieldSize('sm'))
    ];
@endphp

<div class="{!! implode(' ', $groupCss) !!}">
    <div class="{!! implode(' ', $labelCss) !!}">
        {!! $label !!}
    </div>
    <div class="{!! implode(' ', $fieldCss) !!}">
        {!! $field !!}
    </div>
</div>