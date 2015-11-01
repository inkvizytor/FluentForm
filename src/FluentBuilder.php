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
    private static $handler;

    /**
     * @param \inkvizytor\FluentForm\Base\Handler $handler
     */
    public function __construct(Handler $handler)
    {
        self::$handler = $handler;
    }

    /**
     * @return \inkvizytor\FluentForm\Base\Handler
     */
    protected function handler()
    {
        self::$handler->renderer()->mode(BaseRenderer::RENDER_STANDARD);

        return self::$handler;
    }
} 