<?php namespace inkvizytor\FluentForm\Controls\Exclusive;

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
     * @param string $config
     * @return $this
     */
    public function config($config)
    {
        $this->config = $config;

        return $this;
    }
    
    /**
     * @return string
     */
    public function render()
    {
        $config = config('fluentform.tinymce');

        if (config('fluentform.cdn.enabled.tinymce', false) == false)
        {
            $config['language'] = app()->getLocale();
        }

        $this->attr('id', $this->getName());
        $this->data('editor', $this->getName());
        $this->data('config', array_merge($config, $this->config, [
            'selector' => "#{$this->getName()}"
        ]));
        
        $attributes = array_merge($this->getOptions(), ['name' => $this->name]);
        $value = $this->binder()->value($this->key($this->name), $this->value);

        return $this->html()->tag('textarea', $attributes, $this->html()->encode($value));
    }
} 