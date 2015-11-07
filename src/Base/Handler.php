<?php namespace inkvizytor\FluentForm\Base;

use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Session\Store as Session;
use Illuminate\Translation\Translator;
use inkvizytor\FluentForm\Html\Builder;
use inkvizytor\FluentForm\Model\Binder as ModelBinder;
use inkvizytor\FluentForm\Renderers\Base as BaseRenderer;
use inkvizytor\FluentForm\Validation\Base as BaseValidation;

/**
 * Class Handler
 *
 * @package inkvizytor\FluentForm
 */
class Handler
{
    /** @var \inkvizytor\FluentForm\Html\Builder */
    protected $html;

    /** @var \inkvizytor\FluentForm\Renderers\Base */
    protected $renderer;

    /** @var \inkvizytor\FluentForm\Model\Binder */
    protected $binder;

    /** @var \inkvizytor\FluentForm\Validation\Base */
    protected $validation;

    /** @var \Illuminate\Session\Store */
    protected $session;

    /** @var \Illuminate\Routing\UrlGenerator */
    protected $locator;

    /** @var \Illuminate\Http\Request */
    protected $request;

    /** @var \Illuminate\Translation\Translator */
    protected $translator;
    
    /**
     * @param \inkvizytor\FluentForm\Html\Builder $html
     * @param \inkvizytor\FluentForm\Renderers\Base $renderer
     * @param \inkvizytor\FluentForm\Model\Binder $binder
     * @param \inkvizytor\FluentForm\Validation\Base $validation
     * @param \Illuminate\Session\Store $session
     * @param \Illuminate\Routing\UrlGenerator $locator
     * @param \Illuminate\Translation\Translator $translator
     */
    public function __construct(
        Builder $html, BaseRenderer $renderer, ModelBinder $binder, 
        BaseValidation $validation, Session $session, UrlGenerator $locator, 
        Request $request, Translator $translator)
    {
        $this->html = $html;
        $this->renderer = $renderer;
        $this->binder = $binder;
        $this->validation = $validation;
        $this->session = $session;
        $this->locator = $locator;
        $this->request = $request;
        $this->translator = $translator;
    }

    /**
     * @return \inkvizytor\FluentForm\Html\Builder
     */
    public function html()
    {
        return $this->html;
    }

    /**
     * @return \inkvizytor\FluentForm\Renderers\Base
     */
    public function renderer()
    {
        return $this->renderer;
    }

    /**
     * @param string $alias
     */
    public function setRenderer($alias)
    {
        $class = config('fluentform.renderers.'.$alias);
        app()->bind(BaseRenderer::class, $class);
        $this->renderer = app()->make($class);;
    }

    /**
     * @return \inkvizytor\FluentForm\Model\Binder
     */
    public function binder()
    {
        return $this->binder;
    }

    /**
     * @return \inkvizytor\FluentForm\Validation\Base
     */
    public function validation()
    {
        return $this->validation;
    }

    /**
     * @return \Illuminate\Session\Store
     */
    public function session()
    {
        return $this->session;
    }

    /**
     * @return \Illuminate\Routing\UrlGenerator
     */
    public function locator()
    {
        return $this->locator;
    }

    /**
     * @return \Illuminate\Http\Request
     */
    public function request()
    {
        return $this->request;
    }

    /**
     * @return \Illuminate\Translation\Translator
     */
    public function translator()
    {
        return $this->translator;
    }
}