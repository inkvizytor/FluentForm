<!DOCTYPE html>
<html>
<head>
    <title>Fluent Form Preview</title>
    {!! Fluent::styles() !!}
    <style type="text/css">
        body {
            padding: 20px 0 20px 0;
        }
    </style>
</head>
<body>
<div class="{{ config('fluentform.cdn.enabled.bootstrap') ? 'container' : 'row' }}">
    <div class="{{ config('fluentform.cdn.enabled.bootstrap') ? 'content' : 'large-12 columns' }}">
        <h1>Fluent Form Preview</h1>
        {!! Fluent::tabs()
            ->add('horizontal', 'Horizontal form') 
            ->add('standard', 'Standard form') 
            ->add('inline', 'Inline form')
            ->add('components', 'Components')
            ->active('horizontal')
            ->open()
        !!}
        
        {!! Fluent::tabs()->panel('horizontal') !!}
            <h2>Horizontal form</h2>
            {!! Form::horizontal(['select' => 2], 'horizontal')->errors($errors)->rules(['text' => 'required'])->display() !!}
            {{--
            @include('fluentform::controls', ['form' => 'horizontal'])
            --}}
            {!! Form::close() !!}
        {!! Fluent::tabs()->end() !!}

        {!! Fluent::tabs()->panel('standard') !!}
            <h2>Standard form</h2>
            {!! Form::standard(['text' => 'some text...', 'select' => 2], 'standard')->errors($errors)->rules(['text' => 'required'])->method("put") !!}
            {{--
            @include('fluentform::controls', ['form' => 'standard'])
            --}}
            {!! Form::close() !!}
        {!! Fluent::tabs()->end() !!}
        
        {!! Fluent::tabs()->panel('inline') !!}
            <h2>Inline form</h2>
            {!! Form::inline(['select' => 2], 'inline')->errors($errors)->rules(['text' => 'required']) !!}
            {{--
            @include('fluentform::controls', ['form' => 'inline'])
            --}}
            {!! Form::close() !!}
        {!! Fluent::tabs()->end() !!}

        {!! Fluent::tabs()->panel('components') !!}
            <br>
            {!! Fluent::panel()->open('Panel title')->css(['panel-primary']) !!}
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Suspendisse cursus diam nec auctor lacinia. Nam hendrerit 
                risus at condimentum egestas. Donec aliquam, velit at molestie 
                finibus, metus dui condimentum odio, sit amet dignissim tellus 
                dolor sed nisi. Proin consequat leo in lorem sollicitudin, vel 
                aliquam lorem ullamcorper. In hac habitasse platea dictumst. 
                Nullam aliquet justo ac justo aliquet, eu dignissim nulla pharetra. 
                Fusce mollis lacus ut varius blandit. Nulla eget lorem in metus 
                lacinia imperdiet. Maecenas a imperdiet orci, a laoreet dolor. 
                Quisque id scelerisque turpis, a facilisis justo. Vestibulum pulvinar 
                lacus vitae ornare vehicula. Quisque dignissim, risus eu egestas 
                fringilla, magna massa suscipit ipsum, pretium varius enim mi 
                eget magna. Mauris aliquet turpis a tempor pellentesque.
            {!! Fluent::panel()->close([
                //Form::submit('save', 'Save'),
                //Form::button('disabled', 'Disabled')->disabled(),
            ]) !!}
            {!! Fluent::panel()->open('Panel title')->css(['panel-success']) !!}
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Suspendisse cursus diam nec auctor lacinia. Nam hendrerit
                risus at condimentum egestas. Donec aliquam, velit at molestie
                finibus, metus dui condimentum odio, sit amet dignissim tellus
                dolor sed nisi. Proin consequat leo in lorem sollicitudin, vel
                aliquam lorem ullamcorper. In hac habitasse platea dictumst.
                Nullam aliquet justo ac justo aliquet, eu dignissim nulla pharetra.
                Fusce mollis lacus ut varius blandit. Nulla eget lorem in metus
                lacinia imperdiet. Maecenas a imperdiet orci, a laoreet dolor.
                Quisque id scelerisque turpis, a facilisis justo. Vestibulum pulvinar
                lacus vitae ornare vehicula. Quisque dignissim, risus eu egestas
                fringilla, magna massa suscipit ipsum, pretium varius enim mi
                eget magna. Mauris aliquet turpis a tempor pellentesque.
            {!! Fluent::panel()->close() !!}
        {!! Fluent::tabs()->end() !!}
        
        {!! Fluent::tabs()->close() !!}
        
    </div>
</div>
{!! Fluent::scripts() !!}
</body>
</html>
