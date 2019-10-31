@php
    $attributes = [];

    if ($group->isSrOnly())
    {
        $class = trim($class.' sr-only');
    }

    if (!empty($class))
    {
        $attributes['class'] = $class;
    }

    $label = $group->getLabel();
@endphp

@if(!empty($label))
    <label{!! $renderer->attr($attributes) !!}>
        @if($group->isRequired())
            <var class="required">*</var>
        @endif
        {!! $label !!}
    </label>
@endif