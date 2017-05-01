<?php namespace inkvizytor\FluentForm\Renderers;

use inkvizytor\FluentForm\Base\Component;
use inkvizytor\FluentForm\Base\Control;
use inkvizytor\FluentForm\Base\Field;
use inkvizytor\FluentForm\Base\RootComponent;
use inkvizytor\FluentForm\Contracts\IComponent;
use inkvizytor\FluentForm\Controls\Elements\Form;
use inkvizytor\FluentForm\Components\Custom\Group;
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

    /** @var \inkvizytor\FluentForm\Components\Custom\Group */
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
     * @param \inkvizytor\FluentForm\Components\Custom\Group $group
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
            str_contains($rules, 'required'));
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
        $layout = ucfirst($this->layout);

        $this->extend($layout, $this->control, $this->group);

        return $this->render($layout, $this->control, $this->group);
    }

    /**
     * @param \inkvizytor\FluentForm\Base\Control $control
     * @return array
     */
    private function getClasses(Control $control)
    {
        $type = get_class($control);
        
        return array_map(
            function ($type) { return class_basename($type); },
            array_merge([$type => $type], class_parents($control))
        );
    }

    /**
     * @param \inkvizytor\FluentForm\Base\Control $control
     * @param string $prefix
     * @param string $layout
     * @return array
     */
    private function getMethods(Control $control = null, $prefix = 'render', $layout = null)
    {
        $settings = [];

        if ($control != null)
        {
            $classes = $this->getClasses($control);
            
            foreach ($classes as $type => $class)
            {
                if ($layout !== null)
                {
                    $settings[$prefix . $class . $layout] = 'control';
                }
                $settings[$prefix . $class] = 'control';
            }
        }
        elseif ($layout !== null)
        {
            $settings[$prefix.'Group'.$layout] = 'group';
            $settings[$prefix.'Group'] = 'group';
        }
        
        return $settings;
    }
    
    /**
     * @param string $layout
     * @param Control $control
     * @param \inkvizytor\FluentForm\Components\Custom\Group $group
     */
    public function extend($layout, Control $control = null, Group $group = null)
    {
        if ($control != null)
        {
            $methods = $this->getMethods($control, 'extend', $layout);

            foreach ($methods as $method => $mode)
            {
                if (method_exists($this, $method))
                {
                    $this->{$method}($control, $group);
                    break;
                }
            }
        }
    }

    /**
     * @param string $layout
     * @param Control $control
     * @param Group $group
     * @return string
     */
    public function render($layout, Control $control = null, Group $group = null)
    {
        if ($control != null)
        {
            if ($this->mode == self::RENDER_GROUP)
            {
                $methods = $this->getMethods($control, 'render', $layout);

                foreach ($methods as $method => $mode)
                {
                    if (method_exists($this, $method))
                    {
                        return $this->{$method}($control, $group);
                    }
                }
            }
            
            return $this->decorate($control);
        }

        if ($group != null)
        {
            $methods = $this->getMethods(null, 'render', $layout);

            foreach ($methods as $method => $mode)
            {
                if (method_exists($this, $method))
                {
                    return $this->{$method}($control, $group);
                }
            }
            
            return $group->render();
        }

        return '';
    }

    /**
     * @param Control $control
     * @return mixed
     */
    public function decorate(Control $control)
    {
        $methods = $this->getMethods($control, 'decorate');
        
        foreach ($methods as $method => $mode)
        {
            if (method_exists($this, $method))
            {
                return $this->{$method}($control);
            }
        }
        
        return $control->render();
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

    /**
     * @param \inkvizytor\FluentForm\Base\Component $component
     * @return string
     */
    public function renderComponent(Component $component)
    {
        $methods = [];
        $type = get_class($component);
        $layout = ucfirst($this->layout);
        
        $classes = array_map(
            function ($type) { return class_basename($type); },
            array_merge([$type => $type], class_parents($component))
        );

        foreach ($classes as $type => $class)
        {
            if ($layout !== null)
            {
                $methods[] = 'render' . $class . $layout;
            }
            $methods[] = 'render' . $class;
        }
        
        foreach (array_unique($methods) as $method)
        {
            if (method_exists($this, $method) && $method != 'renderComponent')
            {
                return $this->{$method}($component);
            }
        }
        
        return $component->renderComponent();
    }
}
