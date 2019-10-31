@include('forms.extenders.field')
@php
    if (!empty($control->getLabel()) && empty($control->getPlaceholder()))
    {
        $control->placeholder($control->getLabel());
        $control->sronly(true);
    }
@endphp