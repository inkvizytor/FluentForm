<?php namespace inkvizytor\FluentForm\Containers;

use inkvizytor\FluentForm\Controls\BaseControl;
use inkvizytor\FluentForm\Traits\CssContract;

class FormFooter extends BaseControl
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
     * @param BaseControl $button
     * @param bool $enabled
     * @return $this
     */
    public function add(BaseControl $button, $enabled = true)
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
        return '<div'.$this->getHtml()->attributes($this->getOptions()).'>'.implode(' ', $this->buttons).'</div>';
    }
}