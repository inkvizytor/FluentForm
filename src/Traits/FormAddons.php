<?php namespace inkvizytor\FluentForm\Traits;

use inkvizytor\FluentForm\Controls\ButtonGroup;
use inkvizytor\FluentForm\Controls\Checkable;
use inkvizytor\FluentForm\Controls\FormFooter;
use inkvizytor\FluentForm\Controls\FormGroup;
use inkvizytor\FluentForm\Controls\FormTabs;
use inkvizytor\FluentForm\Controls\Input;

/**
 * Class FormAddons
 *
 * @package inkvizytor\FluentForm\Traits
 */
trait FormAddons
{
    /**
     * @param string $name
     * @param string $value
     * @return string
     */
    public function hidden($name, $value = null)
    {
        return (new Input($this->getRenderer()))->type('hidden')->name($name)->value($value)->display();
    }

    /**
     * @param string $name
     * @param int|mixed $value
     * @param bool $checked
     * @return \inkvizytor\FluentForm\Controls\Checkable
     */
    public function radio($name, $value = true, $checked = null)
    {
        return (new Checkable($this->getRenderer(), 'radio'))->name($name)->value($value)->checked($checked);
    }

    /**
     * @return \inkvizytor\FluentForm\Controls\FormGroup
     */
    public function group()
    {
        return (new FormGroup($this->getRenderer()));
    }

    /**
     * @param array $buttons
     * @return \inkvizytor\FluentForm\Controls\ButtonGroup
     */
    public function buttons(array $buttons)
    {
        return (new ButtonGroup($this->getRenderer()))->buttons($buttons);
    }

    /**
     * @param array $buttons
     * @return \inkvizytor\FluentForm\Controls\FormFooter
     */
    public function footer(array $buttons = [])
    {
        return (new FormFooter($this->getRenderer()))->buttons($buttons);
    }

    /**
     * @return \inkvizytor\FluentForm\Controls\FormTabs
     */
    public function tabs()
    {
        return (new FormTabs($this->getRenderer()));
    }
}