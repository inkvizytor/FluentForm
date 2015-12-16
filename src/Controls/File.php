<?php namespace inkvizytor\FluentForm\Controls;

use inkvizytor\FluentForm\Base\Handler;

/**
 * Class File
 *
 * @package inkvizytor\FluentForm
 */
class File extends Input
{
    /**
     * @param \inkvizytor\FluentForm\Base\Handler $handler
     */
    public function __construct(Handler $handler)
    {
        $this->type = 'file';
        
        parent::__construct($handler);
    }

    /**
     * @param string $type
     * @return $this
     */
    public function type($type)
    {
        // Do nothing
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function render()
    {
        $content = parent::render();
        $value = $this->binder()->value($this->key($this->name), $this->value);
        
        if (!empty($value) && is_string($value))
        {
            $name = $this->key($this->name).'_delete';
            
            if (($index = strpos($name, '.')) !== false)
            {
                $name = substr_replace($name, '[', $index, 1);
                $name = str_replace('.', '][', $name).']';
            }
            
            $content .= '<div>';
            $content .= $this->html()->tag('input', array_merge($this->getOptions(), [
                'type' => 'checkbox', 
                'name' => $name, 
                'value' => '1',
                'checked' => $this->binder()->checked($this->key($name), '1', null),
                'title' => trans('fluentform::controls.file.delete')
            ]));
            $content .= ' ';
            $content .= '<a href="'.$value.'">'.basename($value).'</a>';
            $content .= '</div>';
        }
            
        return $content;
    }
}