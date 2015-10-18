<?php namespace inkvizytor\FluentForm\Traits;

use inkvizytor\FluentForm\Base\Handler;

/**
 * Class HandlerContract
 *
 * @package inkvizytor\FluentForm
 */
trait HandlerContract
{
    /** @var \inkvizytor\FluentForm\Base\Handler */
    private $handler;

    /**
     * @param \inkvizytor\FluentForm\Base\Handler $handler
     */
    protected function setHandler(Handler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @return \inkvizytor\FluentForm\Base\Handler
     */
    protected function handler()
    {
        return $this->handler;
    }

    /**
     * @return \inkvizytor\FluentForm\Html\Builder
     */
    protected function html()
    {
        return $this->handler->html();
    }

    /**
     * @return \inkvizytor\FluentForm\Renderers\Base
     */
    protected function renderer()
    {
        return $this->handler->renderer();
    }

    /**
     * @return \inkvizytor\FluentForm\Model\Binder
     */
    protected function binder()
    {
        return $this->handler->binder();
    }

    /**
     * @return \inkvizytor\FluentForm\Validation\Base
     */
    protected function validation()
    {
        return $this->handler->validation();
    }

    /**
     * @return \Illuminate\Session\Store
     */
    protected function session()
    {
        return $this->handler->session();
    }

    /**
     * @return \Illuminate\Routing\UrlGenerator
     */
    protected function locator()
    {
        return $this->handler->locator();
    }

    /**
     * @return \Illuminate\Http\Request
     */
    protected function request()
    {
        return $this->handler->request();
    }
}