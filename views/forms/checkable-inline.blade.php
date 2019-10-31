@php
    $checkableCss = $control->getType() == 'checkbox' ? 'checkbox' : 'radio';
@endphp

@component('forms.components.form-inline', ['group' => $group, 'class' => $checkableCss])
    {!! $renderer->decorate($control) !!}
    @include('forms.partials.error')
    @include('forms.partials.help')
@endcomponent