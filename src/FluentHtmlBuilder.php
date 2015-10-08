<?php namespace inkvizytor\FluentForm;

use inkvizytor\FluentForm\Components\ButtonGroup;
use inkvizytor\FluentForm\Components\TabStrip;

/**
 * Class FluentHtmlBuilder
 *
 * @package inkvizytor\FluentForm
 */
class FluentHtmlBuilder extends FluentBuilder
{
    /**
     * @return \inkvizytor\FluentForm\Components\TabStrip
     */
    public function tabs()
    {
        return (new TabStrip($this->handler()));
    }

    /**
     * @param array $buttons
     * @return \inkvizytor\FluentForm\Components\ButtonGroup
     */
    public function buttons(array $buttons)
    {
        return (new ButtonGroup($this->handler()))->buttons($buttons);
    }
} 