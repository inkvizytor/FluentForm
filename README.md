#Fluent Form

##Form builder for Laravel 5
Main purpose of this package is to provide intuitive form creation with code autocompletion, validation and markup for **Bootstrap 3** CSS framework. I strongly recommend using **[Laravel 5 IDE Helper Generator](https://github.com/barryvdh/laravel-ide-helper)** for autocompletion.

##Installation
Require this package with composer using the following command:
```
composer require inkvizytor/fluentform
```
Add the service provider to the `providers` array in `config/app.php`:
```php
    'providers' => [
        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Foundation\Providers\ArtisanServiceProvider::class,
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        ...
        inkvizytor\FluentForm\FluentFormServiceProvider::class,
    ],
```
Next at the end of `config/app.php` add Fluent Form facade to the `aliases` array:
```php
    'aliases' => [
        'App'       => Illuminate\Support\Facades\App::class,
        'Artisan'   => Illuminate\Support\Facades\Artisan::class,
        ...
        'Form'  	 => inkvizytor\FluentForm\Facades\FluentForm::class,
    ],
```
And publish `fluentform.php` config file:
```
php artisan vendor:publish --provider="inkvizytor\FluentForm\FluentFormServiceProvider"
```

##Getting Started

###Example
UserController.php
```php
    public function edit(User $user)
    {
        return view('admin.users.edit')
            ->with('user', $user)
            ->with('rules', $this->rules())
            ->with('timezones', config('timezones'));
    }

    private function rules()
    {
        return [
            'username'  => 'required|alpha|min:3|max:50',
            'email'     => 'required|email|max:100',
            'password'  => 'confirmed'
        ];
    }
```
edit.blade.php
```php
@section('content')
    <h5>Edit user</h5>
    <br>
    {!! Form::horizontal($user)->rules($rules)->errors($errors) !!}
    {!! Form::password('dummy')->css('hide') !!}
    <div class="row">
        <div class="col-lg-4 col-md-6">
            {!! Form::group()->text('username')->label('User name') !!}
            {!! Form::group()->text('email')->label('Email address') !!}
            {!! Form::group()->html('<a href="#change-password" data-toggle="collapse">Change password</a>') !!}
            <div id="change-password" class="{!! $errors->getBag('default')->has('password') ? '' : 'collapse' !!}">
                {!! Form::group()->password('password')->label('Password') !!}
                {!! Form::group()->password('password_confirmation')->label('Password confirmation') !!}
            </div>
            {!! Form::group()->checkbox('is_active')->label('Account active')->disabled($user->is_owner) !!}
            {!! Form::group()->select('timezone', $timezones)->label('Timezone')->placeholder('Default timezone') !!}
            <br>
            {!! Form::group()
                ->add(Form::submit('save', 'Save changes')->icon('fa fa-download')->css('btn-primary'))
                ->add(Form::link(action('Admin\UsersController@index'), 'Back')->icon('fa fa-arrow-left'))
            !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection
```

### Controls
```php
Form:: or Form::group()->

Form::group()->input($type, $name, $value = null);
Form::group()->text($name, $value = null);
Form::group()->password($name);
Form::group()->file($name);
Form::group()->textarea($name, $value = null);
Form::group()->select($name, array $items, $selected = null);
Form::group()->checkbox($name, $value = true, $checked = null);
Form::group()->checkboxes($name, array $items, array $checked = []);
Form::group()->radios($name, array $items, $checked = null);
Form::group()->html($html);
```

### Buttons
```php
Form::button($name, $label, $value = null);
Form::submit($name, $label, $value = null);
Form::reset($name, $label, $value = null);
Form::link($url, $label);
Form::icon($icon, $url, $label);
/* Buttons group */
Form::buttons([
    \Form::icon('fa fa-pencil', action('Admin\UsersController@edit', $user->id), 'Edit')
        ->css('btn-sm btn-primary'),
    \Form::icon('fa fa-remove', action('Admin\UsersController@delete', $user->id), 'Delete')
        ->css('btn-sm btn-danger')
        ->data('confirm', 'Are you sure?')
]])
```

### Tabs
```php
@section('content')
    {!! FluentForm::tabs()
        ->add('details', 'User details', true)
        ->add('security', 'Account security')
        ->add('permissions', 'Roles and permissions')
        ->open()
    !!}
        {!! FluentForm::tabs()->panel('details', true) !!}
            ...
        {!! FluentForm::tabs()->end() !!}

        {!! FluentForm::tabs()->panel('security') !!}
            ...
        {!! FluentForm::tabs()->end() !!}

        {!! FluentForm::tabs()->panel('permissions') !!}
            ...
        {!! FluentForm::tabs()->end() !!}
    {!! FluentForm::tabs()->close() !!}
@endsection
```

### Other
```php
Form::hidden($name, $value = null)
Form::radio($name, $value = true, $checked = null)
/* Form control group */
Form::group();
/* Form footer */
Form::footer([
    Form::link(action('Admin\UsersController@create'), 'Add user')
        ->icon('fa fa-plus')
        ->css('btn-success')
]);
```

###Something more
####Datetime picker
[Bootstrap 3 Date/Time Picker](https://github.com/Eonasdan/bootstrap-datetimepicker)
```php
Form::group()->datetime($name, $value = null);
```
```javascript
$(function()
{
    $(document).on('datetimepicker', function ()
    {
        $('.datetime, input[data-toggle="datetime"]').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            showClear: true,
            showClose: true
        });
        $('.date, input[data-toggle="date"]').datetimepicker({
            format: 'YYYY-MM-DD',
            showClear: true,
            showClose: true
        });
        $('input[data-toggle="date"] + .input-group-addon').click(function ()
        {
            $(this).prev().focus();
        });
        $('input[data-toggle="datetime"] + .input-group-addon').click(function ()
        {
            $(this).prev().focus();
        });
    });

    $(document).trigger("datetimepicker");
});
```
####Editor
This method renders textarea with `data-editor` attribute and nothing more. I recommend [TinyMCE](http://www.tinymce.com/).
```php
Form::group()->editor($name, $value = null);
```
```javascript
$(function()
{
	tinymce.init([
    	selector:'textarea[data-editor]'
    ]);
});

```
####Validation
For client side validation use [jQuery Validation Plugin](http://jqueryvalidation.org/) and [jQuery Unobtrusive Validation](https://github.com/aspnet/jquery-validation-unobtrusive).
```javascript
$(function ()
{
    var forms = $('form');

    if ($.validator && forms.length > 0)
    {
        forms.each(function ()
        {
            var settings = $(this).validate().settings;

            settings.highlight = function (element)
            {
                $(element).closest('.control-group').addClass('error');
                $(element).closest('.form-group').addClass('has-error');
            };

            settings.unhighlight = function (element)
            {
                $(element).closest('.control-group').removeClass('error');
                $(element).closest('.form-group').removeClass('has-error');
            };

            settings.errorPlacement = function (error, element)
            {
                var group = element.parent('.input-group');

                if (group.length > 0)
                    element = group.first();

                error.insertAfter(element);
            }
        });

        forms.validate({
            submitHandler: function(form)
            {
                form.submit();
            }
        });
    }
})
```

##License
The **Fluent Form** is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).