<?php namespace inkvizytor\FluentForm\Traits;

use inkvizytor\FluentForm\Controls\Special\DateTime;
use inkvizytor\FluentForm\Controls\Special\Editor;

/**
 * Class SpecialsContract
 *
 * @package inkvizytor\FluentForm\Traits
 */
trait SpecialsContract
{
    /**
     * @param string $name
     * @param string $value
     * @return \inkvizytor\FluentForm\Controls\Special\DateTime
     */
    public function datetime($name, $value = null)
    {
        return (new DateTime($this->handler()))->name($name)->value($value)->time(false);
    }

    /**
     * @param string $name
     * @param string $value
     * @return \inkvizytor\FluentForm\Controls\Special\Editor
     */
    public function editor($name, $value = null)
    {
        return (new Editor($this->handler()))->name($name)->value($value);
    }
}