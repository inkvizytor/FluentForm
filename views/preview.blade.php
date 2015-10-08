<!DOCTYPE html>
<html>
<head>
    <title>Fluent Form Preview</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/tinymce/4.2.6/tinymce.min.js" type="text/javascript"></script>
    <script src="//ajax.aspnetcdn.com/ajax/mvc/5.2.3/jquery.validate.unobtrusive.min.js" type="text/javascript"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="//cdn.jsdelivr.net/bootstrap.filestyle/1.1.0/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.min.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
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
                @include('fluentform::controls', ['standard' => true, 'horizontal' => false, 'inline' => false])
                {!! Form::close() !!}
            </div>
            <div class="col-lg-6">
                <h2>Horizontal form</h2>
                {!! Form::horizontal(['select' => 2], 'horizontal')->errors($errors)->rules(['text' => 'required']) !!}
                @include('fluentform::controls', ['standard' => false, 'horizontal' => true, 'inline' => false])
                {!! Form::close() !!}
            </div>
            <div class="col-lg-12">
                <h2>Inline form</h2>
                {!! Form::inline(['select' => 2], 'inline')->errors($errors)->rules(['text' => 'required']) !!}
                @include('fluentform::controls', ['standard' => false, 'horizontal' => false, 'inline' => true])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function()
    {
        if ($.validator)
        {
            $('form').each(function ()
            {
                $(this).validate({
                    errorElement: 'span',
                    errorClass: 'text-danger',
                    highlight: function (element)
                    {
                        $(element).closest('.control-group').addClass('error');
                        $(element).closest('.form-group').addClass('has-error');
                    },
                    unhighlight: function (element)
                    {
                        $(element).closest('.control-group').removeClass('error');
                        $(element).closest('.form-group').removeClass('has-error');
                    },
                    errorPlacement: function (error, element)
                    {
                        var group = element.parent('.input-group');
    
                        if (group.length > 0)
                            element = group.first();
    
                        error.insertAfter(element);
                    },
                    submitHandler: function(form)
                    {
                        form.submit();
                    }
                });
            });
        }

        $(document).on('datetimepicker', function ()
        {
            $('input[data-toggle^="date"]').each(function ()
            {
                $(this).datetimepicker($(this).data('config'))
            })
                .next('.input-group-addon').click(function ()
                {
                    $(this).prev().focus();
                });
        });

        $(document).trigger("datetimepicker");

        tinymce.init({
            selector: 'textarea[data-editor]'
        });
    });
</script>
</body>
</html>
