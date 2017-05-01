<?php namespace inkvizytor\FluentForm\Controls;

use inkvizytor\FluentForm\Base\Component;
use inkvizytor\FluentForm\Extensions\CssExtension;

/**
 * Class Form
 *
 * @package inkvizytor\FluentForm
 */
class Form extends Component 
{
    use CssExtension;
    
    const FORM_OPEN = 'form:open';
    const FORM_CLOSE = 'form:close';
    
    /** @var string */
    protected $mode = self::FORM_OPEN;
    
    /** @var array */
    protected $url;

    /** @var array */
    protected $route;
    
    /** @var array */
    protected $action;

    /**
     * @return $this
     */
    public function open()
    {
        $this->mode = self::FORM_OPEN;

        return $this;
    }

    /**
     * @return $this
     */
    public function close()
    {
        $this->mode = self::FORM_OPEN;

        return $this;
    }

    /**
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }
    
    /**
     * @param string $url
     * @param array $params
     * @return $this
     */
    public function url($url, $params = [])
    {
        $this->url = array_merge([$url], $params);

        return $this;
    }

    /**
     * @param string $route
     * @param array $params
     * @return $this
     */
    public function route($route, $params = [])
    {
        $this->route = array_merge([$route], $params);
        
        return $this;
    }
    
    /**
     * @param string $action
     * @param array $params
     * @return $this
     */
    public function action($action, $params = [])
    {
        $this->action = array_merge([$action], $params);
        
        return $this;
    }

    /**
     * @param string $method
     * @return $this
     */
    public function method($method)
    {
        $this->attr('method', $method);
        
        return $this;
    }

    /**
     * @param bool $enabled
     * @return $this
     */
    public function files($enabled)
    {
        $this->attr('enctype', $enabled ? 'multipart/form-data' : null);

        return $this;
    }

    /**
     * @param \Illuminate\Support\MessageBag|\Illuminate\Support\ViewErrorBag $errors
     * @return $this
     */
    public function errors($errors)
    {
        $this->root()->errors($errors);

        return $this;
    }

    /**
     * @param array $rules
     * @return $this
     */
    public function rules(array $rules)
    {
        $this->root()->rules($rules);

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
    public function fieldSize($lg = null, $md = null, $sm = null, $xs = null)
    {
        $this->root()->setFieldSize($lg, $md, $sm, $xs);

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
    public function labelSize($lg = null, $md = null, $sm = null, $xs = null)
    {
        $this->root()->setLabelSize($lg, $md, $sm, $xs);

        return $this;
    }

    /**
     * @param int $formSize
     * @param int $labelSize
     * @return $this
     */
    public function large($formSize, $labelSize)
    {
        $this->root()->large($formSize, $labelSize);

        return $this;
    }

    /**
     * @param int $formSize
     * @param int $labelSize
     * @return $this
     */
    public function medium($formSize, $labelSize)
    {
        $this->root()->medium($formSize, $labelSize);

        return $this;
    }

    /**
     * @param int $formSize
     * @param int $labelSize
     * @return $this
     */
    public function small($formSize, $labelSize)
    {
        $this->root()->small($formSize, $labelSize);

        return $this;
    }

    /**
     * @param int $formSize
     * @param int $labelSize
     * @return $this
     */
    public function tiny($formSize, $labelSize)
    {
        $this->root()->tiny($formSize, $labelSize);

        return $this;
    }

    /**
     * @return string
     */
    protected function getFormAction()
    {
        if (!empty($this->url))
        {
            return $this->root()->locator()->to(head($this->url), array_slice($this->url, 1));
        }
        if (!empty($this->route))
        {
            return $this->root()->locator()->route(head($this->route), array_slice($this->route, 1));
        }
        if (!empty($this->action))
        {
            return $this->root()->locator()->action(head($this->action), array_slice($this->action, 1));
        }

        return $this->root()->locator()->current();
    }

    /**
     * @return string
     */
    public function renderComponent()
    {
        if ($this->getMode() == self::FORM_OPEN)
        {
            $live = $this->root()->validation()->getOptions('__FORM', '');
            $options = array_merge($live, $this->getAttr(), $this->getDataAttr(), $this->getCssAttr());
            $method = strtoupper(array_get($options, 'method', 'POST'));

            $options['method'] = $method != 'GET' ? 'POST' : $method;
            $options['action'] = $this->getFormAction();
            $options['accept-charset'] = 'UTF-8';

            $html = $this->root()->html()->tag('form', $options);

            if (in_array($method, ['DELETE', 'PATCH', 'PUT']))
            {
                $html .= $this->root()->html()->tag('input', [
                    'type' => 'hidden',
                    'name' => '_method',
                    'value' => $method
                ]);
            }

            if ($method != 'GET')
            {
                $html .= $this->root()->html()->tag('input', [
                    'type' => 'hidden',
                    'name' => '_token',
                    'value' => $this->root()->session()->token()
                ]);
            }

            return $html;
        }

        if ($this->getMode() == self::FORM_CLOSE)
        {
            $this->root()->model(null);

            return $this->root()->html()->close('form');
        }

        return get_class($this);
    }
}
