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
    protected $guarded = ['href', 'label', 'icon'];

    /** @var string */
    protected $href;

    /** @var string */
    protected $label;

    /** @var string */
    protected $icon;

    /** @var string */
    protected $title;

    /** @var string */
    protected $disabled;

    /**
     * @param string $href
     * @return $this
     */
    public function href($href)
    {
        $this->href = $href;

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
            $this->href = '#';
        }
        
        return '<a href="'.$this->href.'"'.$this->html()->attributes($this->getOptions()).'>'.$this->icon.$this->html()->encode($this->label).'</a>';
    }
} 