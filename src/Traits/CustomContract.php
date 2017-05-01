<?php namespace inkvizytor\FluentForm\Traits;

use inkvizytor\FluentForm\Base\Field;

/**
 * Class CustomContract
 *
 * @package inkvizytor\FluentForm
 * @method \inkvizytor\FluentForm\Contracts\IComponent parent()
 */
trait CustomContract
{
    /**
     * @param string $name
     * @param array $arguments
     * @return Field
     */
    public function __call($name, $arguments)
    {
        array_unshift($arguments, $this->parent());
        
        return app()->make(config('fluentform.controls.'.$name), $arguments);
    }
}