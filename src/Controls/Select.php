<?php namespace inkvizytor\FluentForm\Controls;

use inkvizytor\FluentForm\Base\Field;

/**
 * Class Select
 *
 * @package inkvizytor\FluentForm\Controls
 */
class Select extends Field
{
    /** @var array */
    protected $guarded = ['items', 'selected', 'placeholder'];
    
    /** @var array */
    protected $items = [];

    /** @var mixed */
    protected $selected;

    /**
     * @param array $items
     * @return $this
     */
    public function items(array $items)
    {
        $this->items = $items;

        return $this;
    }
    
    /**
     * @param string $selected
     * @return $this
     */
    public function selected($selected)
    {
        $this->selected = $selected;

        return $this;
    }
    
    /**
     * @return string
     */
    public function render()
    {
        $items = $this->items;
        
        if (!empty($this->placeholder))
        {
            $items = ['' => $this->placeholder] + $items;
        }

        $selected = $this->binder()->value($this->key($this->name), $this->selected);
        $options = $this->options($items, $selected);
        
        return $this->html()->tag('select', array_merge($this->getOptions(), ['name' => $this->name]), $options);
    }

    /**
     * @param array $items
     * @param string $selected
     * @return string
     */
    private function options(array $items, $selected = null)
    {
        $options = [];
        
        foreach ($items as $value => $text)
        {
            if (is_array($text) && !array_key_exists('text', $text))
            {
                return $this->optgroup($text, $value, $selected);
            }
            
            $attributes = [
                'value' => $value,
                'selected' => $selected == $value ? 'selected' : null
            ];
            
            if (is_array($text))
            {
                $attributes = array_merge($attributes, array_except($text, 'text'));
                $text = array_get($text, 'text');
            }

            $options[] = $this->html()->tag('option', $attributes, $this->html()->encode($text));
        }
        
        return implode("\n", $options);
    }

    /**
     * @param array $items
     * @param string $text
     * @param string $selected
     * @return string
     */
    private function optgroup(array $items, $text, $selected = null)
    {
        return $this->html()->tag('optgroup', ['label' => $this->html()->encode($text)], $this->options($items, $selected));
    }
} 