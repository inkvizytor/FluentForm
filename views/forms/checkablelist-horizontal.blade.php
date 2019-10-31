@component('forms.components.form-horizontal', ['group' => $group, 'renderer' => $renderer])
    @slot('label')
        @include('forms.partials.field-label', ['class' => 'inline right'])
    @endslot
    @slot('field')
        {!! $renderer->decorate($control) !!}
        @include('forms.partials.error')
        @include('forms.partials.help')
    @endslot
@endcomponent