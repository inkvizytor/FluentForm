<div class="row collapse">
    <div class="columns small-10">{!! $control->render() !!}</div>
    <span class="columns small-2">
        <span class="postfix">
            <i class="fa fa-fw {!! ($control->withTimeOnly() ? 'fa-clock-o' : 'fa-calendar') !!}"></i>
        </span>
    </span>
</div>