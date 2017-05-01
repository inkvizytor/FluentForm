<?php namespace inkvizytor\FluentForm\Components\Complex;

use inkvizytor\FluentForm\Controls\Textarea;

/**
 * Class Editor
 *
 * @package inkvizytor\FluentForm
 */
class Editor extends Textarea
{
    /** @var array */
    protected $guarded = ['value', 'config'];
    
    /** @var int */
    protected $rows = 20;
    
    /** @var array */
    protected $config = [];

    /**
     * @param array $config
     * @return $this
     */
    public function config(array $config)
    {
        $this->config = $config;

        return $this;
    }
    
    /**
     * @return string
     */
    public function renderControl()
    {
        $config = $this->root()->config('fluentform.tinymce');

        if ($this->root()->config('fluentform.cdn.enabled.tinymce', false) == false)
        {
            $config['language'] = app()->getLocale();
        }

        $this->attr('id', $this->getKey());
        $this->data('editor', $this->getKey());
        $this->data('config', array_merge($config, $this->config, [
            'selector' => str_replace('.', '\\.', "#{$this->getKey()}")
        ]));
        
        $attributes = array_merge($this->getAttr(), $this->getDataAttr(), ['name' => $this->getName()]);
        $value = $this->root()->binder()->value($this->getKey(), $this->value);

        return $this->root()->html()->tag('textarea', $attributes, $this->root()->html()->encode($value));
    }
}
