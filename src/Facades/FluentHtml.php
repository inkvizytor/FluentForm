<?php namespace inkvizytor\FluentForm\Facades;

use Illuminate\Support\Facades\Facade;
use inkvizytor\FluentForm\Icons\FontAwesome;
use inkvizytor\FluentForm\Icons\GlyphIcons;

class FluentHtml extends Facade implements GlyphIcons, FontAwesome
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'FluentHtml';
    }
}
