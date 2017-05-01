<?php namespace inkvizytor\FluentForm\Contracts;

interface IHasCss extends IHasAttributes
{
    /**
     * @param string $class
     * @return bool
     */
    public function hasClass($class);

    /**
     * @param string $class
     * @return $this
     */
    public function addClass($class);

    /**
     * @param string $class
     * @return $this
     */
    public function removeClass($class);

    /**
     * @param array $css
     * @return $this
     */
    public function css($css);

    /**
     * @return array
     */
    public function getCss();
}
