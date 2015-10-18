<?php namespace inkvizytor\FluentForm\Traits;

use inkvizytor\FluentForm\Components\InputGroup;

trait AddonsContract
{
    /** @var \inkvizytor\FluentForm\Components\InputGroup */
    protected $inputGroup;

    /** @var \inkvizytor\FluentForm\Renderers\Base */
    protected $renderer;

    /**
     * Create copy of the original renderer object.
     */
    protected function backupRenderer()
    {
        $this->renderer = clone $this->renderer();
    }
    
    /**
     * @return \inkvizytor\FluentForm\Components\InputGroup
     */
    protected function inputGroup()
    {
        if ($this->inputGroup == null)
        {
            $this->inputGroup = new InputGroup($this->handler());
        }

        return $this->inputGroup;
    }

    /**
     * @param mixed $addon
     * @return $this
     */
    public function prepend($addon)
    {
        $this->inputGroup()->prepend($addon);

        return $this;
    }

    /**
     * @param mixed $addon
     * @return $this
     */
    public function append($addon)
    {
        $this->inputGroup()->append($addon);

        return $this;
    }

    /**
     * @return string
     */
    public function display()
    {
        if ($this->inputGroup != null)
        {
            $group = $this->inputGroup;
            $group->control($this);

            $this->inputGroup = null;

            return $this->renderer
                ->bindControl($group)
                ->display();
        }

        return parent::display();
    }
}