<?php namespace inkvizytor\FluentForm\Containers;

use inkvizytor\FluentForm\Controls\BaseControl;
use inkvizytor\FluentForm\Renderers\BaseRenderer;
use inkvizytor\FluentForm\Traits\CssContract;
use inkvizytor\FluentForm\Traits\ControlsContract;
use inkvizytor\FluentForm\Traits\SizeContract;
use inkvizytor\FluentForm\Traits\SpecialsContract;

class FormGroup
{
    use ControlsContract, SpecialsContract, CssContract, SizeContract;
    
    /** @var \inkvizytor\FluentForm\Renderers\BaseRenderer */
    private $renderer;
    
    /** @var array */
    private $content = [];

    /**
     * @param \inkvizytor\FluentForm\Renderers\BaseRenderer $renderer
     */
    public function __construct(BaseRenderer $renderer)
    {
        $this->renderer = $renderer
            ->mode(BaseRenderer::RENDER_GROUP)
            ->bindGroup($this);
    }
    
    /**
     * @return \inkvizytor\FluentForm\Renderers\BaseRenderer
     */
    protected function getRenderer()
    {
        return $this->renderer;
    }

    /**
     * @return \Collective\Html\HtmlBuilder
     */
    protected function getHtml()
    {
        return $this->getRenderer()->getHtml();
    }

    /**
     * @return \Collective\Html\FormBuilder
     */
    protected function getForm()
    {
        return $this->getRenderer()->getForm();
    }

    /**
     * @param BaseControl $control
     * @return $this
     */
    public function add(BaseControl $control)
    {
        $this->content[] = $control->display();
        
        return $this;
    }

    /**
     * @param string $html
     * @return $this
     */
    public function literal($html)
    {
        $this->content[] = $html;

        return $this;
    }

    /**
     * Set size of the controls in horizontal form
     *
     * @param int $lg
     * @param int $md
     * @param int $sm
     * @param int $xs
     * @return $this
     */
    public function size($lg = null, $md = null, $sm = null, $xs = null)
    {
        $this->setFieldSize($lg, $md, $sm, $xs);
        
        return $this;
    }

    /**
     * Set size of the label in horizontal form
     *
     * @param int $lg
     * @param int $md
     * @param int $sm
     * @param int $xs
     * @return $this
     */
    public function label($lg = null, $md = null, $sm = null, $xs = null)
    {
        $this->setLabelSize($lg, $md, $sm, $xs);

        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        return implode(' ', $this->content);
    }

    /**
     * @return string
     */
    public function display()
    {
        return $this->getRenderer()
            ->mode(BaseRenderer::RENDER_GROUP)
            ->bindGroup($this)
            ->display();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->display();
    }
}