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
<div class="container">
    <div class="content">
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
            {!! Form::horizontal(['select' => 2], 'horizontal')->errors($errors)->rules(['text' => 'required']) !!}
            @include('fluentform::controls', ['form' => 'horizontal'])
            {!! Form::close() !!}
        {!! Fluent::tabs()->end() !!}

        {!! Fluent::tabs()->panel('standard') !!}
            <h2>Standard form</h2>
            {!! Form::standard(['text' => 'some text...', 'select' => 2], 'standard')->errors($errors)->rules(['text' => 'required'])->method("put") !!}
            @include('fluentform::controls', ['form' => 'standard'])
            {!! Form::close() !!}
        {!! Fluent::tabs()->end() !!}
        
        {!! Fluent::tabs()->panel('inline') !!}
            <h2>Inline form</h2>
            {!! Form::inline(['select' => 2], 'inline')->errors($errors)->rules(['text' => 'required']) !!}
            @include('fluentform::controls', ['form' => 'inline'])
            {!! Form::close() !!}
        {!! Fluent::tabs()->end() !!}

        {!! Fluent::tabs()->panel('components') !!}
        {!! Fluent::tabs()->end() !!}
        
        {!! Fluent::tabs()->close() !!}
    </div>
</div>
{!! Fluent::scripts() !!}
</body>
</html>
