<?php namespace inkvizytor\FluentForm\Components\Custom;

use inkvizytor\FluentForm\Base\Component;
use inkvizytor\FluentForm\Extensions\CssExtension;

/**
 * Class TabStrip
 *
 * @package inkvizytor\FluentForm
 */
class Panel extends Component 
{
    use CssExtension;

    const PANEL_BEGIN = 'panel:begin';
    const PANEL_END = 'panel:end';
    
    /** @var array */
    protected $guarded = ['mode', 'heading', 'footer'];

    /** @var string */
    protected $mode = self::PANEL_BEGIN;
    
    /** @var string */
    protected $heading = null;

    /** @var array */
    protected $footer = [];
    
    /**
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @return string
     */
    public function getHeading()
    {
        return $this->heading;
    }

    /**
     * @return array
     */
    public function getFooter()
    {
        return $this->footer;
    }

    /**
     * @param string $heading
     * @return $this
     */
    public function open($heading = null)
    {
        $this->mode = self::PANEL_BEGIN;
        $this->heading = $heading;
        
        return $this;
    }

    /**
     * @param array $footer
     * @return $this
     */
    public function close(array $footer = [])
    {
        $this->mode = self::PANEL_END;
        $this->footer = $footer;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function renderComponent()
    {
        return get_class($this);
    }
}
