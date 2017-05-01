<?php namespace inkvizytor\FluentForm\Controls;

use inkvizytor\FluentForm\Base\ViewComponent;
use inkvizytor\FluentForm\Traits\AddonsContract;

/**
 * Class Input
 *
 * @package inkvizytor\FluentForm
 */
class Input extends ViewComponent
{
    use AddonsContract;
    
    /** @var array */
    protected $guarded = ['type', 'value'];

    /** @var string */
    protected $type;

    /** @var string */
    protected $value;

    /** @var int */
    protected $maxlength;

    /** @var string */
    protected $min;

    /** @var string */
    protected $max;

    /** @var int */
    protected $size;

    /** @var int */
    protected $step;
    
    /**
     * @param string $type
     * @return $this
     */
    public function type($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function value($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @param int $maxlength
     * @return $this
     */
    public function maxlength($maxlength)
    {
        $this->maxlength = $maxlength;

        return $this;
    }

    /**
     * @param string $min
     * @return $this
     */
    public function min($min)
    {
        $this->min = $min;

        return $this;
    }

    /**
     * @param string $max
     * @return $this
     */
    public function max($max)
    {
        $this->max = $max;

        return $this;
    }

    /**
     * @param int $size
     * @return $this
     */
    public function size($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @param int $step
     * @return $this
     */
    public function step($step)
    {
        $this->step = $step;

        return $this;
    }

    /**
     * @return string
     */
    public function renderComponent()
    {
        return $this->root()->html()->tag('input', array_merge($this->getAttr(), $this->getDataAttr(), ['class' => $this->getCssAttr()], [
            'type' => $this->type,
            'name' => $this->getName(),
            'value' => !in_array($this->type, ['password', 'file']) ? 
                $this->root()->binder()->value($this->getKey(), $this->value) : 
                null
        ]));
    }
}
