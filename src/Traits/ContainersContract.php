<?php namespace inkvizytor\FluentForm\Traits;

use inkvizytor\FluentForm\Containers\ButtonGroup;
use inkvizytor\FluentForm\Containers\FormFooter;
use inkvizytor\FluentForm\Containers\FormGroup;
use inkvizytor\FluentForm\Containers\TabStrip;

/**
 * Class ContainersContract
 *
 * @package inkvizytor\FluentForm\Traits
 */
trait ContainersContract
{
    /**
     * @param array $buttons
     * @return \inkvizytor\FluentForm\Containers\ButtonGroup
     */
    public function buttons(array $buttons)
    {
        return (new ButtonGroup($this->getRenderer()))->buttons($buttons);
    }

    /**
     * @return \inkvizytor\FluentForm\Containers\FormGroup
     */
    public function group()
    {
        return (new FormGroup($this->getRenderer()));
    }

    /**
     * @param array $buttons
     * @return \inkvizytor\FluentForm\Containers\FormFooter
     */
    public function footer(array $buttons = [])
    {
        return (new FormFooter($this->getRenderer()))->buttons($buttons);
    }

    /**
     * @return \inkvizytor\FluentForm\Containers\TabStrip
     */
    public function tabs()
    {
        return (new TabStrip($this->getRenderer()));
    }
}