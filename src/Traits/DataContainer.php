<?php namespace inkvizytor\FluentForm\Traits;

/**
 * Class DataContainer
 *
 * @package inkvizytor\FluentForm\Traits
 */
trait DataContainer
{
    /** @var array */
    protected $data = [];

    /**
     * @param string $key
     * @param string|array $value
     * @return $this
     */
    public function data($key, $value)
    {
        $this->data[$key] = $value;

        return $this;
    }

    /**
     * @param string $key
     * @param string|null $default
     * @return array|string
     */
    public function getData($key, $default = null)
    {
        if ($key !== null)
            return array_get($this->data, $key, $default);
        else
            return $this->data;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }
    
    /**
     * @param array $options
     */
    protected function appendDataAttributes(&$options)
    {
        foreach ($this->data as $key => $value)
        {
            array_set($options, "data-$key", is_array($value) ? json_encode($value) : $value);
        }
    }
} 