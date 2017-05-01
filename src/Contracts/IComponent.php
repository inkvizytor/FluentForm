<?php namespace inkvizytor\FluentForm\Contracts;

/**
 * Interface IComponent
 *
 * @package inkvizytor\FluentForm
 */
interface IComponent extends IHasAttributes, IHasData
{
    /**
     * @param string $id
     * @return $this
     */
    public function id($id);

    /**
     * @param string $name
     * @return $this
     */
    public function name($name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getKey();
    
    /**
     * @return \inkvizytor\FluentForm\Contracts\IComponent
     */
    public function parent();

    /**
     * @return \inkvizytor\FluentForm\Base\RootComponent
     */
    public function root();

    /**
     * @return string
     */
    public function render();

    /**
     * @return string
     */
    public function display();

    /**
     * @return string
     */
    public function __toString();
}
