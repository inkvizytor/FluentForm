<?php namespace inkvizytor\FluentForm\Components\Custom;

use inkvizytor\FluentForm\Base\Component;
use inkvizytor\FluentForm\Extensions\CssExtension;
use inkvizytor\FluentForm\Extensions\DataExtension;

/**
 * Class LinkButton
 *
 * @package inkvizytor\FluentForm
 */
class LinkButton extends Component 
{
    use CssExtension, DataExtension;
    
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
     * @param array $parameters
     * @param string $domain
     * @param string|null $locale
     * @return $this
     */
    public function label($label, array $parameters = [], $domain = 'messages', $locale = null)
    {
        $this->label = $this->root()->translator()->trans($label, $parameters, $domain, $locale);

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
     * @param string $label
     * @param array $parameters
     * @param string $domain
     * @param string|null $locale
     * @return $this
     */
    public function title($label, array $parameters = [], $domain = 'messages', $locale = null)
    {
        $this->title = $this->root()->translator()->trans($label, $parameters, $domain, $locale);

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
    public function renderComponent()
    {
//        if ($this->disabled)
//        {
//            $this->href = '#';
//        }
//
//        $attributes = array_merge($this->getOptions(), ['href' => $this->href]);
//        
//        return $this->html()->tag('a', $attributes, $this->icon.$this->html()->encode($this->label));
        return get_class($this);
    }
}
