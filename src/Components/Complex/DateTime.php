<?php namespace inkvizytor\FluentForm\Components\Complex;

use inkvizytor\FluentForm\Base\ViewComponent;

/**
 * Class DateTime
 *
 * @package inkvizytor\FluentForm
 */
class DateTime extends ViewComponent 
{
    /** @var array */
    protected $guarded = ['time', 'value', 'config'];

    /** @var bool */
    protected $time;

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
    public function renderComponent()
    {
        $format = $this->withTime() ? 'YYYY-MM-DD HH:mm:ss' : 'YYYY-MM-DD';

        $this->data('toggle', 'datetimepicker');
        $this->data('config', array_merge(config('fluentform.datetimepicker'), $this->config, [
            'format' => $format,
            'locale' => app()->getLocale()
        ]));

        return $this->root()->html()->tag('input', array_merge($this->getAttr(), $this->getDataAttr(), [
            'type' => $this->withTime() ? 'datetime' : 'date',
            'name' => $this->getName(),
            'value' => $this->root()->binder()->value($this->getKey(), $this->value)
        ]));
    }
}
