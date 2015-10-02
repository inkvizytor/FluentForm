<?php namespace inkvizytor\FluentForm\Containers;

use inkvizytor\FluentForm\Controls\BaseControl;
use inkvizytor\FluentForm\Traits\CssContract;
use inkvizytor\FluentForm\Traits\DataContract;

/**
 * Class FormOpen
 *
 * @package inkvizytor\FluentForm\Controls
 */
class FormOpen extends BaseControl
{
    use CssContract, DataContract;

    /** @var array */
    protected $guarded = ['model'];
    
    /** @var string */
    protected $method = 'POST';
    
    /** @var string */
    protected $url;

    /** @var string */
    protected $route;
    
    /** @var string */
    protected $action;
    
    /** @var bool */
    protected $files = false;

    /** @var mixed */
    protected $model;

    /**
     * @param string $url
     * @return $this
     */
    public function url($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param string $route
     * @return $this
     */
    public function route($route)
    {
        $this->route = $route;

        return $this;
    }
    
    /**
     * @param string $action
     * @return $this
     */
    public function action($action)
    {
        $this->action = $action;
        
        return $this;
    }

    /**
     * @param string $method
     * @return $this
     */
    public function method($method)
    {
        $this->method = $method;
        
        return $this;
    }

    /**
     * @param bool $enabled
     * @return $this
     */
    public function files($enabled)
    {
        $this->files = $enabled;

        return $this;
    }

    /**
     * @param \Illuminate\Support\MessageBag|\Illuminate\Support\ViewErrorBag $errors
     * @return $this
     */
    public function errors($errors)
    {
        $this->getRenderer()->errors($errors);

        return $this;
    }

    /**
     * @param array $rules
     * @return $this
     */
    public function rules(array $rules)
    {
        $this->getRenderer()->rules($rules);

        return $this;
    }

    /**
     * @param mixed $model
     * @return $this
     */
    public function model($model)
    {
        $this->getRenderer()->model($model);

        $this->model = $model;
        
        return $this;
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
    public function size($lg = null, $md = null, $sm = null, $xs = null)
    {
        $this->getRenderer()->setFieldSize($lg, $md, $sm, $xs);

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
    public function label($lg = null, $md = null, $sm = null, $xs = null)
    {
        $this->getRenderer()->setLabelSize($lg, $md, $sm, $xs);

        return $this;
    }

    /**
     * @param int $formSize
     * @param int $labelSize
     * @return $this
     */
    public function large($formSize, $labelSize)
    {
        $this->getRenderer()->large($formSize, $labelSize);

        return $this;
    }

    /**
     * @param int $formSize
     * @param int $labelSize
     * @return $this
     */
    public function medium($formSize, $labelSize)
    {
        $this->getRenderer()->medium($formSize, $labelSize);

        return $this;
    }

    /**
     * @param int $formSize
     * @param int $labelSize
     * @return $this
     */
    public function small($formSize, $labelSize)
    {
        $this->getRenderer()->small($formSize, $labelSize);

        return $this;
    }

    /**
     * @param int $formSize
     * @param int $labelSize
     * @return $this
     */
    public function tiny($formSize, $labelSize)
    {
        $this->getRenderer()->tiny($formSize, $labelSize);

        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        return $this->getForm()->model($this->model, $this->getOptions());
    }
}