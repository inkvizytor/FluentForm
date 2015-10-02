<?php namespace inkvizytor\FluentForm\Traits;

use inkvizytor\FluentForm\Specials\DateTime;
use inkvizytor\FluentForm\Specials\Editor;

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
     * @return \inkvizytor\FluentForm\Specials\DateTime
     */
    public function datetime($name, $value = null)
    {
        return (new DateTime($this->getRenderer()))->name($name)->value($value)->time(false);
    }

    /**
     * @param string $name
     * @param string $value
     * @return \inkvizytor\FluentForm\Specials\Editor
     */
    public function editor($name, $value = null)
    {
        return (new Editor($this->getRenderer()))->name($name)->value($value);
    }
}