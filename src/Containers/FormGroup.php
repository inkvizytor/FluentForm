<?php namespace inkvizytor\FluentForm\Containers;

use inkvizytor\FluentForm\Controls\BaseControl;
use inkvizytor\FluentForm\Renderers\BaseRenderer;
use inkvizytor\FluentForm\Traits\CssContract;
use inkvizytor\FluentForm\Traits\ControlsContract;

class FormGroup
{
    use ControlsContract, CssContract;
    
    /** @var \inkvizytor\FluentForm\Renderers\BaseRenderer */
    private $renderer;
    
    /** @var array */
    private $content = [];

    /**
     * @var array
     */
    private $fieldSize = [
        'lg' => null,
        'md' => null,
        'sm' => null,
        'xs' => null
    ];

    /**
     * @var array
     */
    private $labelSize = [
        'lg' => null,
        'md' => null,
        'sm' => null,
        'xs' => null
    ];
    
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
        if (!empty($lg)) $this->fieldSize['lg'] = $lg;
        if (!empty($md)) $this->fieldSize['md'] = $md;
        if (!empty($sm)) $this->fieldSize['sm'] = $sm;
        if (!empty($xs)) $this->fieldSize['xs'] = $xs;

        return $this;
    }

    /**
     * Get size of the controls in horizontal form
     *
     * @param string $screen
     * @return array
     */
    public function getFieldSize($screen)
    {
        return array_get($this->fieldSize, $screen);
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
        if (!empty($lg)) $this->labelSize['lg'] = $lg;
        if (!empty($md)) $this->labelSize['md'] = $md;
        if (!empty($sm)) $this->labelSize['sm'] = $sm;
        if (!empty($xs)) $this->labelSize['xs'] = $xs;

        return $this;
    }

    /**
     * Get size of the label in horizontal form
     *
     * @param string $screen
     * @return array
     */
    public function getLabelSize($screen)
    {
        return array_get($this->labelSize, $screen);
    }

    /**
     * @param int $fieldSize
     * @param int $labelSize
     * @return $this
     */
    public function large($fieldSize, $labelSize)
    {
        $this->size($fieldSize);
        $this->label($labelSize);

        return $this;
    }

    /**
     * @param int $fieldSize
     * @param int $labelSize
     * @return $this
     */
    public function medium($fieldSize, $labelSize)
    {
        $this->size(null, $fieldSize);
        $this->label(null, $labelSize);

        return $this;
    }

    /**
     * @param int $fieldSize
     * @param int $labelSize
     * @return $this
     */
    public function small($fieldSize, $labelSize)
    {
        $this->size(null, null, $fieldSize);
        $this->label(null, null, $labelSize);

        return $this;
    }

    /**
     * @param int $fieldSize
     * @param int $labelSize
     * @return $this
     */
    public function tiny($fieldSize, $labelSize)
    {
        $this->size(null, null, null, $fieldSize);
        $this->label(null, null, null, $labelSize);

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