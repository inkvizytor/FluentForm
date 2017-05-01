<?php namespace inkvizytor\FluentForm\Components\Custom;

use inkvizytor\FluentForm\Base\Component;
use inkvizytor\FluentForm\Exception;
use inkvizytor\FluentForm\Extensions\CssExtension;

/**
 * Class TabStrip
 *
 * @package inkvizytor\FluentForm
 */
class TabStrip extends Component 
{
    use CssExtension;

    const TABS_OPEN = 'tabs:open';
    const TABS_CLOSE = 'tabs:close';
    const PANEL_BEGIN = 'panel:begin';
    const PANEL_END = 'panel:end';
    
    /** @var int */
    static protected $counter = 0;

    /** @var array */
    static protected $active = [];
    
    /** @var string */
    protected $mode = self::TABS_OPEN;
    
    /** @var array  */
    protected $tabs = [];

    /** @var string */
    protected $name = null;
    
    /** @var bool */
    protected $pills = null;

    /** @var bool */
    protected $justified = null;

    /**
     * @param bool $pills
     * @return $this
     */
    public function pills($pills = true)
    {
        $this->pills = $pills;

        return $this;
    }

    /**
     * @return bool
     */
    public function isPills()
    {
        return $this->pills;
    }

    /**
     * @param bool $justified
     * @return $this
     */
    public function justified($justified = true)
    {
        $this->justified = $justified;

        return $this;
    }

    /**
     * @return bool
     */
    public function isJustified()
    {
        return $this->justified;
    }
    
    /**
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param string $name
     * @param string $label
     * @param bool $active
     * @param bool $enabled
     * @return $this
     * @throws \inkvizytor\FluentForm\Exception
     */
    public function add($name, $label, $active = false, $enabled = true)
    {
        if ($this->getMode() != self::TABS_OPEN)
            throw new Exception("Can't add tabs in \"{$this->getMode()}\" mode.");
        
        if ($enabled == true)
        {
            if (empty($this->tabs) || $active == true)
            {
                $this->active($name);
            }
            
            $this->tabs[$name] = $label;
        }
        
        return $this;
    }

    /**
     * @return array
     */
    public function getTabs()
    {
        return $this->tabs;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     * @throws \inkvizytor\FluentForm\Exception
     */
    public function active($name)
    {
        if ($this->getMode() != self::TABS_OPEN)
            throw new Exception("Can't set active tab in \"{$this->getMode()}\" mode.");
        
        self::$active[self::$counter] = $name;

        return $this;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function isActive($name)
    {
        return self::$active[self::$counter] == $name;
    }

    /**
     * @return $this
     */
    public function open()
    {
        $this->mode = self::TABS_OPEN;

        return $this;
    }

    /**
     * @return $this
     */
    public function close()
    {
        unset(self::$active[self::$counter]);
        
        $this->mode = self::TABS_CLOSE;
        
        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function panel($name)
    {
        $this->mode = self::PANEL_BEGIN;
        $this->name = $name;

        return $this;
    }

    /**
     * @return $this
     */
    public function end()
    {
        self::$counter--;
        
        $this->mode = self::PANEL_END;

        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        $result = parent::render();
        
        if ($this->getMode() == self::PANEL_BEGIN)
        {
            self::$counter++;
        }
        
        return $result;
    }

    /**
     * @return string
     */
    public function renderComponent()
    {
        return get_class($this);
    }
}
