{!! Form::password($form.'dummy')->css('hide') !!}
{!! Form::group()->content('Some text...')->label('Info')->css(['text-success']) !!}
{!! Form::group()->content('Some text without label...')->css(['text-info']) !!}
{!! Form::group()->text($form.'text')->label('Text')->data('custom', 'value') !!}
{!! Form::group()->password($form.'password')->label('Password') !!}
{!! Form::group()->file($form.'file')->label('File')->sronly($form == 'inline') !!}
{!! Form::group()->select($form.'select', [1 => 'option 1', 2 => 'option 2', 3 => 'option 3'])->label('Select')->placeholder('choose...') !!}
<div class="clearfix"></div>
{!! Form::group()->checkbox($form.'checkbox')->label('Checkbox') !!}
{!! Form::group()->checkboxes($form.'checkboxes', [1 => 'option 1', 2 => 'option 2', 3 => 'option 3'])->checked([2])->label('Checkbox list') !!}
{!! Form::group()->checkboxes($form.'checkboxes-inline', [1 => 'option 1', 2 => 'option 2', 3 => 'option 3'])->checked([2])->label('Checkbox list inline')->inline(true) !!}
{!! Form::group()->radios($form.'radios', [1 => 'option 1', 2 => 'option 2', 3 => 'option 3'])->checked(3)->label('Radio list') !!}
{!! Form::group()->radios($form.'radios-inline', [1 => 'option 1', 2 => 'option 2', 3 => 'option 3'])->label('Radio list inline')->inline(true) !!}
@if($form != 'inline')
<div class="clearfix"></div>
{!! Form::group()->datetime($form.'date')->label('Date') !!}
{!! Form::group()->datetime($form.'datetime')->time()->label('Date and Time') !!}
{!! Form::group()->textarea($form.'textarea')->label('Textarea')->rows(2)->help('Some help..') !!}
{!! Form::group()->editor($form.'editor')->label('Editor')->sronly($form == 'standard') !!}
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