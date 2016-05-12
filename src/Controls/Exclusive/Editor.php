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
    public function render()
    {
        $config = config('fluentform.tinymce');

        if (config('fluentform.cdn.enabled.tinymce', false) == false)
        {
            $config['language'] = app()->getLocale();
        }

        $this->attr('id', $this->getKey());
        $this->data('editor', $this->getKey());
        $this->data('config', array_merge($config, $this->config, [
            'selector' => str_replace('.', '\\.', "#{$this->getKey()}")
        ]));
        
        $attributes = array_merge($this->getOptions(), ['name' => $this->name]);
        $value = $this->binder()->value($this->key($this->name), $this->value);

        return $this->html()->tag('textarea', $attributes, $this->html()->encode($value));
    }
} 