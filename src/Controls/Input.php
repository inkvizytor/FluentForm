<?php namespace inkvizytor\FluentForm\Controls;

use inkvizytor\FluentForm\Base\Field;

/**
 * Class Input
 *
 * @package inkvizytor\FluentForm
 */
class Input extends Field
{
    /** @var array */
    protected $guarded = ['type', 'value'];

    /** @var string */
    protected $type;
    
    /** @var string */
    protected $value;

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
     * @param string $type
     * @return $this
     */
    public function type($type)
    {
        $this->type = $type;

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
     * @return string
     */
    public function render()
    {
        return $this->html()->tag('input', array_merge($this->getOptions(), [
            'type' => $this->type,
            'name' => $this->name,
            'value' => $this->binder()->value($this->key($this->name), $this->value)
        ]));
    }
} 