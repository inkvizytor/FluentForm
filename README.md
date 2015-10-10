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
        inkvizytor\FluentForm\FluentServiceProvider::class,
    ],
```
Next at the end of `config/app.php` add Fluent Form facade to the `aliases` array:
```php
    'aliases' => [
        'App'       => Illuminate\Support\Facades\App::class,
        'Artisan'   => Illuminate\Support\Facades\Artisan::class,
        ...
        'Form'  	 => inkvizytor\FluentForm\Facades\FluentForm::class,
        'Fluent'  	 => inkvizytor\FluentForm\Facades\FluentHtml::class,
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
            {!! Form::group()->content('<a href="#change-password" data-toggle="collapse">Change password</a>') !!}
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

### Form layouts
```php
Form::open($model = null, $formName = 'default', $layout = 'standard')
Form::standard($model = null, $formName = 'default');
Form::horizontal($model = null, $formName = 'default');
Form::inline($model = null, $formName = 'default');
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
Form::group()->content($html);
```

### Buttons
```php
Form::button($name, $label, $value = null);
Form::submit($name, $label, $value = null);
Form::reset($name, $label, $value = null);
Form::link($url, $label);

/* Buttons group */
Fluent::buttons([
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
    {!! Fluent::tabs()
        ->add('details', 'User details', true)
        ->add('security', 'Account security')
        ->add('permissions', 'Roles and permissions')
        ->open()
    !!}
        {!! Fluent::tabs()->panel('details', true) !!}
            ...
        {!! Fluent::tabs()->end() !!}

        {!! Form::tabs()->panel('security') !!}
            ...
        {!! Fluent::tabs()->end() !!}

        {!! Fluent::tabs()->panel('permissions') !!}
            ...
        {!! Fluent::tabs()->end() !!}
    {!! Form::tabs()->close() !!}
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
####CDN support
In `fluentform.php` config file you can enable or disable CDN support for Bootstrap and various other elements.
```php
	'cdn' => [
        'enabled' => [
            'jquery' => true,
            'jquery-validate' => true,
            'jquery-validate-unobtrusive' => true,
            'moment' => true,
            'bootstrap' => true,
            'bootstrap-filestyle' => true,
            'bootstrap-datetimepicker' => true,
            'font-awesome' => true,
            'tinymce' => true,
        ],
        'styles' => [
            'bootstrap' => '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css',
            'bootstrap-datetimepicker' => '//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css',
            'font-awesome' => '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
        ],
        'scripts' => [
            'jquery' => '//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js',
            'jquery-validate' => '//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js',
            'jquery-validate-unobtrusive' => '//ajax.aspnetcdn.com/ajax/mvc/5.2.3/jquery.validate.unobtrusive.min.js',
            'moment' => '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.min.js',
            'bootstrap' => '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js',
            'bootstrap-filestyle' => '//cdn.jsdelivr.net/bootstrap.filestyle/1.1.0/js/bootstrap-filestyle.min.js',
            'bootstrap-datetimepicker' => '//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js',
            'tinymce' => '//tinymce.cachefly.net/4.2/tinymce.min.js',
        ]
    ],
```
Next modify your `layout.php` file:
```php
<!DOCTYPE html>
<html>
<head>
    <title>Fluent Form</title>
    {!! Fluent::styles() !!}
</head>
<body>
<div class="container">
    ...
</div>
{!! Fluent::scripts() !!}
</body>
</html>
```
All required styles and scripts will be included in html. If you don't like the idea of CDN you can link to your local styles/scripts. Then you need to include in `layout.php` only `Fluent::scripts(false)` to initialize javascript controls like Date/Time Picker or TinyMCE.
```php
<!DOCTYPE html>
<html>
<head>
    <title>Fluent Form</title>
	...
</head>
<body>
<div class="container">
    ...
</div>
{!! Fluent::scripts(false) !!}
</body>
</html>
```

####Datetime picker
[Bootstrap 3 Date/Time Picker](https://github.com/Eonasdan/bootstrap-datetimepicker)
```php
Form::group()->datetime($name, $value = null);
```
You can also change some default settings for this control in `fluentform.php` config file.
```php
    // Bootstrap DateTimePicker configuration
    'datetimepicker' => [
        'showClear' => true,
        'showClose' => true,
    ]
```

####Editor
This method renders textarea replaced with [TinyMCE](http://www.tinymce.com/).
```php
Form::group()->editor($name, $value = null);
```
In `fluentform.php` config file you can change some default settings for TinyMCE.
```php
    // TinyMCE configuration
    'tinymce' => [
        'plugins' => [
            'advlist autolink lists link image charmap hr anchor pagebreak autoresize',
            'searchreplace wordcount visualblocks visualchars code',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern autosave'
        ],
        'toolbar1' => 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        'relative_urls' => false,
        'paste_data_images' => false,
        'browser_spellcheck' => true,
        'entity_encoding' => "raw",
        'autoresize_bottom_margin' => 0,
        'nowrap' => false,
        'resize'=> false,
    ],
```

####Validation
For client side validation use [jQuery Validation Plugin](http://jqueryvalidation.org/) and [jQuery Unobtrusive Validation](https://github.com/aspnet/jquery-validation-unobtrusive).


##License
The **Fluent Form** is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).