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
    abstract public function setRules($rules);

    /**
     * @param string $name
     * @param string $label
     * @return array
     */
    abstract public function getOptions($name, $label);
}