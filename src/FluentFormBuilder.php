<?php namespace inkvizytor\FluentForm;

use inkvizytor\FluentForm\Base\Handler;
use inkvizytor\FluentForm\Containers\Form;
use inkvizytor\FluentForm\Controls\Checkable;
use inkvizytor\FluentForm\Controls\Input;
use inkvizytor\FluentForm\Renderers\Base as BaseRenderer;
use inkvizytor\FluentForm\Traits\ButtonsContract;
use inkvizytor\FluentForm\Traits\ContainersContract;
use inkvizytor\FluentForm\Traits\ControlsContract;
use inkvizytor\FluentForm\Traits\SpecialsContract;

/**
 * Class FluentFormBuilder
 *
 * @package inkvizytor\FluentForm
 */
class FluentFormBuilder
{
    use ContainersContract, ControlsContract, SpecialsContract, ButtonsContract;

    /** @var \inkvizytor\FluentForm\Base\Handler */
    private $handler;

    /**
     * @param \inkvizytor\FluentForm\Base\Handler $handler
     */
    public function __construct(Handler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @return \inkvizytor\FluentForm\Base\Handler
     */
    protected function handler()
    {
        $this->handler->renderer()->mode(BaseRenderer::RENDER_FORM);
        
        return $this->handler;
    }

    /**
     * @param mixed $model
     * @param string $formName
     * @param string $layout
     * @return \inkvizytor\FluentForm\Containers\Form
     */
    public function open($model = null, $formName = 'default', $layout = 'standard')
    {
        $label = config('fluentform.size.label');
        $field = config('fluentform.size.field');

        $this->handler()
            ->binder()
            ->model($model);

        $this->handler()
            ->renderer()
            ->layout($layout)
            ->formName($formName)
            ->setFieldSize($field['lg'], $field['md'], $field['sm'], $field['xs'])
            ->setLabelSize($label['lg'], $label['md'], $label['sm'], $label['xs'])
            ->errors(null)
            ->rules([]);

        return (new Form($this->handler()))->model($model)->files(true)->open();
    }

    /**
     * @param mixed $model
     * @param string $formName
     * @return \inkvizytor\FluentForm\Containers\Form
     */
    public function standard($model = null, $formName = 'default')
    {
        return $this->open($model, $formName, 'standard');
    }

    /**
     * @param mixed $model
     * @param string $formName
     * @return \inkvizytor\FluentForm\Containers\Form
     */
    public function horizontal($model = null, $formName = 'default')
    {
        return $this->open($model, $formName, 'horizontal');
    }

    /**
     * @param mixed $model
     * @param string $formName
     * @return \inkvizytor\FluentForm\Containers\Form
     */
    public function inline($model = null, $formName = 'default')
    {
        return $this->open($model, $formName, 'inline');
    }

    /**
     * @param string $name
     * @param string $value
     * @return string
     */
    public function hidden($name, $value = null)
    {
        return (new Input($this->handler()))->type('hidden')->name($name)->value($value)->display();
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
     * @return \inkvizytor\FluentForm\Containers\Form
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