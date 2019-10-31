@php
    $css = [];

    foreach ($control->getWidth() as $key => $size)
    {
        if ($size != null)
        {
            switch ($key)
            {
                case 'lg':
                    $css['large'] = "large-$size";
                    break;
                case 'md':
                    $css['medium'] = "medium-$size";
                    break;
                default:
                    $css['small'] = "small-$size";
            }
        }
    }
@endphp

@if(!empty($css))
    <div class="row">
        <div class="column {!! implode(' ', $css) !!}">
            {!! $slot !!}
        </div>
    </div>
@else
    {!! $slot !!}
@endif