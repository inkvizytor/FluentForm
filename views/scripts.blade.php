@if($cdn === null || $cdn === true)
    @foreach(config('fluentform.cdn.scripts') as $name => $url)
        @if(config('fluentform.cdn.enabled.'.$name, false) == true)
        <script src="{{ $url }}" type="text/javascript"></script>
        @endif
    @endforeach
@endif

@if($cdn === null || $cdn === false)
<script type="text/javascript">
$(function()
{
    @if(config('fluentform.cdn.enabled.jquery-validate', false) == true) 
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
    @endif 

    @if(config('fluentform.cdn.enabled.jquery-validate', false) == true) 
    $('input[data-toggle^="date"]').each(function ()
    {
        $(this).datetimepicker($(this).data('config'))
    })
    .next('.input-group-addon').css('cursor', 'pointer').click(function ()
    {
        $(this).prev().focus();
    });
    @endif 

    @if(config('fluentform.cdn.enabled.tinymce', false) == true)
    $('textarea[data-editor]').each(function ()
    {
        tinymce.init($(this).data('config'));
    });
    @endif 
});
</script>
@endif