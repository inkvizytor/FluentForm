<?php namespace inkvizytor\FluentForm;

use Collective\Html\FormBuilder;

/**
 * Class FormBuilderWrapper
 *
 * @package inkvizytor\FluentForm
 */
class FormBuilderWrapper extends FormBuilder
{
    /**
     * Get the select option for the given value.
     *
     * @param  string $display
     * @param  string $value
     * @param  string $selected
     *
     * @return string
     */
    public function getSelectOption($display, $value, $selected)
    {
        if (is_array($display) && !array_key_exists('text', $display))
        {
            return $this->optionGroup($display, $value, $selected);
        }

        return $this->option($display, $value, $selected);
    }
    
    /**
     * Create a select element option.
     *
     * @param  string $display
     * @param  string $value
     * @param  string $selected
     *
     * @return string
     */
    protected function option($display, $value, $selected)
    {
        $selected = $this->getSelectedValue($value, $selected);

        $options = ['value' => e($value), 'selected' => $selected];
        
        if (is_array($display))
        {
            $options = array_merge($options, $display);
            $display = $display['text'];
            unset($options['text']);
        }
        
        return '<option' . $this->html->attributes($options) . '>' . e($display) . '</option>';
    }
}