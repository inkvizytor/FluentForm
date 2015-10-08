<?php namespace inkvizytor\FluentForm\Controls\Exclusive;

use inkvizytor\FluentForm\Base\Field;

/**
 * Class Editor
 *
 * @package inkvizytor\FluentForm\Specials
 */
class Editor extends Field
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
        $attributes = array_merge($this->getOptions(), ['name' => $this->name]);
        $value = $this->binder()->value($this->key($this->name), $this->value);

        return $this->html()->tag('textarea', $attributes, $this->html()->encode($value));
    }
} 