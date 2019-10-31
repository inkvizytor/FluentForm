@component('forms.components.form-standard', ['group' => $group])
    @include('forms.partials.group-label')
    {!! $group->render() !!}
@endcomponent