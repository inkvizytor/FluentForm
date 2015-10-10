<?php namespace inkvizytor\FluentForm\Controls;

use inkvizytor\FluentForm\Base\Control;
use inkvizytor\FluentForm\Traits\CssContract;
use inkvizytor\FluentForm\Traits\DataContract;

/**
 * Class Button
 *
 * @package inkvizytor\FluentForm
 */
class Button extends Control
{
    use CssContract, DataContract;
    
    /** @var array */
    protected $guarded = ['label', 'icon'];

    /** @var string */
    protected $label;
    
    /** @var string */
    protected $type = 'button';

    /** @var string */
    protected $name;
    
    /** @var string */
    protected $value;

    /** @var string */
    protected $icon;

    /** @var string */
    protected $title;

    /** @var string */
    protected $disabled;

    /**
     * @param string $label
     * @return $this
     */
    public function label($label)
    {
        $this->label = $label;

        return $this;
    }
    
    /**
     * @param string $type
     * @return $this
     */
    public function type($type)
    {
        $this->type = in_array($type, ['button', 'submit', 'reset']) ? $type : 'button';

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function name($name)
    {
        $this->name = $name;

        return $this;
    }
    
    /**
     * @param string $value
     * @return $this
     */
    public function value($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @param string $icon
     * @return $this
     */
    public function icon($icon)
    {
        $this->icon = !empty($icon) ? '<i class="'.$icon.'"></i> ' : '';

        return $this;
    }

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
     * @param bool $value
     * @return $this
     */
    public function disabled($value = true)
    {
        $this->disabled = $value ? 'disabled' : null;

        return $this;
    }
    
    /**
     * @return string
     */
    public function render()
    {
        if ($this->type == 'submit')
        {
            $this->attr('value', true);
        }

        return $this->html()->tag('button', $this->getOptions(), $this->icon.$this->html()->encode($this->label));
    }
} 