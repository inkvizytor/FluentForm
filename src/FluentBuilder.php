<?php namespace inkvizytor\FluentForm;

use inkvizytor\FluentForm\Base\Handler;
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
        $this->handler->renderer()->mode(BaseRenderer::RENDER_STANDARD);
        
        return $this->handler;
    }
} 