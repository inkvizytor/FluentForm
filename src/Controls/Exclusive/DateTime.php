<?php namespace inkvizytor\FluentForm\Controls\Exclusive;

use inkvizytor\FluentForm\Base\Field;

/**
 * Class DateTime
 *
 * @package inkvizytor\FluentForm
 */
class DateTime extends Field
{
    /** @var array */
    protected $guarded = ['time', 'value', 'config'];

    /** @var bool */
    protected $time;

    /** @var bool */
    protected $timeOnly;

    /** @var string */
    protected $value;

    /** @var array */
    protected $config = [];

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
     * @param bool $time
     * @return $this
     */
    public function timeOnly($timeOnly = true)
    {
        $this->timeOnly = $timeOnly;

        return $this;
    }

    /**
     * @return bool
     */
    public function withTimeOnly()
    {
        return $this->timeOnly;
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
     * @param array $config
     * @return $this
     */
    public function config(array $config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        $format = $this->withTime() ? 'YYYY-MM-DD HH:mm:ss' : 'YYYY-MM-DD';

        $this->data('toggle', 'datetimepicker');
        $this->data('config', array_merge(config('fluentform.datetimepicker'), [
            'format' => $format,
            'locale' => app()->getLocale()
        ], $this->config));

        return $this->html()->tag('input', array_merge($this->getOptions(), [
            'type' => $this->timeOnly ? 'time' : ($this->withTime() ? 'datetime' : 'date'),
            'name' => $this->name,
            'value' => $this->binder()->value($this->key($this->name), $this->value)
        ]));
    }
} 
