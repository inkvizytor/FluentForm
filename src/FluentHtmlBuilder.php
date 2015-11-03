<?php namespace inkvizytor\FluentForm;

use inkvizytor\FluentForm\Components\ButtonGroup;
use inkvizytor\FluentForm\Components\Icon;
use inkvizytor\FluentForm\Components\LinkButton;
use inkvizytor\FluentForm\Components\Panel;
use inkvizytor\FluentForm\Components\TabStrip;
use inkvizytor\FluentForm\Renderers\Base as BaseRenderer;

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
        $this->handler()->setRenderer($renderer);
    }

    /**
     * @return \inkvizytor\FluentForm\Components\TabStrip
     */
    public function tabs()
    {
        return (new TabStrip($this->handler()));
    }

    /**
     * @return \inkvizytor\FluentForm\Components\Panel
     */
    public function panel()
    {
        return (new Panel($this->handler()));
    }
    
    /**
     * @param array $buttons
     * @return \inkvizytor\FluentForm\Components\ButtonGroup
     */
    public function buttons(array $buttons)
    {
        return (new ButtonGroup($this->handler()))->buttons($buttons);
    }

    /**
     * @param string $url
     * @param string $label
     * @return \inkvizytor\FluentForm\Components\LinkButton
     */
    public function link($url, $label)
    {
        return (new LinkButton($this->handler()))->href($url)->label($label);
    }

    /**
     * @param string|array $icons
     * @return \inkvizytor\FluentForm\Components\Icon
     */
    public function icon($icons)
    {
        return (new Icon($this->handler()))->css(is_array($icons) ? $icons : func_get_args());
    }

    /**
     * @param $icon
     * @param string $url
     * @param string $label
     * @return \inkvizytor\FluentForm\Components\LinkButton
     */
    public function iconlink($icon, $url, $label)
    {
        return $this->link($url, '')->icon($icon)->title($label);
    }
} 