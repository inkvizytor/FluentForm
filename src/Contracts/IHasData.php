<?php namespace inkvizytor\FluentForm\Contracts;

interface IHasData extends IHasAttributes 
{
    /**
     * @param string $key
     * @param string|array $value
     * @return $this
     */
    public function data($key, $value);

    /**
     * @param string $key
     * @param string|null $default
     * @return array|string
     */
    public function getData($key, $default = null);

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data);
}
