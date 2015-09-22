<?php namespace inkvizytor\FluentForm\Traits;

/**
 * Class AttrContainer
 *
 * @package inkvizytor\FluentForm\Traits
 */
trait AttrContainer
{
    /** @var array */
    protected $attr = [];

    /**
     * @param string $key
     * @param string|array $value
     * @return $this
     */
    public function attr($key, $value)
    {
        $this->attr[$key] = $value;

        return $this;
    }

    /**
     * @param string $key
     * @return string|array
     */
    public function getAttr($key)
    {
        return array_get($this->attr, $key);
    }

    /**
     * @param array $options
     */
    protected function appendAttributes(&$options)
    {
        foreach ($this->attr as $key => $value)
        {
            array_set($options, $key, is_array($value) ? json_encode($value) : $value);
        }
    }
} 