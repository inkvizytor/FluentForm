<?php namespace inkvizytor\FluentForm\Components\Custom;

use inkvizytor\FluentForm\Base\Component;
use inkvizytor\FluentForm\Extensions\CssExtension;

/**
 * Class Footer
 *
 * @package inkvizytor\FluentForm
 */
class Footer extends Component 
{
    use CssExtension;
    
    /** @var array */
    protected $buttons;
    
    /**
     * @param array $buttons
     * @return $this
     */
    public function buttons($buttons)
    {
        $this->buttons = $buttons;

        return $this;
    }

    /**
     * @param \inkvizytor\FluentForm\Base\Component $button
     * @param bool $enabled
     * @return $this
     */
    public function add(Component $button, $enabled = true)
    {
        if ($enabled == true)
        {
            $this->buttons[] = $button;
        }

        return $this;
    }
    
    /**
     * @return string
     */
    public function renderComponent()
    {
        //return $this->html()->tag('div', $this->getOptions(), implode(' ', $this->buttons));
        return get_class($this);
    }
}
