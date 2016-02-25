<?php namespace inkvizytor\FluentForm\Controls;

use inkvizytor\FluentForm\Base\Field;
use inkvizytor\FluentForm\Traits\AddonsContract;

/**
 * Class Select
 *
 * @package inkvizytor\FluentForm
 */
class Select extends Field
{
    use AddonsContract;
    
    /** @var array */
    protected $guarded = ['items', 'selected', 'placeholder'];

    /** @var array */
    protected $items = [];

    /** @var string|array */
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
     * @param string|array $selected
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
     * @param string|array $selected
     * @return string
     */
    private function options(array $items, $selected = null)
    {
        $options = [];

        foreach ($items as $value => $text)
        {
            if (is_array($text) && !array_key_exists('text', $text))
            {
                $options[] = $this->optgroup($text, $value, $selected);
            }
            else
            {
                $attributes = [
                    'value'    => $value,
                    'selected' => (is_array($selected) ? in_array(strval($value), $selected) : strval($selected) == strval($value)) ? 'selected' : null
                ];

                if (is_array($text))
                {
                    $attributes = array_merge($attributes, array_except($text, 'text'));
                    $text = array_get($text, 'text');
                }

                $options[] = $this->html()->tag('option', $attributes, $this->html()->encode($text));
            }
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
        return $this->html()->tag('optgroup', [
            'label' => $this->html()->encode($text)
        ], $this->options($items, $selected));
    }
} 