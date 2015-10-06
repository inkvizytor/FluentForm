<?php namespace inkvizytor\FluentForm\Controls;

use inkvizytor\FluentForm\Base\Fluent;

/**
 * Class Html
 *
 * @package inkvizytor\FluentForm\Controls
 */
class Field extends Fluent
{
    /** @var array */
    protected $guarded = ['content'];

    /** @var string */
    protected $content;
    
    /**
     * @param string $content
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        return '<p'.$this->html()->attributes($this->getOptions()).'>'.$this->content.'</p>';
    }
} 