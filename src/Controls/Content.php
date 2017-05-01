<?php namespace inkvizytor\FluentForm\Controls;

use inkvizytor\FluentForm\Base\Field;
use inkvizytor\FluentForm\Base\ViewComponent;

/**
 * Class Content
 *
 * @package inkvizytor\FluentForm
 */
class Content extends ViewComponent
{
    /** @var array */
    protected $guarded = ['content'];

    /** @var string */
    protected $content;

    /**
     * @param string $content
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function renderComponent()
    {
        return $this->root()->html()->tag('p', array_merge($this->getAttr(), $this->getDataAttr(), ['class' => $this->getCssAttr()]), $this->content);
    }
}
