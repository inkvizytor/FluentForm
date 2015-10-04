<?php namespace inkvizytor\FluentForm\Controls;

use inkvizytor\FluentForm\Base\Control;
use inkvizytor\FluentForm\Traits\CssContract;
use inkvizytor\FluentForm\Traits\DataContract;

/**
 * Class LinkButton
 *
 * @package inkvizytor\FluentForm\Controls
 */
class LinkButton extends Control
{
    use CssContract, DataContract;
    
    /** @var array */
    protected $guarded = ['url', 'label', 'icon'];

    /** @var string */
    protected $url;

    /** @var string */
    protected $label;

    /** @var string */
    protected $icon;

    /** @var string */
    protected $title;

    /** @var string */
    protected $disabled;

    /**
     * @param string $url
     * @return $this
     */
    public function url($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param string $label
     * @return $this
     */
    public function label($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @param string $icon
     * @return $this
     */
    public function icon($icon)
    {
        $this->icon = !empty($icon) ? '<i class="'.$icon.'"></i> ' : '';

        return $this;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function title($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function disabled($value = true)
    {
        $this->disabled = $value ? 'disabled' : null;

        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        if ($this->disabled)
        {
            $this->url = '#';
        }
        
        return '<a href="'.$this->url.'"'.$this->getHtml()->attributes($this->getOptions()).'>'.$this->icon.$this->getHtml()->entities($this->label).'</a>';
    }
} 