<?php namespace inkvizytor\FluentForm\Controls;

use inkvizytor\FluentForm\Renderers\BaseRenderer;
use inkvizytor\FluentForm\Traits\AttrContainer;

abstract class BaseControl
{
    use AttrContainer;
    
    /** @var \inkvizytor\FluentForm\Renderers\BaseRenderer */
    private $renderer;
    
    /** @var array */
    protected $guarded = [];
    
    /**
     * @param \inkvizytor\FluentForm\Renderers\BaseRenderer $renderer
     */
    public function __construct(BaseRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @return array
     */
    protected function getOptions()
    {
        $options = array_except(get_object_vars($this), $this->getGuarded());

        if (method_exists($this, 'appendAttributes'))
        {
            $this->appendAttributes($options);
        }
        
        if (method_exists($this, 'appendDataAttributes'))
        {
            $this->appendDataAttributes($options);
        }

        if (method_exists($this, 'appendCssAttribute'))
        {
            $this->appendCssAttribute($options);
        }

        return array_filter($options, function($item)
        {
            return !empty($item) && !is_array($item) && !is_object($item);
        });
    }

    /**
     * @return array
     */
    protected function getGuarded()
    {
        return array_merge(['renderer', 'attr', 'css', 'data', 'guarded'], $this->guarded);
    }

    /**
     * @return \inkvizytor\FluentForm\Renderers\BaseRenderer
     */
    protected function getRenderer()
    {
        return $this->renderer;
    }

    /**
     * @return \Collective\Html\HtmlBuilder
     */
    protected function getHtml()
    {
        return $this->getRenderer()->getHtml();
    }

    /**
     * @return \Collective\Html\FormBuilder
     */
    protected function getForm()
    {
        return $this->getRenderer()->getForm();
    }
    
    /**
     * @return string
     */
    public abstract function render();

    /**
     * @return string
     */
    public function display()
    {
        return $this->getRenderer()
            ->bindControl($this)
            ->display();
    }
    
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->display();
    }
} 