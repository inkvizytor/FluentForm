<?php namespace inkvizytor\FluentForm\Components;

use inkvizytor\FluentForm\Base\Control;
use inkvizytor\FluentForm\Traits\CssContract;

/**
 * Class TabStrip
 *
 * @package inkvizytor\FluentForm
 */
class Panel extends Control
{
    use CssContract;
    
    /** @var array */
    protected $guarded = ['mode', 'heading', 'footer'];

    /** @var string */
    protected $mode;
    
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
     * @param string $heading
     * @return $this
     */
    public function open($heading = null)
    {
        $this->mode = 'panel:begin';
        $this->heading = $heading;
        
        return $this;
    }

    /**
     * @param array $footer
     * @return $this
     */
    public function close(array $footer = [])
    {
        $this->mode = 'panel:end';
        $this->footer = $footer;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function render()
    {
        if ($this->getMode() == 'panel:begin')
        {
            return $this->renderPanelBegin();
        }

        if ($this->getMode() == 'panel:end')
        {
            return $this->renderPanelEnd();
        }
        
        return '';
    }
    
    /**
     * @return string
     */
    private function renderPanelBegin()
    {
        $attributes = array_except($this->getOptions(), ['heading', 'body', 'footer']);
        
        $header = '';

        if (!empty($this->heading))
        {
            $header = $this->html()->tag('div', $this->getAttr('heading'), $this->heading)."\n";
        }
        
        return
            $this->html()->tag('div', $attributes)."\n".
            $header.
            $this->html()->tag('div', $this->getAttr('body'));
    }

    /**
     * @return string
     */
    private function renderPanelEnd()
    {
        $footer = '';
        
        if (count($this->footer) > 0)
        {
            $footer = $this->html()->tag('div', $this->getAttr('footer'), implode("\n", $this->footer))."\n";
        }
        
        return
            $this->html()->close('div')."\n".
            $footer.
            $this->html()->close('div');
    }
} 