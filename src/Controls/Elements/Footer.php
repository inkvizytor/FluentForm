<?php namespace inkvizytor\FluentForm\Controls\Elements;

use inkvizytor\FluentForm\Base\Control;
use inkvizytor\FluentForm\Traits\CssContract;

/**
 * Class Footer
 *
 * @package inkvizytor\FluentForm
 */
class Footer extends Control
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
     * @param bool $enabled
     * @return $this
     */
    public function add(Control $button, $enabled = true)
    {
        if ($enabled == true)
        {
            $this->buttons[] = $button;
        }

        return $this;
    }
    
    /**
     * @return string
     */
    public function render()
    {
        return '<div'.$this->html()->attr($this->getOptions()).'>'.implode(' ', $this->buttons).'</div>';
    }
}