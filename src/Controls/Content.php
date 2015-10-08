<?php namespace inkvizytor\FluentForm\Controls;

use inkvizytor\FluentForm\Base\Field;

/**
 * Class Html
 *
 * @package inkvizytor\FluentForm\Controls
 */
class Content extends Field
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
    public function render()
    {
        return $this->html()->tag('p', $this->getOptions(), $this->content);
    }
} 