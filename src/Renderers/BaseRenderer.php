<?php namespace inkvizytor\FluentForm\Renderers;

use inkvizytor\FluentForm\Containers\FormGroup;
use inkvizytor\FluentForm\Controls\BaseControl;
use inkvizytor\FluentForm\Controls\Control;
use inkvizytor\FluentForm\FormValidation;
use Collective\Html\FormBuilder;
use Collective\Html\HtmlBuilder;

abstract class BaseRenderer
{
    const RENDER_FORM = 'form';
    const RENDER_GROUP = 'group';
    
    /** @var \Collective\Html\HtmlBuilder */
    protected $html;

    /** @var \Collective\Html\FormBuilder */
    protected $form;

    /** @var \inkvizytor\FluentForm\Controls\BaseControl */
    protected $control;

    /** @var \inkvizytor\FluentForm\Containers\FormGroup */
    protected $group;
    
    /** @var \inkvizytor\FluentForm\FormValidation */
    protected $validation;
    
    /** @var string */
    protected $mode;

    /** @var \Illuminate\Support\MessageBag */
    protected $errors;

    /** @var mixed */
    protected $rules;
    
    /** @var mixed */
    protected $model;

    /** @var string */
    protected $layout;

    /** @var string */
    protected $formName;

    /**
     * @var array
     */
    protected $fieldSize = [
        'lg' => 8,
        'md' => 8,
        'sm' => 12,
        'xs' => 12
    ];
    
    /**
     * @var array
     */
    protected $labelSize = [
        'lg' => 4,
        'md' => 4,
        'sm' => 0,
        'xs' => 0
    ];

    /**
     * @param \Collective\Html\HtmlBuilder $html
     * @param \Collective\Html\FormBuilder $form
     */
    public function __construct(HtmlBuilder $html, FormBuilder $form)
    {
        $this->html = $html;
        $this->form = $form;
        
        $this->validation = new FormValidation();
        
        $this->reset();
    }

    /**
     * @return \Collective\Html\HtmlBuilder
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @return \Collective\Html\FormBuilder
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @return \inkvizytor\FluentForm\FormValidation
     */
    public function getValidation()
    {
        return $this->validation;
    }

    /**
     * @param \inkvizytor\FluentForm\Controls\BaseControl $control
     * @return $this
     */
    public function bindControl(BaseControl $control)
    {
        $this->control = $control;
        
        return $this;
    }

    /**
     * @param \inkvizytor\FluentForm\Containers\FormGroup $group
     * @return $this
     */
    public function bindGroup(FormGroup $group)
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
     * @param mixed $model
     * @return $this
     */
    public function model($model)
    {
        $this->model = $model;

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
     * @param \inkvizytor\FluentForm\Controls\Control $control
     * @return bool
     */
    public function isRequired(Control $control)
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
        $this->mode = self::RENDER_FORM;
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
     * @param BaseControl $control
     * @param FormGroup $group
     */
    public function extend($type, $layout, BaseControl $control = null, FormGroup $group = null)
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
                        ($mode == 'base' && $control != null && is_subclass_of($control, Control::class)) ||
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
     * @param BaseControl $control
     * @param FormGroup $group
     * @return string
     */
    public function render($type, $layout, BaseControl $control = null, FormGroup $group = null)
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
                            ($mode == 'base' && $control != null && is_subclass_of($control, Control::class)) ||
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
     * @param BaseControl $control
     * @return mixed
     */
    public function decorate(BaseControl $control)
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
     * Set size of the controls in horizontal form
     * 
     * @param int $lg
     * @param int $md
     * @param int $sm
     * @param int $xs
     * @return $this
     */
    public function setFieldSize($lg = null, $md = null, $sm = null, $xs = null)
    {
        if (!empty($lg)) $this->fieldSize['lg'] = $lg;
        if (!empty($md)) $this->fieldSize['md'] = $md;
        if (!empty($sm)) $this->fieldSize['sm'] = $sm;
        if (!empty($xs)) $this->fieldSize['xs'] = $xs;
        
        return $this;
    }

    /**
     * Set size of the label in horizontal form
     * 
     * @param int $lg
     * @param int $md
     * @param int $sm
     * @param int $xs
     * @return $this
     */
    public function setLabelSize($lg = null, $md = null, $sm = null, $xs = null)
    {
        if (!empty($lg)) $this->labelSize['lg'] = $lg;
        if (!empty($md)) $this->labelSize['md'] = $md;
        if (!empty($sm)) $this->labelSize['sm'] = $sm;
        if (!empty($xs)) $this->labelSize['xs'] = $xs;

        return $this;
    }

    /**
     * @param int $fieldSize
     * @param int $labelSize
     * @return $this
     */
    public function large($fieldSize, $labelSize)
    {
        $this->fieldSize['lg'] = $fieldSize;
        $this->labelSize['lg'] = $labelSize;

        return $this;
    }

    /**
     * @param int $fieldSize
     * @param int $labelSize
     * @return $this
     */
    public function medium($fieldSize, $labelSize)
    {
        $this->fieldSize['md'] = $fieldSize;
        $this->labelSize['md'] = $labelSize;

        return $this;
    }

    /**
     * @param int $fieldSize
     * @param int $labelSize
     * @return $this
     */
    public function small($fieldSize, $labelSize)
    {
        $this->fieldSize['sm'] = $fieldSize;
        $this->labelSize['sm'] = $labelSize;

        return $this;
    }

    /**
     * @param int $fieldSize
     * @param int $labelSize
     * @return $this
     */
    public function tiny($fieldSize, $labelSize)
    {
        $this->fieldSize['xs'] = $fieldSize;
        $this->labelSize['xs'] = $labelSize;

        return $this;
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