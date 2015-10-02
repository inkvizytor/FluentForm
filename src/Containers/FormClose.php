<?php namespace inkvizytor\FluentForm\Containers;

use inkvizytor\FluentForm\Controls\BaseControl;

/**
 * Class FormClose
 *
 * @package inkvizytor\FluentForm\Controls
 */
class FormClose extends BaseControl
{
    /**
     * @return string
     */
    public function render()
    {
        return $this->getForm()->close();
    }
} 