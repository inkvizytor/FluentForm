<?php namespace inkvizytor\FluentForm\Controls;

class Editor extends Control
{
    /** @var array */
    protected $guarded = ['value'];

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
     * @return string
     */
    public function render()
    {
        return $this->getForm()->textarea($this->name, $this->value, $this->getOptions());
    }
} 