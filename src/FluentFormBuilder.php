<?php namespace inkvizytor\FluentForm;

use inkvizytor\FluentForm\Controls\FormClose;
use inkvizytor\FluentForm\Controls\FormOpen;
use inkvizytor\FluentForm\Renderers\BaseRenderer;
use inkvizytor\FluentForm\Traits\FormAddons;
use inkvizytor\FluentForm\Traits\FormButtons;
use inkvizytor\FluentForm\Traits\FormControls;
use Collective\Html\FormBuilder;
use Collective\Html\HtmlBuilder;

/**
 * Class FluentFormBuilder
 *
 * @package inkvizytor\FluentForm
 */
class FluentFormBuilder
{
    use FormControls, FormButtons, FormAddons;
    
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
     * @return \inkvizytor\FluentForm\Controls\FormOpen
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
     * @return \inkvizytor\FluentForm\Controls\FormOpen
     */
    public function standard($model = null, $formName = 'default')
    {
        return $this->open($model, $formName, 'standard');
    }

    /**
     * @param mixed $model
     * @param string $formName
     * @return \inkvizytor\FluentForm\Controls\FormOpen
     */
    public function horizontal($model = null, $formName = 'default')
    {
        return $this->open($model, $formName, 'horizontal');
    }

    /**
     * @param mixed $model
     * @param string $formName
     * @return \inkvizytor\FluentForm\Controls\FormOpen
     */
    public function inline($model = null, $formName = 'default')
    {
        return $this->open($model, $formName, 'inline');
    }
    
    /**
     * @return \inkvizytor\FluentForm\Controls\FormClose
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