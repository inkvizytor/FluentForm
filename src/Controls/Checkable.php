<?php namespace inkvizytor\FluentForm\Controls;

use inkvizytor\FluentForm\Renderers\BaseRenderer;

class Checkable extends Control
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
     * @param \inkvizytor\FluentForm\Renderers\BaseRenderer $renderer
     * @param string $type
     */
    public function __construct(BaseRenderer $renderer, $type = 'checkbox')
    {
        $this->type = $type;

        parent::__construct($renderer);
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
    public function render()
    {
        $content = null;
        $options = $this->getOptions();
        $attributes = array_only($options, 'class');
        
        if ($this->getType() == 'checkbox')
        {
            $content  = $this->always ? $this->getForm()->hidden($this->name, false) : '';
            $content .= $this->getForm()->checkbox($this->name, $this->value, $this->checked, array_except($options, 'class'));
        }
        else
        {
            $content = $this->getForm()->radio($this->name, $this->value, $this->checked, array_except($options, 'class'));
        }
        
        return '<label'.$this->getHtml()->attributes($attributes).'>'.$content.' '.$this->getLabel().'</label>';
    }
} 