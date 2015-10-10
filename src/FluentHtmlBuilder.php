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
     * @return string
     */
    public function styles()
    {
        return view('fluentform::styles')->render();
    }

    /**
     * @param bool|null $cdn
     * @return string
     */
    public function scripts($cdn = null)
    {
        return view('fluentform::scripts', ['cdn' => $cdn])->render();
    }
    
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