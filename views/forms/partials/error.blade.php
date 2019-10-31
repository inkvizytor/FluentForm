@php
    use Illuminate\Support\Str;
    
    foreach ($renderer->getErrorMessages($control->getKey()) as $message)
    {
        $name = str_replace('_', ' ', Str::snake($control->getKey()));
        $label = $control->getLabel() ? $control->getLabel() : $control->getPlaceholder();
        $message = str_replace($name, $label, $message);
        break;
    }
@endphp

@if(!empty($message))
    <small class="error">{{ $message }}</small>
@endif