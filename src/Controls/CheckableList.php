<?php namespace inkvizytor\FluentForm\Controls;

use inkvizytor\FluentForm\Base\ViewComponent;
use inkvizytor\FluentForm\Contracts\IRootComponent;

/**
 * Class CheckableList
 *
 * @package inkvizytor\FluentForm
 */
class CheckableList extends ViewComponent 
{
    /** @var array */
    protected $guarded = ['items', 'selected', 'inline', 'placeholder'];

    /** @var string */
    private $type = 'checkbox';

    /** @var array */
    protected $items;

    /** @var array */
    protected $checked;

    /** @var bool */
    protected $inline = false;

    /**
     * CheckableList constructor.
     *
     * @param \inkvizytor\FluentForm\Contracts\IRootComponent $component
     * @param string $type
     */
    public function __construct(IRootComponent $component, $type = 'checkbox')
    {
        $this->type = $type;

        parent::__construct($component);
    }

    /**
     * @param array $items
     * @return $this
     */
    public function items(array $items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @param string|array $checked
     * @return $this
     */
    public function checked($checked)
    {
        $this->checked = is_array($checked) ? $checked : [$checked];

        return $this;
    }

    /**
     * @param bool $inline
     * @return $this
     */
    public function inline($inline)
    {
        $this->inline = $inline;

        return $this;
    }

    /**
     * @return bool
     */
    public function isInline()
    {
        return $this->inline;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function renderComponent()
    {
        $checkables = [];

        foreach ($this->items as $value => $label)
        {
            $checkables[] = (new Checkable($this->root(), $this->getType()))
                ->name($this->getName().($this->type == 'checkbox' ? '[]' : ''))
                ->label($label)
                ->value($value)
                ->checked(in_array($value, $this->checked))
                ->disabled($this->isDisabled())
                ->readonly($this->isReadonly())
                ->setData($this->getData(null))
                ->setAttr($this->getAttr(null))
                ->live(false)
                ->render();
        }

        foreach ($checkables as $i => $checkable)
        {
            $checkables[$i] = $this->root()->html()->tag('li', [], $checkable);
        }

        return $this->root()->html()->tag('ul', array_merge($this->getAttr(), $this->getDataAttr(), ['class' => $this->getCssAttr()]), implode("\n", $checkables));
    }
}
