<?php namespace inkvizytor\FluentForm\Validation;

/**
 * Class Base
 *
 * @package inkvizytor\FluentForm\Validation
 */
class JQuery extends Base
{
    /** @var array */
    public $rules = [];

    /** @var array */
    protected $numericRules = ['integer', 'numeric'];

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

        if (!$this->ruleExist($name))
        {
            return [];
        }

        $rules = $this->getRule($name);
        $type = $this->getType($rules);

        foreach ($rules as $key => $value)
        {
            $options = $options + $this->convertRule($value, $name, $type, $label);
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
     * @param string $inputName
     * @return array
     */
    protected function getRule($inputName)
    {
        $rule = $this->rules[$inputName];
        
        return is_array($rule) ? $rule : explode('|', $rule);
    }

    /**
     * @param string $rule
     * @param string $name
     * @param string $type
     * @param string $label
     * @return array
     */
    protected function convertRule($rule, $name, $type, $label)
    {
        $options = [];
        
        $parsedRule = $this->parseValidationRule($rule);
        $prepareRule = $this->getRuleMethodName($parsedRule['name']);
        $prepareMessage = $this->getMessageMethodName($parsedRule['name']);
        
        // If method does not exist, it is not implemented yet so return empty array
        if (!method_exists($this, $prepareRule))
        {
            return $options;
        }

        $options = $this->$prepareRule($parsedRule, $name, $type);

        // If method does not exist, get default error message
        if (!method_exists($this, $prepareMessage))
        {
            $options = $options + $this->getErrorMessage($parsedRule['name'], $label);
        }
        else
        {
            $options = $options + $this->$prepareMessage($parsedRule, $label, $type);
        }

        return $options;
    }

    /**
     * @param string $ruleName
     * @param string $label
     * @return array
     */
    protected function getErrorMessage($ruleName, $label)
    {
        $message = \Lang::get('validation.'.$ruleName, ['attribute' => $label]);

        return ['data-msg-'.$ruleName => $message];
    }

    /**
     * @param array $rules
     * @return string
     */
    protected function getType($rules)
    {
        foreach ($rules as $key => $rule)
        {
            $parsedRule = $this->parseValidationRule($rule);
            
            if (in_array($parsedRule['name'], $this->numericRules))
            {
                return 'numeric';
            }
        }

        return 'string';
    }

    /**
     * @param string $ruleName
     * @return string
     */
    protected function getRuleMethodName($ruleName)
    {
        return 'prepareRule'.studly_case($ruleName);
    }

    /**
     * @param string $ruleName
     * @return string
     */
    protected function getMessageMethodName($ruleName)
    {
        return 'prepareMessage'.studly_case($ruleName);
    }

    /**
     * @param string $rule
     * @return array
     */
    protected function parseValidationRule($rule)
    {
        $ruleArray = ['name' => '', 'parameters' => []];

        $explodedRule = explode(':', $rule);
        $ruleArray['name'] = array_shift($explodedRule);
        $rule = implode(':', $explodedRule);
        $ruleArray['parameters'] = explode(',', $rule);
        
        return $ruleArray;
    }

    // --------------------------------------------------
    
    /*
     * Rules convertions which returns attributes as an array
     *
     * @param  array ['name' => '', 'parameters' => []]
     * @param  array
     * @param  array type of input
     * @return  array
     */

    // --------------------------------------------------

    protected function prepareRuleEmail($parsedRule, $attribute, $type)
    {
        return ['data-rule-email' => 'true'];
    }

    protected function prepareRuleRequired($parsedRule, $attribute, $type)
    {
        return ['data-rule-required' => 'true'];
    }

    protected function prepareRuleUrl($parsedRule, $attribute, $type)
    {
        return ['data-rule-url' => 'true'];
    }

    protected function prepareRuleInteger($parsedRule, $attribute, $type)
    {
        return ['data-rule-number' => 'true'];
    }

    protected function prepareRuleNumeric($parsedRule, $attribute, $type)
    {
        return ['data-rule-number' => 'true'];
    }

    protected function prepareRuleIp($parsedRule, $attribute, $type)
    {
        return ['data-rule-ipv4' => 'true'];
    }

    protected function prepareRuleSame($parsedRule, $attribute, $type)
    {
        $value = vsprintf("*[name='%1s']", $parsedRule['parameters']);
        
        return ['data-rule-equalto' => $value];
    }

    protected function prepareRuleRegex($parsedRule, $attribute, $type)
    {
        $rule = $parsedRule['parameters'][0];

        if(substr($rule, 0, 1) == substr($rule, -1, 1))
        {
            $rule = substr($rule, 1, -1);
        }

        return ['data-rule-regex' => $rule];
    }

    protected function prepareRuleAlpha($parsedRule, $attribute, $type)
    {
        return ['data-rule-regex' => "^[A-Za-z]+$"];
    }

    protected function prepareRuleAlphadash($parsedRule, $attribute, $type)
    {
        return ['data-rule-regex' => "^[A-Za-z0-9_-]+$"];
    }
    
    protected function prepareRuleAlphanum($parsedRule, $attribute, $type)
    {
        return ['data-rule-regex' => "^[A-Za-z0-9]+$"];
    }

    protected function prepareRuleImage($parsedRule, $attribute, $type)
    {
        return ['accept' => "image/*"];
    }

    protected function prepareRuleDate($parsedRule, $attribute, $type)
    {
        return ['data-rule-date' => "true"];
    }

    protected function prepareRuleMin($parsedRule, $attribute, $type)
    {
        switch ($type)
        {
            case 'numeric':
                return ['data-rule-min' => vsprintf("%1s", $parsedRule['parameters'])];
                break;

            default:
                return ['data-rule-minlength' => vsprintf("%1s", $parsedRule['parameters'])];
                break;
        }
    }

    protected function prepareRuleMax($parsedRule, $attribute, $type)
    {
        switch ($type)
        {
            case 'numeric':
                return ['data-rule-max' => vsprintf("%1s", $parsedRule['parameters'])];
                break;

            default:
                return ['data-rule-maxlength' => vsprintf("%1s", $parsedRule['parameters'])];
                break;
        }
    }

    protected function prepareRuleBetween($parsedRule, $attribute, $type)
    {
        switch ($type)
        {
            case 'numeric':
                return ['data-rule-range' => vsprintf("%1s,%2s", $parsedRule['parameters'])];
                break;

            default:
                return ['data-rule-minlength' => $parsedRule['parameters'][0], 'data-rule-maxlength' =>  $parsedRule['parameters'][1]];
                break;
        }
    }
    
    protected function prepareRuleDateFormat($parsedRule, $attribute, $type)
    {
        return ['data-rule-regex' => $this->dateRegexFromFormat($parsedRule['parameters'][0])];
    }

    // --------------------------------------------------

    /*
     * Message convertions which returns attributes as an array
     *
     * @param  array ['name' => '', 'parameters' => []]
     * @param  array
     * @param  array type of input
     * @return  array
     */

    // --------------------------------------------------

    protected function prepareMessageIp($parsedRule, $attribute, $type)
    {
        $message = \Lang::get('validation.'.$parsedRule['name'], ['attribute' => $attribute]);
        
        return ['data-msg-ipv4' => $message];
    }

    protected function prepareMessageAlpha($parsedRule, $attribute, $type)
    {
        $message = \Lang::get('validation.'.$parsedRule['name'], ['attribute' => $attribute]);
        
        return ['data-msg-regex' => $message];
    }

    protected function prepareMessageAlphanum($parsedRule, $attribute, $type)
    {
        $message = \Lang::get('validation.'.$parsedRule['name'], ['attribute' => $attribute]);
        
        return ['data-msg-regex' => $message];
    }

    protected function prepareMessageMax($parsedRule, $attribute, $type)
    {
        $message = \Lang::get('validation.'.$parsedRule['name'].'.'.$type, ['attribute' => $attribute, 'max' => $parsedRule['parameters'][0]]);
        
        switch ($type)
        {
            case 'numeric':
                return ['data-msg-max' => $message];
                break;

            default:
                return ['data-msg-maxlength' => $message];
                break;
        }
    }

    protected function prepareMessageMin($parsedRule, $attribute, $type)
    {
        $message = \Lang::get('validation.'.$parsedRule['name'].'.'.$type, ['attribute' => $attribute, 'min' => $parsedRule['parameters'][0]]);
        
        switch ($type)
        {
            case 'numeric':
                return ['data-msg-min' => $message];
                break;

            default:
                return ['data-msg-minlength' => $message];
                break;
        }
    }

    protected function prepareMessageBetween($parsedRule, $attribute, $type)
    {
        $message = \Lang::get('validation.'.$parsedRule['name'].'.'.$type, ['attribute' => $attribute, 'min' => $parsedRule['parameters'][0], 'max' => $parsedRule['parameters'][1]]);
        
        switch ($type)
        {
            case 'numeric':
                return ['data-msg-range' => $message];
                break;

            default:
                return ['data-msg-minlength' => $message, 'data-msg-maxlength' => $message];
                break;
        }
    }

    protected function prepareMessageDateFormat($parsedRule, $attribute, $type)
    {
        $message = \Lang::get('validation.'.$parsedRule['name'], ['attribute' => $attribute, 'format' => $parsedRule['parameters'][0]]);
        
        return ['data-msg-regex' => $message];
    }

    // --------------------------------------------------

    private function dateRegexFromFormat($format)
    {
        // reverse engineer date formats
        $keys = array(
            'Y' => array('year', '\d{4}'),
            'y' => array('year', '\d{2}'),
            'm' => array('month', '\d{2}'),
            'n' => array('month', '\d{1,2}'),
            'M' => array('month', '[A-Z][a-z]{3}'),
            'F' => array('month', '[A-Z][a-z]{2,8}'),
            'd' => array('day', '\d{2}'),
            'j' => array('day', '\d{1,2}'),
            'D' => array('day', '[A-Z][a-z]{2}'),
            'l' => array('day', '[A-Z][a-z]{6,9}'),
            'u' => array('hour', '\d{1,6}'),
            'h' => array('hour', '\d{2}'),
            'H' => array('hour', '\d{2}'),
            'g' => array('hour', '\d{1,2}'),
            'G' => array('hour', '\d{1,2}'),
            'i' => array('minute', '\d{2}'),
            's' => array('second', '\d{2}')
        );

        // convert format string to regex
        $regex = '';
        $chars = str_split($format);

        foreach ($chars AS $n => $char)
        {
            $lastChar = isset($chars[$n - 1]) ? $chars[$n - 1] : '';
            $skipCurrent = '\\' == $lastChar;

            if (!$skipCurrent && isset($keys[$char]))
            {
                $regex .= $keys[$char][1];
            }
            else if ('\\' == $char)
            {
                $regex .= $char;
            }
            else
            {
                $regex .= preg_quote($char);
            }
        }

        return '^'.$regex.'$';
    }
} 