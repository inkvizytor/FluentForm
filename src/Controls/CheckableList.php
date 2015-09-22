<?php namespace inkvizytor\FluentForm\Controls;

use inkvizytor\FluentForm\Renderers\BaseRenderer;

class CheckableList extends Control
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
     * @param \inkvizytor\FluentForm\Renderers\BaseRenderer $renderer
     * @param string $type
     */
    public function __construct(BaseRenderer $renderer, $type = 'checkbox')
    {
        $this->type = $type;

        parent::__construct($renderer);
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
    public function render()
    {
        $checkables = [];
        
        foreach ($this->items as $value => $label)
        {
            $checkables[] = (new Checkable($this->getRenderer(), $this->getType()))
                ->name($this->getName().($this->type == 'checkbox' ? '[]' : ''))
                ->label($label)
                ->value($value)
                ->checked(in_array($value, $this->checked))
                ->disabled($this->isDisabled())
                ->readonly($this->isReadonly())
                ->setData($this->getData(null))
                ->render();
        }
        
        return implode($this->inline ? ' ' : '<br/>', $checkables);
    }
} 