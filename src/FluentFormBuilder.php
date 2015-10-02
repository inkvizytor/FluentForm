<?php namespace inkvizytor\FluentForm;

use inkvizytor\FluentForm\Containers\FormClose;
use inkvizytor\FluentForm\Containers\FormOpen;
use inkvizytor\FluentForm\Controls\Checkable;
use inkvizytor\FluentForm\Controls\Input;
use inkvizytor\FluentForm\Renderers\BaseRenderer;
use inkvizytor\FluentForm\Traits\ButtonsContract;
use inkvizytor\FluentForm\Traits\ContainersContract;
use inkvizytor\FluentForm\Traits\ControlsContract;
use Collective\Html\FormBuilder;
use Collective\Html\HtmlBuilder;

/**
 * Class FluentFormBuilder
 *
 * @package inkvizytor\FluentForm
 */
class FluentFormBuilder
{
    use ContainersContract, ControlsContract, ButtonsContract;
    
    /** @var \inkvizytor\FluentForm\Renderers\BaseRenderer */
    protected $renderer;

    /**
     * @param \Collective\Html\HtmlBuilder $html
     * @param \Collective\Html\FormBuilder $form
     */
    public function __construct(HtmlBuilder $html, FormBuilder $form)
    {
        $this->renderer = app()->make(config('fluentform.renderer'), [$html, $form]);
    }

    /**
     * @param mixed $model
     * @param string $formName
     * @param string $layout
     * @return \inkvizytor\FluentForm\Containers\FormOpen
     */
    public function open($model = null, $formName = 'default', $layout = 'standard')
    {
        $label = config('fluentform.size.label');
        $field = config('fluentform.size.field');
        
        $renderer = $this
            ->getRenderer()
            ->layout($layout)
            ->formName($formName)
            ->setFieldSize($field['lg'], $field['md'], $field['sm'], $field['xs'])
            ->setLabelSize($label['lg'], $label['md'], $label['sm'], $label['xs']);
        
        return (new FormOpen($renderer))->model($model)->files(true);
    }

    /**
     * @param mixed $model
     * @param string $formName
     * @return \inkvizytor\FluentForm\Containers\FormOpen
     */
    public function standard($model = null, $formName = 'default')
    {
        return $this->open($model, $formName, 'standard');
    }

    /**
     * @param mixed $model
     * @param string $formName
     * @return \inkvizytor\FluentForm\Containers\FormOpen
     */
    public function horizontal($model = null, $formName = 'default')
    {
        return $this->open($model, $formName, 'horizontal');
    }

    /**
     * @param mixed $model
     * @param string $formName
     * @return \inkvizytor\FluentForm\Containers\FormOpen
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
        return (new Input($this->getRenderer()))->type('hidden')->name($name)->value($value)->display();
    }

    /**
     * @param string $name
     * @param int|mixed $value
     * @param bool $checked
     * @return \inkvizytor\FluentForm\Controls\Checkable
     */
    public function radio($name, $value = true, $checked = null)
    {
        return (new Checkable($this->getRenderer(), 'radio'))->name($name)->value($value)->checked($checked);
    }
    
    /**
     * @return \inkvizytor\FluentForm\Containers\FormClose
     */
    public function close()
    {
        return new FormClose($this->getRenderer());
    }

    /**
     * @return \inkvizytor\FluentForm\Renderers\BaseRenderer
     */
    private function getRenderer()
    {
        return $this->renderer->mode(BaseRenderer::RENDER_FORM);
    }
} 