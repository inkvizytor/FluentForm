<?php namespace inkvizytor\FluentForm\Traits;

use inkvizytor\FluentForm\Controls\Button;

/**
 * Class ButtonsContract
 *
 * @package inkvizytor\FluentForm
 * @method \inkvizytor\FluentForm\Contracts\IComponent parent()
 */
trait ButtonsContract
{
    /**
     * @param string $type
     * @param string $name
     * @param string $label
     * @param string $value
     * @return \inkvizytor\FluentForm\Controls\Button
     */
    private function pushable($type, $name, $label, $value = null)
    {
        return (new Button($this->parent()))->type($type)->name($name)->label($label)->value($value);
    }

    /**
     * @param string $name
     * @param string $label
     * @param string $value
     * @return \inkvizytor\FluentForm\Controls\Button
     */
    public function button($name, $label, $value = null)
    {
        return $this->pushable('button', $name, $label, $value);
    }

    /**
     * @param string $name
     * @param string $label
     * @param string $value
     * @return \inkvizytor\FluentForm\Controls\Button
     */
    public function submit($name, $label, $value = null)
    {
        return $this->pushable('submit', $name, $label, $value);
    }

    /**
     * @param string $name
     * @param string $label
     * @param string $value
     * @return \inkvizytor\FluentForm\Controls\Button
     */
    public function reset($name, $label, $value = null)
    {
        return $this->pushable('reset', $name, $label, $value);
    }
}
