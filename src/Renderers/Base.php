<?php namespace inkvizytor\FluentForm\Renderers;

use inkvizytor\FluentForm\Base\Control;
use inkvizytor\FluentForm\Base\Field;
use inkvizytor\FluentForm\Controls\Elements\Group;
use inkvizytor\FluentForm\Validation\Base as BaseValidation;
use inkvizytor\FluentForm\Html\Builder;
use inkvizytor\FluentForm\Traits\SizeContract;

abstract class Base
{
    use SizeContract;
    
    const RENDER_STANDARD = 'standard';
    const RENDER_GROUP = 'group';
    
    /** @var \inkvizytor\FluentForm\Html\Builder */
    protected $html;

    /** @var \inkvizytor\FluentForm\Validation\Base */
    protected $validation;
    
    /** @var \inkvizytor\FluentForm\Base\Control */
    protected $control;

    /** @var \inkvizytor\FluentForm\Controls\Elements\Group */
    protected $group;
    
    /** @var string */
    protected $mode;

    /** @var \Illuminate\Support\MessageBag */
    protected $errors;

    /** @var mixed */
    protected $rules;
    
    /** @var string */
    protected $layout;

    /** @var string */
    protected $formName;

    /**
     * @param \inkvizytor\FluentForm\Html\Builder $html
     * @param \inkvizytor\FluentForm\Validation\Base $validation
     */
    public function __construct(Builder $html, BaseValidation $validation)
    {
        $this->html = $html;
        $this->validation = $validation;
        
        $this->reset();
    }

    /**
     * @return \inkvizytor\FluentForm\Html\Builder
     */
    public function html()
    {
        return $this->html;
    }

    /**
     * @return \inkvizytor\FluentForm\Validation\Base
     */
    public function validation()
    {
        return $this->validation;
    }

    /**
     * @param \inkvizytor\FluentForm\Base\Control $control
     * @return $this
     */
    public function bindControl(Control $control)
    {
        $this->control = $control;
        
        return $this;
    }

    /**
     * @param \inkvizytor\FluentForm\Controls\Elements\Group $group
     * @return $this
     */
    public function bindGroup(Group $group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * @param string $mode
     * @return $this
     */
    public function mode($mode)
    {
        $this->reset();
        
        $this->mode = $mode;

        return $this;
    }

    /**
     * @param string $layout
     * @return $this
     */
    public function layout($layout)
    {
        $this->layout = $layout;

        return $this;
    }

    /**
     * @param \Illuminate\Support\MessageBag|\Illuminate\Support\ViewErrorBag $errors
     * @return $this
     */
    public function errors($errors)
    {
        if ($errors instanceof \Illuminate\Support\ViewErrorBag)
        {
            $this->errors = $errors->getBag($this->formName);
        }
        else
        {
            $this->errors = $errors;
        }

        return $this;
    }

    /**
     * @param mixed $rules
     * @return $this
     */
    public function rules($rules)
    {
        $this->validation->setRules($rules);
        
        $this->rules = $rules;

        return $this;
    }
    
    /**
     * @param string $formName
     * @return $this
     */
    public function formName($formName)
    {
        $this->formName = $formName;

        return $this;
    }

    /**
     * @param \inkvizytor\FluentForm\Base\Field $control
     * @return bool
     */
    public function isRequired(Field $control)
    {
        $rules = array_get($this->rules, $control->getName(), []);
        
        return $control->isRequired() || (is_array($rules) ? 
            array_has($rules, 'required') : 
            str_contains($rules, 'required')
        );
    }
    
    /**
     * @return void
     */
    private function reset()
    {
        $this->control = null;
        $this->group = null;
        $this->mode = self::RENDER_STANDARD;
    }

    /**
     * @return string
     */
    public function display()
    {
        $type = get_class($this->control);
        $layout = ucfirst($this->layout);
        
        $this->extend(
            $type,
            $layout,
            $this->control,
            $this->group
        );
        
        return $this->render(
            $type,
            $layout,
            $this->control,
            $this->group
        );
    }

    /**
     * @param string $type
     * @param string $layout
     * @param Control $control
     * @param \inkvizytor\FluentForm\Controls\Elements\Group $group
     */
    public function extend($type, $layout, Control $control = null, Group $group = null)
    {
        $settings = [
            'extend' . class_basename($type) . $layout => 'type',
            'extend' . class_basename($type) => 'type',
            'extendControl' . $layout => 'base',
            'extendControl' => 'base',
            'extendGroup' . $layout => 'group',
            'extendGroup' => 'group'
        ];

        foreach ($settings as $method => $mode)
        {
            if (method_exists($this, $method))
            {
                $fire = ($mode == 'type' && $control != null) ||
                        ($mode == 'base' && $control != null && is_subclass_of($control, Field::class)) ||
                        ($mode == 'group' && $group != null);
                
                if ($fire == true)
                {
                    $this->{$method}($control, $group);
                    break;
                }
            }
        }
    }

    /**
     * @param string $type
     * @param string $layout
     * @param Control $control
     * @param Group $group
     * @return string
     */
    public function render($type, $layout, Control $control = null, Group $group = null)
    {
        if ($this->mode == self::RENDER_GROUP)
        {
            $settings = [
                'render' . class_basename($type) . $layout => 'type',
                'render' . class_basename($type) => 'type',
                'renderControl' . $layout => 'base',
                'renderControl' => 'base',
                'renderGroup' . $layout => 'group',
                'renderGroup' => 'group'
            ];

            foreach ($settings as $method => $mode)
            {
                if (method_exists($this, $method))
                {
                    $fire = ($mode == 'type' && $control != null) ||
                            ($mode == 'base' && $control != null && is_subclass_of($control, Field::class)) ||
                            ($mode == 'group' && $group != null);

                    if ($fire == true)
                    {
                        return $this->{$method}($control, $group);
                    }
                }
            }
        }

        if ($control != null)
            return $this->decorate($control);

        if ($group != null)
            return $group->render();
        
        return '';
    }

    /**
     * @param Control $control
     * @return mixed
     */
    public function decorate(Control $control)
    {
        $method = 'decorate'.class_basename(get_class($control));

        if (method_exists($this, $method))
        {
            return $this->{$method}($control);
        }
        else
        {
            return $control->render();
        }
    }

    /**
     * @param string $key
     * @return array
     */
    public function getErrorMessages($key)
    {
        if ($this->errors !== null)
        {
            return $this->errors->get($key);
        }
        
        return [];
    }
} 