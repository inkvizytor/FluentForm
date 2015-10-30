{!! Form::password($form.'dummy')->css('hide') !!}
{!! Form::group()->content('Some text...')->label('Info')->css(['text-success']) !!}
{!! Form::group()->content('Some text without label...')->css(['text-info']) !!}
{!! Form::group()->text($form.'text')->label('Text')->data('custom', 'value')
    ->prepend(Form::checkbox('test'))
    ->append(Fluent::iconlink(Fluent::FA_ENVELOPE, url('/email'), 'Check')->css(['btn-info'])) !!}
{!! Form::group()->password($form.'password')->label('Password') !!}
{!! Form::group()
    ->add(
        Form::text('birthdate', Input::get('birthdate'))
            ->label('Geboortedatum')
            ->placeholder('Geboortedatum')
            ->prepend(Fluent::icon(Fluent::FA_CALENDAR))
            ->css('datepicker')
    )
    ->css('has-warning')->label('test')
!!}
@if($form != 'inline')
<div class="clearfix"></div>
{!! Form::group()->file($form.'file')->label('File')->sronly($form == 'inline')->width(6) !!}
{!! Form::group()->select($form.'select', [1 => 'option 1', 2 => 'option 2', 3 => 'option 3'])->label('Select')->placeholder('choose...')
    ->prepend('Options')
    ->append(Form::button('choose', 'Choose')->css(['btn-primary']))
    ->width(6) !!}
@endif
{!! Form::group()
    ->add(Form::submit('filter', 'Filter')->icon('fa fa-filter'))
    ->add(Form::reset('reset', 'Reset')->icon('fa fa-refresh')->css(['btn-danger']))
!!}
<div class="clearfix"></div>
{!! Form::group()->checkbox($form.'checkbox')->label('Checkbox') !!}
{!! Form::group()->checkboxes($form.'checkboxes', [1 => 'option 1', 2 => 'option 2', 3 => 'option 3'])->checked([2])->label('Checkbox list') !!}
{!! Form::group()->checkboxes($form.'checkboxes-inline', [1 => 'option 1', 2 => 'option 2', 3 => 'option 3'])->checked([2])->label('Checkbox list inline')->inline(true) !!}
{!! Form::group()->radios($form.'radios', [1 => 'option 1', 2 => 'option 2', 3 => 'option 3'])->checked(3)->label('Radio list') !!}
{!! Form::group()->radios($form.'radios-inline', [1 => 'option 1', 2 => 'option 2', 3 => 'option 3'])->label('Radio list inline')->inline(true) !!}
{!! Form::group()->timezones($form.'timezones')->placeholder('Choose your timezone') !!}
@if($form != 'inline')
<div class="clearfix"></div>
{!! Fluent::panel()->open('Some other controls') !!}
    {!! Form::group()->datetime($form.'date')->label('Date')->width(3) !!}
    {!! Form::group()->datetime($form.'datetime')->time()->label('Date and Time')->width(3) !!}
    {!! Form::group()->datetimerange($form.'datetimerange')->time()->label('Date range')->width(6) !!}
    {!! Form::group()->textarea($form.'textarea')->label('Textarea')->rows(2)->help('Some help..') !!}
    {!! Form::group()->editor($form.'editor')->label('Editor')->sronly($form == 'standard') !!}
{!! Fluent::panel()->close() !!}
@else
{!! Fluent::buttons([
    Fluent::iconlink(Fluent::FA_PENCIL, url('/edit'), 'Edit')
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