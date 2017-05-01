<?php namespace inkvizytor\FluentForm;

use inkvizytor\FluentForm\Base\Handler;
use inkvizytor\FluentForm\Base\RootComponent;
use inkvizytor\FluentForm\Renderers\Base as BaseRenderer;

/**
 * Class FluentBuilder
 *
 * @package inkvizytor\FluentForm
 */
abstract class FluentBuilder
{
    /** @var \inkvizytor\FluentForm\Base\Handler */
    private $handler;

    /** @var \inkvizytor\FluentForm\Base\RootComponent */
    private $root;

    /**
     * @param \inkvizytor\FluentForm\Base\Handler $handler
     * @param \inkvizytor\FluentForm\Base\RootComponent $root
     */
    public function __construct(Handler $handler, RootComponent $root)
    {
        $this->handler = $handler;
        $this->root = $root;
    }

    /**
     * @deprecated Use root() method instead
     * @return \inkvizytor\FluentForm\Base\Handler
     */
    protected function handler()
    {
        $this->handler->renderer()->mode(BaseRenderer::RENDER_STANDARD);

        return $this->handler;
    }

    /**
     * @return \inkvizytor\FluentForm\Base\RootComponent
     */
    protected function root()
    {
        return $this->root;
    }
}
