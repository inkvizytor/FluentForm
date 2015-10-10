<?php namespace inkvizytor\FluentForm\Controls;

use inkvizytor\FluentForm\Base\Field;

/**
 * Class Textarea
 *
 * @package inkvizytor\FluentForm\Controls
 */
class Textarea extends Field
{
    /** @var array */
    protected $guarded = ['value'];

    /** @var int */
    protected $rows = 10;
    
    /** @var string */
    protected $value;

    /**
     * @param string $config
     * @return $this
     */
    public function value($config)
    {
        $this->value = $config;

        return $this;
    }

    /**
     * @param string $rows
     * @return $this
     */
    public function rows($rows)
    {
        $this->rows = $rows;

        return $this;
    }
    
    /**
     * @return string
     */
    public function render()
    {
        $attributes = array_merge($this->getOptions(), ['name' => $this->name]);
        $value = $this->binder()->value($this->key($this->name), $this->value);
        
        return $this->html()->tag('textarea', $attributes, $this->html()->encode($value));
    }
} 