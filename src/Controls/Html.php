<?php namespace inkvizytor\FluentForm\Controls;

use inkvizytor\FluentForm\Base\Fluent;

/**
 * Class Html
 *
 * @package inkvizytor\FluentForm\Controls
 */
class Html extends Fluent
{
    /** @var array */
    protected $guarded = ['html'];

    /** @var string */
    protected $html;
    
    /**
     * @param string $html
     * @return $this
     */
    public function html($html)
    {
        $this->html = $html;

        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        return '<p'.$this->getHtml()->attributes($this->getOptions()).'>'.$this->html.'</p>';
    }
} 