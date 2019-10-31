@component('forms.components.form-horizontal', ['group' => $group, 'renderer' => $renderer])
    @slot('label')
        @include('forms.partials.field-label', ['class' => 'inline right'])
    @endslot
    @slot('field')
        @component('forms.components.field-width', ['control' => $control])
            {!! $group->render() !!}
        @endcomponent
    @endslot
@endcomponent