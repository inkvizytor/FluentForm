<?php namespace inkvizytor\FluentForm\Controls\Special;

use inkvizytor\FluentForm\Base\Fluent;

/**
 * Class Editor
 *
 * @package inkvizytor\FluentForm\Specials
 */
class Editor extends Fluent
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
        return $this->form()->textarea($this->name, $this->value, $this->getOptions());
    }
} 