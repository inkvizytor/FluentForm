<?php namespace inkvizytor\FluentForm\Components;

use inkvizytor\FluentForm\Base\Control;
use inkvizytor\FluentForm\Traits\CssContract;

/**
 * Class Icon
 *
 * @package inkvizytor\FluentForm
 */
class Icon extends Control
{
    use CssContract;
    
    /** @var string */
    protected $title;
    
    /**
     * @param string $label
     * @param array $parameters
     * @param string|null $locale
     * @return $this
     */
    public function title($label, array $parameters = [], $locale = null)
    {
        $this->title = $this->translator()->get($label, $parameters, $locale);

        return $this;
    }
    
    /**
     * @return string
     */
    public function render()
    {
        return $this->html()->tag('i', $this->getOptions(), '');
    }
}