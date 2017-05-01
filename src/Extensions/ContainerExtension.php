<?php namespace inkvizytor\FluentForm\Extensions;

use Illuminate\Support\Collection;
use inkvizytor\FluentForm\Contracts\IComponent;

trait ContainerExtension
{
    /** @var \Illuminate\Support\Collection|\inkvizytor\FluentForm\Contracts\IComponent[] */
    protected $controls;

    /**
     * @param \inkvizytor\FluentForm\Contracts\IComponent $control
     * @return $this
     */
    public function addComponent(IComponent $control)
    {
        if ($this->controls == null)
        {
            $this->controls = new Collection();
        }
        
        $this->controls->push($control);

        return $this;
    }
}
