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
        <div class="row">
            <div class="col-lg-6">
                <h2>Standard form</h2>
                {!! Form::standard(['text' => 'some text...', 'select' => 2], 'standard')->errors($errors)->rules(['text' => 'required'])->method("put") !!}
                @include('fluentform::controls', ['form' => 'standard'])
                {!! Form::close() !!}
            </div>
            <div class="col-lg-6">
                <h2>Horizontal form</h2>
                {!! Form::horizontal(['select' => 2], 'horizontal')->errors($errors)->rules(['text' => 'required']) !!}
                @include('fluentform::controls', ['form' => 'horizontal'])
                {!! Form::close() !!}
            </div>
            <div class="col-lg-12">
                <h2>Inline form</h2>
                {!! Form::inline(['select' => 2], 'inline')->errors($errors)->rules(['text' => 'required']) !!}
                @include('fluentform::controls', ['form' => 'inline'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
{!! Fluent::scripts() !!}
</body>
</html>
