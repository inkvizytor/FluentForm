@php
    $attributes = [
        'for' => $control->getName()
    ];

    if ($control->isSrOnly())
    {
        $class = trim($class.' sr-only');
    }

    if (!empty($class))
    {
        $attributes['class'] = $class;
    }

    $label = $control->getLabel();
@endphp

@if(!empty($label))
    <label{!! $renderer->attr($attributes) !!}>
        @if($renderer->isRequired($control))
            <var class="required">*</var>
        @endif
        {!! $label !!}
    </label>
@endif