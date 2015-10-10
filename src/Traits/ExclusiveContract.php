<?php namespace inkvizytor\FluentForm\Traits;

use inkvizytor\FluentForm\Controls\Exclusive\DateTime;
use inkvizytor\FluentForm\Controls\Exclusive\Editor;

/**
 * Class ExclusiveContract
 *
 * @package inkvizytor\FluentForm
 */
trait ExclusiveContract
{
    /**
     * @param string $name
     * @param string $value
     * @return \inkvizytor\FluentForm\Controls\Exclusive\DateTime
     */
    public function datetime($name, $value = null)
    {
        return (new DateTime($this->handler()))->name($name)->value($value)->time(false);
    }

    /**
     * @param string $name
     * @param string $value
     * @return \inkvizytor\FluentForm\Controls\Exclusive\Editor
     */
    public function editor($name, $value = null)
    {
        return (new Editor($this->handler()))->name($name)->value($value);
    }
}