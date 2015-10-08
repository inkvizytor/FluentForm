<?php namespace inkvizytor\FluentForm\Controls\Exclusive;

use inkvizytor\FluentForm\Base\Field;

/**
 * Class DateTime
 *
 * @package inkvizytor\FluentForm\Specials
 */
class DateTime extends Field
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
        return $this->html()->tag('input', array_merge($this->getOptions(), [
            'type' => 'text',
            'name' => $this->name,
            'value' => $this->binder()->value($this->key($this->name), $this->value)
        ]));
    }
} 