@component('forms.components.form-standard', ['group' => $group])
    @include('forms.partials.field-label')
    @component('forms.components.field-width', ['control' => $control])
        {!! $renderer->decorate($control) !!}
    @endcomponent
    @include('forms.partials.error')
    @include('forms.partials.help')
@endcomponent