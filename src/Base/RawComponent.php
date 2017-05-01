<?php namespace inkvizytor\FluentForm\Base;

use inkvizytor\FluentForm\Contracts\IComponent;

/**
 * Class RawComponent
 *
 * @package inkvizytor\FluentForm
 */
class RawComponent extends Component 
{
    /** @var string */
    protected $content;

    /**
     * RawComponent constructor.
     *
     * @param \inkvizytor\FluentForm\Contracts\IComponent $component
     * @param string $content
     */
    public function __construct(IComponent $component, $content)
    {
        parent::__construct($component);
        
        $this->content = $content;
    }
}
