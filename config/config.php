<?php

return [
    // Renderer
    'renderer' => inkvizytor\FluentForm\Renderers\Bootstrap3::class,
    
    // Validation
    'validation' => inkvizytor\FluentForm\Validation\JQuery::class,
    
    // Form default size
    'size' => [
        'label' => ['lg' => 4, 'md' => 4, 'sm' => 0, 'xs' => 0],
        'field' => ['lg' => 8, 'md' => 8, 'sm' => 12, 'xs' => 12],
    ],

    // Custom controls registration
    'controls' => [
        'timezones' => inkvizytor\FluentForm\Controls\Custom\TimeZones::class
    ],
    
    // CDN support
    'cdn' => [
        'enabled' => [
            'jquery' => true,
            'jquery-validate' => true,
            'jquery-validate-unobtrusive' => true,
            'moment' => true,
            'bootstrap' => true,
            'bootstrap-filestyle' => true,
            'bootstrap-datetimepicker' => true,
            'bootstrap-daterangepicker' => true,
            'font-awesome' => true,
            'tinymce' => true,
        ],
        'styles' => [
            'bootstrap' => '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css',
            'bootstrap-datetimepicker' => '//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css',
            'bootstrap-daterangepicker' => '//cdn.jsdelivr.net/bootstrap.daterangepicker/2.1.12/daterangepicker.css',
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
            'bootstrap-daterangepicker' => '//cdn.jsdelivr.net/bootstrap.daterangepicker/2.1.12/daterangepicker.js',
            'tinymce' => '//tinymce.cachefly.net/4.2/tinymce.min.js',
        ]
    ],
    
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

    // Bootstrap DateTimePicker configuration
    'datetimepicker' => [
        'showClear' => true,
        'showClose' => true,
    ],

    // Bootstrap DateRangePicker configuration
    'datetimerange' => [
        'format' => [
            'date' => 'YYYY-MM-DD',
            'datetime' => 'YYYY-MM-DD HH:mm:ss'
        ],
        'separator' => ' | ',
        'firstDay' => 1,
        'timePicker24Hour' => true,
        'opens' => 'center',
    ]
];
