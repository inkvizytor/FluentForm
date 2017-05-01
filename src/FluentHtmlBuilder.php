<?php namespace inkvizytor\FluentForm;

use inkvizytor\FluentForm\Components\Custom\ButtonGroup;
use inkvizytor\FluentForm\Components\Custom\Icon;
use inkvizytor\FluentForm\Components\Custom\LinkButton;
use inkvizytor\FluentForm\Components\Custom\Panel;
use inkvizytor\FluentForm\Components\Custom\TabStrip;

/**
 * Class FluentHtmlBuilder
 *
 * @package inkvizytor\FluentForm
 */
class FluentHtmlBuilder extends FluentBuilder
{
    /**
     * @return string
     */
    public function styles()
    {
        return view('fluentform::styles')->render();
    }

    /**
     * @param bool|null $cdn
     * @return string
     */
    public function scripts($cdn = null)
    {
        return view('fluentform::scripts', ['cdn' => $cdn])->render();
    }

    /**
     * @param string $renderer
     */
    public function renderer($renderer)
    {
        $this->root()->setRenderer($renderer);
    }

    /**
     * @return \inkvizytor\FluentForm\Components\Custom\TabStrip
     */
    public function tabs()
    {
        return (new TabStrip($this->root()));
    }

    /**
     * @return \inkvizytor\FluentForm\Components\Custom\Panel
     */
    public function panel()
    {
        return (new Panel($this->root()));
    }
    
    /**
     * @param array $buttons
     * @return \inkvizytor\FluentForm\Components\Custom\ButtonGroup
     */
    public function buttons(array $buttons)
    {
        return (new ButtonGroup($this->root()))->buttons($buttons);
    }

    /**
     * @param string $url
     * @param string $label
     * @return \inkvizytor\FluentForm\Components\Custom\LinkButton
     */
    public function link($url, $label)
    {
        return (new LinkButton($this->root()))->href($url)->label($label);
    }

    /**
     * @param string|array $icons
     * @return \inkvizytor\FluentForm\Components\Custom\Icon
     */
    public function icon($icons)
    {
        return (new Icon($this->root()))->css(is_array($icons) ? $icons : func_get_args());
    }

    /**
     * @param $icon
     * @param string $url
     * @param string $label
     * @return \inkvizytor\FluentForm\Components\Custom\LinkButton
     */
    public function iconlink($icon, $url, $label)
    {
        return $this->link($url, '')->icon($icon)->title($label);
    }
}
