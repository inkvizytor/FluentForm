{!! Form::password('dummy')->css('hide') !!}
{!! Form::group()->content('Some text...')->label('Info')->css(['text-success']) !!}
{!! Form::group()->content('Some text without label...')->css(['text-info']) !!}
{!! Form::group()->text('text')->label('Text')->data('custom', 'value') !!}
{!! Form::group()->password('password')->label('Password') !!}
{!! Form::group()->file('file')->label('File')->sronly($inline) !!}
{!! Form::group()->select('select', [1 => 'option 1', 2 => 'option 2', 3 => 'option 3'])->label('Select')->placeholder('choose...') !!}
<div class="clearfix"></div>
{!! Form::group()->checkbox('checkbox')->label('Checkbox') !!}
{!! Form::group()->checkboxes('checkboxes', [1 => 'option 1', 2 => 'option 2', 3 => 'option 3'])->checked([2])->label('Checkbox list') !!}
{!! Form::group()->checkboxes('checkboxes-inline', [1 => 'option 1', 2 => 'option 2', 3 => 'option 3'])->checked([2])->label('Checkbox list inline')->inline(true) !!}
{!! Form::group()->radios('radios', [1 => 'option 1', 2 => 'option 2', 3 => 'option 3'])->checked(3)->label('Radio list') !!}
{!! Form::group()->radios('radios-inline', [1 => 'option 1', 2 => 'option 2', 3 => 'option 3'])->label('Radio list inline')->inline(true) !!}
@if($inline == false)
<div class="clearfix"></div>
{!! Form::group()->datetime('date')->label('Date') !!}
{!! Form::group()->datetime('datetime')->time()->label('Date and Time') !!}
{!! Form::group()->textarea('textarea')->label('Textarea')->rows(2)->help('Some help..') !!}
{!! Form::group()->editor('editor')->label('Editor')->sronly($standard) !!}
@else
{!! Fluent::buttons([
    Form::icon('fa fa-pencil', url('/edit'), 'Edit')
        ->css(['btn-sm', 'btn-primary']),
    Form::icon('fa fa-search', url('/details'), 'Edit')
        ->css(['btn-sm']),
    Form::link(url('/delete'), 'Delete')
        ->icon('fa fa-remove')
        ->css(['btn-sm', 'btn-danger'])
        ->data('confirm', 'Are you sure?')
]) !!}
<hr>
@endif
{!! Form::footer([
    Form::submit('save', 'Save'),
    Form::button('disabled', 'Disabled')->disabled(),
    Form::reset('reset', 'Reset')->css(['btn-danger']),
    Form::link(url('/back'), 'Back')->disabled(),
]) !!}