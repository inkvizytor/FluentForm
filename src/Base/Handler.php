<?php namespace inkvizytor\FluentForm\Base;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Session\Store as Session;
use Collective\Html\FormBuilder;
use inkvizytor\FluentForm\Model\Binder as ModelBinder;
use inkvizytor\FluentForm\Renderers\Base as BaseRenderer;
use inkvizytor\FluentForm\Validation\Base as BaseValidation;

class Handler
{
    /** @var \Collective\Html\FormBuilder */
    protected $form;

    /** @var \inkvizytor\FluentForm\Base\HtmlBuilder */
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

    /**
     * @param \Collective\Html\FormBuilder $form
     * @param \inkvizytor\FluentForm\Base\HtmlBuilder $html
     * @param \inkvizytor\FluentForm\Renderers\Base $renderer
     * @param \inkvizytor\FluentForm\Model\Binder $binder
     * @param \inkvizytor\FluentForm\Validation\Base $validation
     * @param \Illuminate\Session\Store $session
     * @param \Illuminate\Routing\UrlGenerator $locator
     */
    public function __construct(FormBuilder $form, HtmlBuilder $html, BaseRenderer $renderer, ModelBinder $binder, BaseValidation $validation, Session $session, UrlGenerator $locator)
    {
        $this->form = $form;
        $this->html = $html;
        $this->renderer = $renderer;
        $this->binder = $binder;
        $this->validation = $validation;
        $this->session = $session;
        $this->locator = $locator;
    }

    /**
     * @return \Collective\Html\FormBuilder
     */
    public function form()
    {
        return $this->form;
    }

    /**
     * @return \inkvizytor\FluentForm\Base\HtmlBuilder
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
}