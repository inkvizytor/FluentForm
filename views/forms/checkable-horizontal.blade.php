@php
    $checkableCss = $control->getType() == 'checkbox' ? 'checkbox' : 'radio';
@endphp

@component('forms.components.form-horizontal', ['group' => $group, 'renderer' => $renderer])
    @slot('label')
        &nbsp;
    @endslot
    @slot('field')
        <div class="{!! $labelCss !!}">
            {!! $renderer->decorate($control) !!}
        </div>
        @include('forms.partials.error')
        @include('forms.partials.help')
    @endslot
@endcomponent