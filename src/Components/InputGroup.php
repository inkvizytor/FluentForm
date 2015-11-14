<?php namespace inkvizytor\FluentForm\Components;

use inkvizytor\FluentForm\Base\Field;
use inkvizytor\FluentForm\Renderers\Base;

/**
 * Class InputGroup
 *
 * @package inkvizytor\FluentForm
 */
class InputGroup extends Field
{
    /** @var \inkvizytor\FluentForm\Base\Control */
    protected $control;
    
    /** @var mixed */
    protected $prepend;

    /** @var mixed */
    protected $append;
    
    /** @var string */
    protected $mode;

    /**
     * @param \inkvizytor\FluentForm\Base\Field $control
     */
    public function control(Field $control)
    {
        $this->name($control->getName());
        $this->help($control->getHelp());
        $this->label($control->getLabel());
        $this->sronly($this->isSrOnly());
        $this->required($control->isRequired());
        $this->setAttr($control->getAttr(null));
        $this->setData($control->getData(null));
        $this->css($control->getCss());
        
        $width = $control->getWidth();
        $this->width(
            array_get($width, 'lg'), 
            array_get($width, 'md'), 
            array_get($width, 'sm'), 
            array_get($width, 'xs')
        );

        $this->control = $control;
    }

    /**
     * @param mixed $addon
     */
    public function prepend($addon)
    {
        $this->prepend = $addon;
    }

    /**
     * @return mixed
     */
    public function getPrepend()
    {
        return $this->prepend;
    }

    /**
     * @param mixed $addon
     */
    public function append($addon)
    {
        $this->append = $addon;
    }

    /**
     * @return mixed
     */
    public function getAppend()
    {
        return $this->append;
    }

    /**
     * @return string
     */
    public function render()
    {
        $this->renderer()->mode(Base::RENDER_STANDARD);
        
        return $this->control->display();
    }
}