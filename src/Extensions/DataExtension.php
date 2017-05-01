<?php namespace inkvizytor\FluentForm\Extensions;

/**
 * Class DataExtension
 *
 * @package inkvizytor\FluentForm
 */
trait DataExtension
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
        if ($value !== null)
        {
            $this->data[$key] = $value;
        }
        elseif ($this->hasData($key))
        {
            unset($this->data[$key]);
        }

        return $this;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasData($key)
    {
        return array_key_exists($key, $this->data);
    }
    
    /**
     * @param string|null $key
     * @param string|null $default
     * @return array|string
     */
    public function getData($key = null, $default = null)
    {
        if ($key !== null)
        {
            return array_get($this->data, $key, $default);
        }
        else
        {
            return $this->data;
        }
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
     * @return array
     */
    public function getDataAttr()
    {
        $data = $this->getData();
        $keys = array_map(function ($key)
        {
            return 'data-' . $key;
        }, array_keys($data));
        
        return array_combine($keys, $data);
    }
}
