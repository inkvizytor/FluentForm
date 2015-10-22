<?php namespace inkvizytor\FluentForm\Components;

use inkvizytor\FluentForm\Base\Control;
use inkvizytor\FluentForm\Traits\CssContract;

class Icon extends Control
{
    use CssContract;
    
    /** @var string */
    protected $title;
    
    /**
     * @param string $title
     * @return $this
     */
    public function title($title)
    {
        $this->title = $title;

        return $this;
    }
    
    /**
     * @return string
     */
    public function render()
    {
        return $this->html()->tag('i', $this->getOptions(), '');
    }
}