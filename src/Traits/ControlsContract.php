<?php namespace inkvizytor\FluentForm\Traits;

use inkvizytor\FluentForm\Controls\Checkable;
use inkvizytor\FluentForm\Controls\CheckableList;
use inkvizytor\FluentForm\Controls\Content;
use inkvizytor\FluentForm\Controls\Input;
use inkvizytor\FluentForm\Controls\Select;
use inkvizytor\FluentForm\Controls\Textarea;

/**
 * Class ControlsContract
 *
 * @package inkvizytor\FluentForm
 */
trait ControlsContract
{
    /**
     * @param string $type
     * @param string $name
     * @param string $value
     * @return \inkvizytor\FluentForm\Controls\Input
     */
    public function input($type, $name, $value = null)
    {
        return (new Input($this->handler()))->type($type)->name($name)->value($value);
    }

    /**
     * @param string $name
     * @param string $value
     * @return \inkvizytor\FluentForm\Controls\Input
     */
    public function text($name, $value = null)
    {
        return $this->input('text', $name, $value);
    }

    /**
     * @param string $name
     * @return \inkvizytor\FluentForm\Controls\Input
     */
    public function password($name)
    {
        return $this->input('password', $name);
    }

    /**
     * @param string $name
     * @return \inkvizytor\FluentForm\Controls\Input
     */
    public function file($name)
    {
        return $this->input('file', $name);
    }

    /**
     * @param string $name
     * @param string $value
     * @return \inkvizytor\FluentForm\Controls\Textarea
     */
    public function textarea($name, $value = null)
    {
        return (new Textarea($this->handler()))->name($name)->value($value)->rows(5);
    }

    /**
     * @param string $name
     * @param array $items
     * @param int|string $selected
     * @return \inkvizytor\FluentForm\Controls\Select
     */
    public function select($name, array $items, $selected = null)
    {
        return (new Select($this->handler()))->name($name)->items($items)->selected($selected);
    }

    /**
     * @param string $name
     * @param int|mixed $value
     * @param bool $checked
     * @return \inkvizytor\FluentForm\Controls\Checkable
     */
    public function checkbox($name, $value = 1, $checked = null)
    {
        return (new Checkable($this->handler(), 'checkbox'))->name($name)->value($value)->checked($checked)->always(true);
    }

    /**
     * @param string $name
     * @param array $items
     * @param array $checked
     * @return \inkvizytor\FluentForm\Controls\CheckableList
     */
    public function checkboxes($name, array $items, array $checked = [])
    {
        return (new CheckableList($this->handler(), 'checkbox'))->name($name)->items($items)->checked($checked);
    }

    /**
     * @param string $name
     * @param array $items
     * @param int|string $checked
     * @return \inkvizytor\FluentForm\Controls\CheckableList
     */
    public function radios($name, array $items, $checked = null)
    {
        return (new CheckableList($this->handler(), 'radio'))->name($name)->items($items)->checked($checked);
    }

    /**
     * @param string $content
     * @return \inkvizytor\FluentForm\Controls\Content
     */
    public function content($content)
    {
        return (new Content($this->handler()))->content($content);
    }
}