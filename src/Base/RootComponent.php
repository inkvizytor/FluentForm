<?php namespace inkvizytor\FluentForm\Base;

use Illuminate\Config\Repository;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Session\Store as Session;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Translation\Translator;
use inkvizytor\FluentForm\Contracts\IComponent;
use inkvizytor\FluentForm\Contracts\IModel;
use inkvizytor\FluentForm\Contracts\IRootComponent;
use inkvizytor\FluentForm\Exception;
use inkvizytor\FluentForm\Extensions\GroupSizeExtension;
use inkvizytor\FluentForm\Extensions\ServicesExtension;
use inkvizytor\FluentForm\Html\Builder;
use inkvizytor\FluentForm\Model\Binder as ModelBinder;
use inkvizytor\FluentForm\Renderers\Base as BaseRenderer;
use inkvizytor\FluentForm\Validation\Base as BaseValidation;

/**
 * Class RootComponent
 *
 * @package inkvizytor\FluentForm\
 */
class RootComponent extends Component implements IRootComponent
{
    use ServicesExtension, GroupSizeExtension;

    /** @var string */
    protected $formName;
    
    /** @var mixed */
    protected $model;

    /** @var mixed */
    protected $rules;
    
    /** @var \Illuminate\Support\MessageBag */
    protected $errors;

    /**
     * @param \inkvizytor\FluentForm\Html\Builder $html
     * @param \inkvizytor\FluentForm\Renderers\Base $renderer
     * @param \inkvizytor\FluentForm\Model\Binder $binder
     * @param \inkvizytor\FluentForm\Validation\Base $validation
     * @param \Illuminate\Session\Store $session
     * @param \Illuminate\Routing\UrlGenerator $locator
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Translation\Translator $translator
     * @param \Illuminate\Config\Repository $config
     */
    public function __construct(
        Builder $html,
        BaseRenderer $renderer,
        ModelBinder $binder,
        BaseValidation $validation,
        Session $session,
        UrlGenerator $locator,
        Request $request,
        Translator $translator,
        Repository $config
    )
    {
        parent::__construct($this);
        
        $this->initServices($html, $renderer, $binder, $validation, $session, $locator, $request, $translator, $config);
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
     * @param string $layout
     * @return $this
     */
    public function layout($layout)
    {
        $this->renderer()->layout($layout);

        return $this;
    }
    
    /**
     * @param mixed $model
     * @return $this
     */
    public function model($model)
    {
        $this->model = $model;

        $this->binder()->model($model);

        if ($model instanceof IModel)
        {
            $this->rules($model->rules());
            $this->errors($model->errors());
        }
        
        return $this;
    }

    /**
     * @param mixed $rules
     * @return $this
     */
    public function rules($rules)
    {
        $this->rules = $rules;

        return $this;
    }
    
    /**
     * @param \Illuminate\Support\MessageBag|\Illuminate\Support\ViewErrorBag $errors
     * @return $this
     */
    public function errors($errors)
    {
        if ($errors instanceof ViewErrorBag)
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
     * @param \inkvizytor\FluentForm\Contracts\IComponent $component
     * @return $this
     * @throws \inkvizytor\FluentForm\Exception
     */
    public function setParent(IComponent $component)
    {
        throw new Exception('RootComponent component can\'t have parent.');
    }
    
    // ---------- IComponent interface ----------
    
    /**
     * @return \inkvizytor\FluentForm\Contracts\IComponent
     */
    public function parent()
    {
        return $this;
    }

    /**
     * @return \inkvizytor\FluentForm\Contracts\IRootComponent
     */
    public function root()
    {
        return $this;
    }

    /**
     * @throws \inkvizytor\FluentForm\Exception
     */
    public function renderComponent()
    {
        throw new Exception('RootComponent component can\'t be rendered.');
    }
}
