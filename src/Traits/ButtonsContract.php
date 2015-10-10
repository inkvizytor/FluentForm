<?php namespace inkvizytor\FluentForm\Traits;

use inkvizytor\FluentForm\Controls\Button;
use inkvizytor\FluentForm\Controls\LinkButton;

/**
 * Class ButtonsContract
 *
 * @package inkvizytor\FluentForm
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
        return (new Button($this->handler()))->type($type)->name($name)->label($label)->value($value);
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

    /**
     * @param string $url
     * @param string $label
     * @return \inkvizytor\FluentForm\Controls\LinkButton
     */
    public function link($url, $label)
    {
        return (new LinkButton($this->handler()))->href($url)->label($label);
    }

    /**
     * @param $icon
     * @param string $url
     * @param string $label
     * @return \inkvizytor\FluentForm\Controls\LinkButton
     */
    public function icon($icon, $url, $label)
    {
        return $this->link($url, '')->icon($icon)->title($label);
    }
}