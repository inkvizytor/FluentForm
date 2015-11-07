<?php namespace inkvizytor\FluentForm\Components;

use inkvizytor\FluentForm\Base\Control;
use inkvizytor\FluentForm\Traits\CssContract;

class Icon extends Control
{
    use CssContract;
    
    /** @var string */
    protected $title;
    
    /**
     * @param string $label
     * @param array $parameters
     * @param string $domain
     * @param string|null $locale
     * @return $this
     */
    public function title($label, array $parameters = [], $domain = 'messages', $locale = null)
    {
        $this->title = $this->translator()->trans($label, $parameters, $domain, $locale);

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