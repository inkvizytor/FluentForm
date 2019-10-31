@php
    use inkvizytor\FluentForm\Controls\Button;
    use inkvizytor\FluentForm\Components\LinkButton;

    $size = 12;
    $prepend = $control->getPrepend();
    $append = $control->getAppend();
    $prependButton = false;
    $appendButton = false;

    if ($prepend !== null)
    {
        if ($prepend instanceof Button || $prepend instanceof LinkButton)
        {
            $prepend->addClass('prefix');
            $prependButton = true;
        }

        $size -= 2;
    }

    if ($append !== null)
    {
        $size -= 2;
        
        if ($append instanceof Button || $append instanceof LinkButton)
        {
            $append->addClass('postfix');
            $appendButton = true;
        }

        $size -= 2;
    }
@endphp

<div class="row collapse">
    @if($prepend != null)
    <div class="columns small-2">
        @if($prependButton)
            {!! $prepend !!}
        @else
            <span class="prefix">{!! $prepend !!}</span>
        @endif
    </div>
    @endif
    <div class="columns small-{{ $size }}">
        {!! $control->render() !!}
    </div>
    @if($append != null)
    <div class="columns small-2">
        @if($appendButton)
            {!! $append !!}
        @else
            <span class="postfix">{!! $append !!}</span>
        @endif
    </div>
    @endif
</div>