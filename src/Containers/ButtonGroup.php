<?php namespace inkvizytor\FluentForm\Containers;

use inkvizytor\FluentForm\Base\Control;
use inkvizytor\FluentForm\Traits\CssContract;

class ButtonGroup extends Control
{
    use CssContract;
    
    /** @var array */
    protected $buttons;
    
    /**
     * @param array $buttons
     * @return $this
     */
    public function buttons($buttons)
    {
        $this->buttons = $buttons;

        return $this;
    }

    /**
     * @param Control $button
     * @return $this
     */
    public function add(Control $button)
    {
        $this->buttons[] = $button;

        return $this;
    }
    
    /**
     * @return string
     */
    public function render()
    {
        return '<div'.$this->html()->attributes($this->getOptions()).'>'.implode(' ', $this->buttons).'</div>';
    }
}