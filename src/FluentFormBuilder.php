<?php namespace inkvizytor\FluentForm;

use inkvizytor\FluentForm\Base\IModel;
use inkvizytor\FluentForm\Controls\Elements\Form;
use inkvizytor\FluentForm\Controls\Elements\Footer;
use inkvizytor\FluentForm\Controls\Elements\Group;
use inkvizytor\FluentForm\Controls\Checkable;
use inkvizytor\FluentForm\Controls\Input;
use inkvizytor\FluentForm\Traits\ButtonsContract;
use inkvizytor\FluentForm\Traits\ControlsContract;
use inkvizytor\FluentForm\Traits\CustomContract;
use inkvizytor\FluentForm\Traits\ExclusiveContract;

/**
 * Class FluentFormBuilder
 *
 * @package inkvizytor\FluentForm
 */
class FluentFormBuilder extends FluentBuilder
{
    use ControlsContract, ExclusiveContract, ButtonsContract, CustomContract;

    /**
     * @param mixed $model
     * @param string $formName
     * @param string $layout
     * @return \inkvizytor\FluentForm\Controls\Elements\Form
     */
    public function open($model = null, $formName = 'default', $layout = 'standard')
    {
        $label = config('fluentform.size.label');
        $field = config('fluentform.size.field');

        $this->handler()
            ->renderer()
            ->layout($layout)
            ->formName($formName)
            ->setFieldSize($field['lg'], $field['md'], $field['sm'], $field['xs'])
            ->setLabelSize($label['lg'], $label['md'], $label['sm'], $label['xs'])
            ->errors(null)
            ->rules(null);

        if ($model != null)
        {
            $this->handler()->binder()->model($model);

            if ($model instanceof IModel)
            {
                $this->handler()
                    ->renderer()
                    ->errors($model->errors())
                    ->rules($model->rules());
            }
        }
        
        return (new Form($this->handler()))->files(true)->open();
    }

    /**
     * @param mixed $model
     * @param string $formName
     * @return \inkvizytor\FluentForm\Controls\Elements\Form
     */
    public function standard($model = null, $formName = 'default')
    {
        return $this->open($model, $formName, 'standard');
    }

    /**
     * @param mixed $model
     * @param string $formName
     * @return \inkvizytor\FluentForm\Controls\Elements\Form
     */
    public function horizontal($model = null, $formName = 'default')
    {
        return $this->open($model, $formName, 'horizontal');
    }

    /**
     * @param mixed $model
     * @param string $formName
     * @return \inkvizytor\FluentForm\Controls\Elements\Form
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
        return (new Input($this->handler()))->type('hidden')->name($name)->value($value)->attr($attrs)->display();
    }

    /**
     * @param string $name
     * @param int|mixed $value
     * @param bool $checked
     * @return \inkvizytor\FluentForm\Controls\Checkable
     */
    public function radio($name, $value = true, $checked = null)
    {
        return (new Checkable($this->handler(), 'radio'))->name($name)->value($value)->checked($checked);
    }

    /**
     * @return \inkvizytor\FluentForm\Controls\Elements\Group
     */
    public function group()
    {
        return (new Group($this->handler()));
    }

    /**
     * @param array $buttons
     * @return \inkvizytor\FluentForm\Controls\Elements\Footer
     */
    public function footer(array $buttons = [])
    {
        return (new Footer($this->handler()))->buttons($buttons);
    }

    /**
     * @return \inkvizytor\FluentForm\Controls\Elements\Form
     */
    public function close()
    {
        return (new Form($this->handler()))->close();
    }

    /**
     * @return \Illuminate\View\View
     */
    public function preview()
    {
        return view('fluentform::preview');
    }
} 