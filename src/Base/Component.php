<?php namespace inkvizytor\FluentForm\Base;

use Illuminate\Support\Collection;
use inkvizytor\FluentForm\Contracts\IComponent;
use inkvizytor\FluentForm\Extensions\AttributesExtension;
use inkvizytor\FluentForm\Extensions\DataExtension;

/**
 * Class Component
 *
 * @package inkvizytor\FluentForm
 */
abstract class Component implements IComponent
{
    use AttributesExtension, DataExtension;
    
    /** @var \inkvizytor\FluentForm\Contracts\IComponent $element */
    protected $parent;
    
    /**
     * Component constructor.
     *
     * @param \inkvizytor\FluentForm\Contracts\IComponent $component
     */
    public function __construct(IComponent $component)
    {
        $this->parent = $component;
    }

    /**
     * @param \inkvizytor\FluentForm\Contracts\IComponent $component
     * @return $this
     */
    public function setParent(IComponent $component)
    {
        $this->parent = $component;

        return $this;
    }

    // ---------- IComponent interface ----------

    /**
     * @param string $id
     * @return $this
     */
    public function id($id)
    {
        $this->attr('id', $id);

        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function name($name)
    {
        $this->attr('name', $name);

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getAttr('name');
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->root()->html()->key($this->getName());
    }

    /**
     * @return \inkvizytor\FluentForm\Contracts\IComponent
     */
    public function parent()
    {
        return $this->parent;
    }

    /**
     * @return \inkvizytor\FluentForm\Base\RootComponent
     */
    public function root()
    {
        return $this->parent()->root();
    }

    /**
     * Renderuje kontrolkę z wykorzystaniem wybranego renderera
     *
     * @return string
     */
    public function render()
    {
        return $this->root()->renderer()->renderComponent($this);
    }

    /**
     * Renderuje kontrolkę i wszystkie nadrzędne z wykorzystaniem wybranego renderera
     *
     * @return string
     */
    public function display()
    {
        if ($this->parent() == $this->root())
        {
            return $this->render();
        }
        
        return $this->parent()->display();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->display();
    }

    /**
     * @return string
     */
    abstract public function renderComponent();
}
