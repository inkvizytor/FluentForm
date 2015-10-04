<?php namespace inkvizytor\FluentForm\Specials;

use inkvizytor\FluentForm\Base\Fluent;

/**
 * Class DateTime
 *
 * @package inkvizytor\FluentForm\Specials
 */
class DateTime extends Fluent
{
    /** @var array */
    protected $guarded = ['time', 'value'];

    /** @var bool */
    protected $time;

    /** @var string */
    protected $value;
    
    /**
     * @param bool $time
     * @return $this
     */
    public function time($time = true)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @return bool
     */
    public function withTime()
    {
        return $this->time;
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
     * @return string
     */
    public function render()
    {
        return $this->getForm()->input('text', $this->name, $this->value, $this->getOptions());
    }
} 