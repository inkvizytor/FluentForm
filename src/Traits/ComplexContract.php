<?php namespace inkvizytor\FluentForm\Traits;

use inkvizytor\FluentForm\Components\Complex\DateTime;
use inkvizytor\FluentForm\Components\Complex\DateTimeRange;
use inkvizytor\FluentForm\Components\Complex\Editor;

/**
 * Class ComplexContract
 *
 * @package inkvizytor\FluentForm
 * @method \inkvizytor\FluentForm\Contracts\IComponent parent()
 */
trait ComplexContract
{
    /**
     * @param string $name
     * @param string $value
     * @return \inkvizytor\FluentForm\Components\Complex\DateTime
     */
    public function datetime($name, $value = null)
    {
        return (new DateTime($this->parent()))->name($name)->value($value)->time(false);
    }

    /**
     * @param string $name
     * @param string $value
     * @return \inkvizytor\FluentForm\Components\Complex\DateTimeRange
     */
    public function datetimerange($name, $value = null)
    {
        return (new DateTimeRange($this->parent()))->name($name)->value($value)->time(false);
    }

    /**
     * @param string $name
     * @param string $value
     * @return \inkvizytor\FluentForm\Components\Complex\Editor
     */
    public function editor($name, $value = null)
    {
        return (new Editor($this->parent()))->name($name)->value($value);
    }
}