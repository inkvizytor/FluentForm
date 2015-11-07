{!! Form::password($form.'_dummy')->attr('style', 'display: none;') !!}
{!! Form::group()->content('Some text...')->label('Info')->css(['text-success']) !!}
{!! Form::group()->content('Some text without label...')->css(['text-info']) !!}
{!! Form::group()->text($form.'_text')->label('Text')->data('custom', 'value')
    ->prepend(Form::checkbox('test'))
    ->append(Fluent::iconlink(Fluent::FA_ENVELOPE, url('/email'), 'Check')->css(['btn-info']))->display() !!}
{!! Form::group()->password($form.'_password')->label('Password') !!}
{!! Form::group()->email($form.'_email')->label('Email') !!}
{!! Form::group()->url($form.'_url')->label('Url') !!}
{!! Form::group()->number($form.'_number')->label('Number')->min(1)->max(10) !!}
{!! Form::group()->range($form.'_range')->label('Range')->value(0)->min(0)->max(100)->step(5) !!}
{!! Form::group()->color($form.'_color')->label('Color') !!}
@if($form != 'inline')
<div class="clearfix"></div>
{!! Form::group()->file($form.'_file')->label('File')->sronly($form == 'inline')->width(6) !!}
{!! Form::group()->select($form.'_select', [1 => 'option 1', 2 => 'option 2', 3 => 'option 3'])->label('Select')->placeholder('choose...')
    ->prepend('Options')
    ->append(Form::button('choose', 'Choose')->css(['btn-primary']))
    ->width(6) !!}
@endif
{!! Form::group()
    ->add(Form::submit('filter', 'Filter')->icon('fa fa-filter'))
    ->add(Form::reset('reset', 'Reset')->icon('fa fa-refresh')->css(['btn-danger']))
!!}
<div class="clearfix"></div>
{!! Form::group()->checkbox($form.'_checkbox')->label('Checkbox') !!}
{!! Form::group()->checkboxes($form.'_checkboxes', [1 => 'option 1', 2 => 'option 2', 3 => 'option 3'])->checked([2])->label('Checkbox list') !!}
{!! Form::group()->checkboxes($form.'_checkboxes-inline', [1 => 'option 1', 2 => 'option 2', 3 => 'option 3'])->checked([2])->label('Checkbox list inline')->inline(true) !!}
{!! Form::group()->radios($form.'_radios', [1 => 'option 1', 2 => 'option 2', 3 => 'option 3'])->checked(3)->label('Radio list') !!}
{!! Form::group()->radios($form.'_radios-inline', [1 => 'option 1', 2 => 'option 2', 3 => 'option 3'])->label('Radio list inline')->inline(true) !!}
{!! Form::group()->timezones($form.'_timezones')->label('fluentform::preview.timezones.label')->placeholder('fluentform::preview.timezones.placeholder') !!}
@if($form != 'inline')
<div class="clearfix"></div>
{!! Fluent::panel()->open('Some other controls') !!}
    {!! Form::group()->datetime($form.'_date')->label('Date')->width(3) !!}
    {!! Form::group()->datetime($form.'_datetime')->time()->label('Date and Time')->width(3) !!}
    {!! Form::group()->datetimerange($form.'_datetimerange')->time()->label('Date range')->width(6) !!}
    {!! Form::group()->textarea($form.'_textarea')->label('Textarea')->rows(2)->help('fluentform::preview.textarea.help') !!}
    {!! Form::group()->editor($form.'_editor')->label('Editor')->sronly($form == 'standard') !!}
{!! Fluent::panel()->close() !!}
@else
{!! Fluent::buttons([
    Fluent::iconlink(Fluent::FA_PENCIL, url('/edit'), 'fluentform::preview.iconlink.edit')
        ->css(['btn-sm', 'btn-primary']),
    Fluent::iconlink(Fluent::FA_SEARCH, url('/details'), 'Edit')
        ->css(['btn-sm']),
    Fluent::link(url('/delete'), 'Delete')
        ->icon(Fluent::FA_REMOVE)
        ->css(['btn-sm', 'btn-danger'])
        ->data('confirm', 'Are you sure?')
]) !!}
<hr>
@endif
{!! Form::footer([
    Form::submit('save', 'Save'),
    Form::button('disabled', 'Disabled')->disabled(),
    Form::reset('reset', 'Reset')->css(['btn-danger']),
    Fluent::link(url('/back'), 'Back')->disabled(),
]) !!}