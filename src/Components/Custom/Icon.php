<?php namespace inkvizytor\FluentForm\Components\Custom;

use inkvizytor\FluentForm\Base\Component;
use inkvizytor\FluentForm\Extensions\CssExtension;

/**
 * Class Icon
 *
 * @package inkvizytor\FluentForm
 */
class Icon extends Component 
{
    use CssExtension;
    
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
        $this->title = $this->root()->translator()->trans($label, $parameters, $domain, $locale);

        return $this;
    }
    
    /**
     * @return string
     */
    public function renderComponent()
    {
        //return $this->html()->tag('i', $this->getOptions(), '');
        return get_class($this);
    }
}
