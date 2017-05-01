<?php namespace inkvizytor\FluentForm\Facades;

use Illuminate\Support\Facades\Facade;

class FluentForm extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'FluentForm';
    }
}
