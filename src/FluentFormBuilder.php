<?php namespace inkvizytor\FluentForm;

use inkvizytor\FluentForm\Controls\Form;
use inkvizytor\FluentForm\Components\Custom\Footer;
use inkvizytor\FluentForm\Components\Custom\Group;
use inkvizytor\FluentForm\Controls\Checkable;
use inkvizytor\FluentForm\Controls\Input;
use inkvizytor\FluentForm\Traits\ButtonsContract;
use inkvizytor\FluentForm\Traits\ControlsContract;
use inkvizytor\FluentForm\Traits\CustomContract;
use inkvizytor\FluentForm\Traits\ComplexContract;

/**
 * Class FluentFormBuilder
 *
 * @package inkvizytor\FluentForm
 */
class FluentFormBuilder extends FluentBuilder
{
    use ControlsContract, ComplexContract, ButtonsContract, CustomContract;

    /**
     * @param mixed $model
     * @param string $formName
     * @param string $layout
     * @return \inkvizytor\FluentForm\Controls\Form
     */
    public function open($model = null, $formName = 'default', $layout = 'standard')
    {
        $label = $this->root()->config('fluentform.size.label');
        $field = $this->root()->config('fluentform.size.field');

        $this->root()
            ->formName($formName)
            ->layout($layout)
            ->setFieldSize($field['lg'], $field['md'], $field['sm'], $field['xs'])
            ->setLabelSize($label['lg'], $label['md'], $label['sm'], $label['xs'])
            ->errors(null)
            ->rules(null);
        
        if ($model != null)
        {
            $this->root()->model($model);
        }
        
        return (new Form($this->root()))->files(true)->open();
    }

    /**
     * @param mixed $model
     * @param string $formName
     * @return \inkvizytor\FluentForm\Controls\Form
     */
    public function standard($model = null, $formName = 'default')
    {
        return $this->open($model, $formName, 'standard');
    }

    /**
     * @param mixed $model
     * @param string $formName
     * @return \inkvizytor\FluentForm\Controls\Form
     */
    public function horizontal($model = null, $formName = 'default')
    {
        return $this->open($model, $formName, 'horizontal');
    }

    /**
     * @param mixed $model
     * @param string $formName
     * @return \inkvizytor\FluentForm\Controls\Form
     */
    public function inline($model = null, $formName = 'default')
    {
        return $this->open($model, $formName, 'inline');
    }

    /**
     * @param string $name
     * @param string $value
     * @param array $attr
     * @return string
     */
    public function hidden($name, $value = null, array $attr = [])
    {
        return (new Input($this->root()))->type('hidden')->name($name)->value($value)->setAttr($attr)->display();
    }

    /**
     * @param string $name
     * @param int|mixed $value
     * @param bool $checked
     * @return \inkvizytor\FluentForm\Controls\Checkable
     */
    public function radio($name, $value = true, $checked = null)
    {
        return (new Checkable($this->root(), 'radio'))->name($name)->value($value)->checked($checked);
    }

    /**
     * @return \inkvizytor\FluentForm\Components\Custom\Group
     */
    public function group()
    {
        return (new Group($this->root()));
    }

    /**
     * @param array $buttons
     * @return \inkvizytor\FluentForm\Components\Custom\Footer
     */
    public function footer(array $buttons = [])
    {
        return (new Footer($this->root()))->buttons($buttons);
    }

    /**
     * @return \inkvizytor\FluentForm\Controls\Form
     */
    public function close()
    {
        return (new Form($this->root()))->close();
    }

    /**
     * @return \Illuminate\View\View
     */
    public function preview()
    {
        return view('fluentform::preview');
    }
}
