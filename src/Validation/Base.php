<?php namespace inkvizytor\FluentForm\Validation;

/**
 * Class Base
 *
 * @package inkvizytor\FluentForm
 */
abstract class Base
{
    /**
     * @param array $rules
     */
    public abstract function setRules($rules);

    /**
     * @param string $name
     * @param string $label
     * @return array
     */
    public abstract function getOptions($name, $label);
}