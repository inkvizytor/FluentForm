@php
    $checkableCss = $control->getType() == 'checkbox' ? 'checkbox' : 'radio';
@endphp

@component('forms.components.form-standard', ['group' => $group, 'class' => $checkableCss])
    {!! $renderer->decorate($control) !!}
    @include('forms.partials.error')
    @include('forms.partials.help')
@endcomponent