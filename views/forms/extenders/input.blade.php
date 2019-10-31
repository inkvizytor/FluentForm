@include('forms.extenders.field')
@php
    if ($control->getType() == 'file')
    {
        $control->removeClass('form-control');
        $control->addClass('filestyle');
        $control->data('icon', 'true');
        $control->data('buttonText', ' ');
    }
@endphp