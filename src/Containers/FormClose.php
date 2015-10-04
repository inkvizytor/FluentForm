<?php namespace inkvizytor\FluentForm\Containers;

use inkvizytor\FluentForm\Base\Control;

/**
 * Class FormClose
 *
 * @package inkvizytor\FluentForm\Controls
 */
class FormClose extends Control
{
    /**
     * @return string
     */
    public function render()
    {
        return $this->getForm()->close();
    }
} 