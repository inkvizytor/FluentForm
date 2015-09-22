<?php namespace inkvizytor\FluentForm\Controls;

use inkvizytor\FluentForm\Traits\CssContainer;

class FormFooter extends BaseControl
{
    use CssContainer;
    
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