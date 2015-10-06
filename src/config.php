<?php

return [
    'renderer' => inkvizytor\FluentForm\Renderers\Bootstrap3::class,
    'validation' => inkvizytor\FluentForm\Validation\JQuery::class,
    
    'size' => [
        'label' => ['lg' => 4, 'md' => 4, 'sm' => 0, 'xs' => 0],
        'field' => ['lg' => 8, 'md' => 8, 'sm' => 12, 'xs' => 12],
    ],
    
    'controls' => [
        // ToDo: Custom controls registration
    ]
];
