<?php namespace inkvizytor\FluentForm\Validation;

/**
 * Class Nag
 *
 * @package inkvizytor\FluentForm
 */
class Nag extends Base
{
    /** @var \DragonFly\Nag\Converters\Contract */
    private $converter = null;
    
    /** @var array */
    public $rules = [];

    /**
     * Class constructor
     */
    public function __construct()
    {
        $className = 'DragonFly\\Nag\\Converters\\'.config('nag.driver', 'FormValidation');
        
        $this->converter = app()->make($className);
    }
    
    /**
     * @param array $rules
     */
    public function setRules($rules)
    {
        $this->rules = $rules;
    }

    /**
     * @param string $name
     * @param string $label
     * @return array
     */
    public function getOptions($name, $label)
    {
        $options = [];

        if ($name == '__FORM')
        {
            return array_map(function($value)
            {
                return (string)$value;
            },
            $this->converter->formOptions);
        }
        
        if ($this->ruleExist($name))
        {
            $options = $this->converter->convertRules($name, $this->getRules($name));
        }

        return $options;
    }

    /**
     * @param string $name
     * @return bool
     */
    protected function ruleExist($name)
    {
        return isset($this->rules[$name]);
    }

    /**
     * @param string $name
     * @return array
     */
    protected function getRules($name)
    {
        $rules = array_get($this->rules, $name, []);
        
        return is_array($rules) ? $rules : explode('|', $rules);
    }
}
