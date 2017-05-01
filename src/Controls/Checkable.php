<?php namespace inkvizytor\FluentForm\Controls;

use inkvizytor\FluentForm\Base\ViewComponent;
use inkvizytor\FluentForm\Contracts\IRootComponent;

/**
 * Class Checkable
 *
 * @package inkvizytor\FluentForm
 */
class Checkable extends ViewComponent
{
    /** @var array */
    protected $guarded = ['type', 'value', 'checked', 'placeholder', 'always'];

    /** @var string */
    private $type = 'checkbox';
    
    /** @var int|mixed */
    protected $value;

    /** @var bool */
    protected $checked;

    /** @var bool */
    protected $always = false;

    /**
     * Checkable constructor.
     *
     * @param \inkvizytor\FluentForm\Contracts\IRootComponent $component
     * @param string $type
     */
    public function __construct(IRootComponent $component, $type = 'checkbox')
    {
        parent::__construct($component);

        $this->type = $type;
    }
    
    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int|mixed $value
     * @return $this
     */
    public function value($value)
    {
        $this->value = $value;

        return $this;
    }
    
    /**
     * @param bool $checked
     * @return $this
     */
    public function checked($checked)
    {
        $this->checked = $checked;

        return $this;
    }

    /**
     * @param bool $always
     * @return $this
     */
    public function always($always)
    {
        $this->always = $always;

        return $this;
    }

    /**
     * @return string
     */
    public function renderComponent()
    {
        $content = null;
        $options = array_merge($this->getAttr(), $this->getDataAttr(), ['class' => $this->getCssAttr()]);
        $attributes = array_only($options, 'class');
        
        if ($this->getType() == 'checkbox')
        {
            $content  = $this->always ? $this->root()->html()->tag('input', [
                'type' => 'hidden', 
                'name' => $this->getName(), 
                'value' => false
            ]) : '';
            
            $content .= $this->root()->html()->tag('input', array_merge(array_except($options, 'class'), [
                'type' => 'checkbox', 
                'name' => $this->getName(), 
                'value' => $this->value !== null ? $this->value : 1, 
                'checked' => $this->root()->binder()->checked($this->getKey(), $this->value, $this->checked)
            ]));
        }
        else
        {
            $content = $this->root()->html()->tag('input', array_merge(array_except($options, 'class'), [
                'type' => 'radio',
                'name' => $this->getName(),
                'value' => $this->value !== null ? $this->value : $this->getName(),
                'checked' => $this->root()->binder()->checked($this->getKey(), $this->value, $this->checked)
            ]));
        }
        
        if (!empty($this->getLabel()))
        {
            return $this->root()->html()->tag('label', $attributes, $content.' '.$this->getLabel());
        }
        
        return $content;
    }
}
