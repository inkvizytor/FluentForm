<?php namespace inkvizytor\FluentForm\Controls;

use inkvizytor\FluentForm\Base\Field;
use inkvizytor\FluentForm\Base\Handler;

/**
 * Class Checkable
 *
 * @package inkvizytor\FluentForm
 */
class Checkable extends Field
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
     * @param \inkvizytor\FluentForm\Base\Handler $handler
     * @param string $type
     */
    public function __construct(Handler $handler, $type = 'checkbox')
    {
        parent::__construct($handler);

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
    public function render()
    {
        $content = null;
        $options = $this->getOptions();
        $attributes = array_only($options, 'class');
        
        if ($this->getType() == 'checkbox')
        {
            $content  = $this->always ? $this->html()->tag('input', [
                'type' => 'hidden', 
                'name' => $this->name, 
                'value' => false
            ]) : '';
            
            $content .= $this->html()->tag('input', array_merge(array_except($options, 'class'), [
                'type' => 'checkbox', 
                'name' => $this->name, 
                'value' => $this->value !== null ? $this->value : 1, 
                'checked' => $this->binder()->checked($this->key($this->name), $this->value, $this->checked)
            ]));
        }
        else
        {
            $content = $this->html()->tag('input', array_merge(array_except($options, 'class'), [
                'type' => 'radio',
                'name' => $this->name,
                'value' => $this->value !== null ? $this->value : $this->name,
                'checked' => $this->binder()->checked($this->key($this->name), $this->value, $this->checked)
            ]));
        }

        $content .= config('fluentform.checkable.span') ? $this->html()->tag('span', [], '') : '';
        
        if (!empty($this->getLabel()))
        {
            return $this->html()->tag('label', $attributes, $content.' '.$this->getLabel());
        }
        
        return $content;
    }
} 