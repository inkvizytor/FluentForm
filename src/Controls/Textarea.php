<?php namespace inkvizytor\FluentForm\Controls;

use inkvizytor\FluentForm\Base\ViewComponent;

/**
 * Class Textarea
 *
 * @package inkvizytor\FluentForm
 */
class Textarea extends ViewComponent 
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
    public function renderComponent()
    {
        $attributes = array_merge($this->getAttr(), $this->getDataAttr(), ['name' => $this->getName()]);
        $value = $this->root()->binder()->value($this->getKey(), $this->value);

        return $this->root()->html()->tag('textarea', $attributes, $this->root()->html()->encode($value));
    }
}
