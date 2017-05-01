<?php namespace inkvizytor\FluentForm\Extensions;

/**
 * Class AttributesExtension
 *
 * @package inkvizytor\FluentForm
 */
trait AttributesExtension
{
    /** @var array */
    protected $attributes = [];

    /**
     * @param string $key
     * @param string|array $value
     * @return $this
     */
    public function attr($key, $value)
    {
        if ($value !== null)
        {
            $this->attributes[$key] = $value;
        }
        elseif ($this->hasAttr($key))
        {
            unset($this->attributes[$key]);
        }

        return $this;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasAttr($key)
    {
        return array_key_exists($key, $this->attributes);
    }
    
    /**
     * @param string|null $key
     * @return string|array
     */
    public function getAttr($key = null)
    {
        if ($key !== null)
        {
            return array_get($this->attributes, $key);
        }
        else
        {
            return $this->attributes;
        }
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function setAttr(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }
}
