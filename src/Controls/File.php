<?php namespace inkvizytor\FluentForm\Controls;

use inkvizytor\FluentForm\Base\Handler;
use inkvizytor\FluentForm\Contracts\IRootComponent;

/**
 * Class File
 *
 * @package inkvizytor\FluentForm
 */
class File extends Input
{
    /**
     * File constructor.
     *
     * @param \inkvizytor\FluentForm\Contracts\IRootComponent $component
     */
    public function __construct(IRootComponent $component)
    {
        $this->type = 'file';
        
        parent::__construct($component);
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
        $value = $this->root()->binder()->value($this->getKey(), $this->value);
        
        if (!empty($value) && is_string($value))
        {
            $name = $this->getKey().'_delete';
            
            if (($index = strpos($name, '.')) !== false)
            {
                $name = substr_replace($name, '[', $index, 1);
                $name = str_replace('.', '][', $name).']';
            }
            
            $content .= '<div>';
            $content .= $this->root()->html()->tag('input', array_merge($this->getAttr(), $this->getDataAttr(), ['class' => $this->getCssAttr()], [
                'type' => 'checkbox', 
                'name' => $name, 
                'value' => '1',
                'checked' => $this->root()->binder()->checked($this->key($name), '1', null),
                'title' => $this->root()->translator()->trans('fluentform::controls.file.delete')
            ]));
            $content .= ' ';
            $content .= '<a href="'.$value.'" target="_blank">'.basename($value).'</a>';
            $content .= '</div>';
        }
            
        return $content;
    }
}
