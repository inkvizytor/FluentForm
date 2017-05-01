<?php namespace inkvizytor\FluentForm\Contracts;

/**
 * Interface IHasAttributes
 *
 * @package inkvizytor\FluentForm
 */
interface IHasAttributes
{
    /**
     * @param string $key
     * @param string|array $value
     * @return $this
     */
    public function attr($key, $value);

    /**
     * @param string $key
     * @return string|array
     */
    public function getAttr($key);

    /**
     * @param array $attr
     * @return $this
     */
    public function setAttr(array $attr);
}
