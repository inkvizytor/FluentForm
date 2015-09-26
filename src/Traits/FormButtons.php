<?php namespace inkvizytor\FluentForm\Traits;

use inkvizytor\FluentForm\Controls\Button;
use inkvizytor\FluentForm\Controls\LinkButton;

/**
 * Class FormButtons
 *
 * @package inkvizytor\FluentForm\Traits
 */
trait FormButtons
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
        return (new Button($this->getRenderer()))->type($type)->name($name)->label($label)->value($value);
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
        return (new LinkButton($this->getRenderer()))->url($url)->label($label);
    }

    /**
     * @param $icon
     * @param string $url
     * @param string $label
     * @return \inkvizytor\FluentForm\Controls\LinkButton
     */
    public function icon($icon, $url, $label)
    {
        return (new LinkButton($this->getRenderer()))->icon($icon)->title($label)->url($url);
    }
}